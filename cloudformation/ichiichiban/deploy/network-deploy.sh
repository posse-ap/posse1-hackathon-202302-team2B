#!/bin/sh

# --------------------------------------------------------------
# Usage
#   First Argument : StackName (Required)
#   Second Argument: 'deploy'  (Optional)
# If you don't use second argument, change set will be created.
# ※You must set env 'AWS_PROFILE'.
# --------------------------------------------------------------

if [ $# -eq 0 ]; then
    echo "ERROR: StackName is required"
    exit 1;
fi

if [ -z "$AWS_PROFILE" ]; then
    echo "ERROR: Environment variable AWS_PROFILE is not set"
    exit 1;
fi

if [ -z "`echo $1 | grep 'Ichiichiban'`" ]; then
    echo "ERROR: Incorrect stack name"
    exit 1;
fi

S3_BUCKET="ichiichiban-cloudformation-template"
TEMPLATE_PATH="./../network.yml"
RESPONSE_TEMPLATE="./response/network-response.yml"

aws cloudformation package \
    --s3-bucket ${S3_BUCKET} \
    --template-file ${TEMPLATE_PATH} \
    --output-template-file ${RESPONSE_TEMPLATE} \
    --profile ${AWS_PROFILE}

CHANGESET_OPTION="--no-execute-changeset --capabilities CAPABILITY_IAM CAPABILITY_NAMED_IAM"

if [ $# -eq 2 ] && [ $2 == "deploy" ]; then
  echo "deploy mode"
  CHANGESET_OPTION="--capabilities CAPABILITY_IAM CAPABILITY_NAMED_IAM"
fi

aws cloudformation deploy \
    --stack-name $1 \
    --template-file ${RESPONSE_TEMPLATE} \
    --profile ${AWS_PROFILE} \
    ${CHANGESET_OPTION} \
    --parameter-overrides \
    Environment=Stg