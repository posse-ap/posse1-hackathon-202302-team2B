import boto3
import json
import datetime
import calendar
import urllib.request
import os

OUTPUT_LIMIT=5 #抽出するログデータの最大件数
TIME_FROM_MIN=10 #何分前までを抽出対象期間とするか

def lambda_handler(event, context):
    return {
        'statusCode': 200,
        'body': post_slack(event)
    }

def post_slack(event):
    message = json.loads(event['Records'][0]['Sns']['Message'])

    logs = boto3.client('logs')

    metric_filter = logs.describe_metric_filters(
        metricName      = message['Trigger']['MetricName'] ,
        metricNamespace = message['Trigger']['Namespace']
    )['metricFilters'][0]

    #ログストリームの抽出対象時刻をUNIXタイムに変換（取得期間はTIME_FROM_MIN分前以降）
    #終了時刻はアラーム発生時刻の1分後
    timeto = datetime.datetime.strptime(message['StateChangeTime'][:19] ,'%Y-%m-%dT%H:%M:%S') + datetime.timedelta(minutes=1)
    u_to = calendar.timegm(timeto.utctimetuple()) * 1000
    #開始時刻は終了時刻のTIME_FROM_MIN分前
    timefrom = timeto - datetime.timedelta(minutes=TIME_FROM_MIN)
    u_from = calendar.timegm(timefrom.utctimetuple()) * 1000

    log_group_name = metric_filter['logGroupName']
    log_events = logs.filter_log_events(
        logGroupName  = log_group_name,
        filterPattern = metric_filter['filterPattern'],
        startTime     = u_from,
        endTime       = u_to,
        limit         = OUTPUT_LIMIT
    )
    log_stream_name = log_events['events'][0]['logStreamName']

    title = log_group_name + ' ' + log_stream_name.split('/')[1] + ' Error'

    text = ""
    for log_event in log_events['events']:
        text = text + log_event['message'] + '\n'

    pretext = '<https://ap-northeast-1.console.aws.amazon.com/cloudwatch|[CloudWatchコンソール]> > ログ > ロググループ >' + log_group_name + ' > ' + log_stream_name

    send_data = {
        "username"   : "webhookbot",
        "icon_emoji" : ":ghost:",
        "attachments": [
            {
                "pretext": pretext,
                "color"  : "danger",
                "fields": [
                    {
                        "title": title,
                        "value": text
                    }
                ]
            }
        ]
    }

    send_text = "payload=" + json.dumps(send_data)

    request = urllib.request.Request(
        os.environ['API_URL'],
        data=send_text.encode("utf-8"),
        method="POST"
    )
    with urllib.request.urlopen(request) as response:
        return response.read().decode("utf-8")