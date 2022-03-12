resource "aws_sqs_queue" "openapi_document_generator" {
  name = "${var.prefix}-openapi-document-generator"
  redrive_policy = jsonencode({
    deadLetterTargetArn = aws_sqs_queue.openapi_document_generator_dlq.arn
    maxReceiveCount     = 3
  })
}

resource "aws_sqs_queue" "openapi_document_generator_dlq" {
  name = "${var.prefix}-openapi-document-generator-DLQ"
}