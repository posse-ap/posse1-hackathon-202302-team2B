#!/bin/sh

# --------------------------------------------------------------
# Usage
#   First Argument: 'deploy'  (Optional)
# If you don't use first argument, change set will be created.
# ※You must set env 'AWS_PROFILE'.
# --------------------------------------------------------------

if [ -z "$AWS_PROFILE" ]; then
    echo "ERROR: Environment variable AWS_PROFILE is not set"
    exit 1;
fi

S3_BUCKET="utilities-cloudformation-template"
TEMPLATE_PATH="./../lambda/update-cloudfront-security-groups-lambda.yml"
RESPONSE_TEMPLATE="./response/update-cloudfront-security-groups-lambda-response.yml"

aws cloudformation package \
    --s3-bucket ${S3_BUCKET} \
    --template-file ${TEMPLATE_PATH} \
    --output-template-file ${RESPONSE_TEMPLATE} \
    --profile ${AWS_PROFILE}

CHANGESET_OPTION="--no-execute-changeset --capabilities CAPABILITY_IAM CAPABILITY_NAMED_IAM"

if [ $# -eq 1 ] && [ $1 == "deploy" ]; then
  echo "deploy mode"
  CHANGESET_OPTION="--capabilities CAPABILITY_IAM CAPABILITY_NAMED_IAM"
fi

aws cloudformation deploy \
    --stack-name UpdateCloudFrontSecurityGroupsLambda \
    --template-file ${RESPONSE_TEMPLATE} \
    --profile ${AWS_PROFILE} \
    ${CHANGESET_OPTION}