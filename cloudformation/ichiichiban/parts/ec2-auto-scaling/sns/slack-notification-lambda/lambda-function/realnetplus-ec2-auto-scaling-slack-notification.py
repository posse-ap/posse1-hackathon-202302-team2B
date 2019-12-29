import boto3
import json
import datetime
import calendar
import urllib.request
import os

def lambda_handler(event, context):
    return {
        'statusCode': 200,
        'body': post_slack(event)
    }

def post_slack(event):
    message = json.loads(event['detail'])

    pretext = 'testdayo'
    title = 'testtitle'
    text = message

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