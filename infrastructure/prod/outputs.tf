output "sqs_url" {
  description = "URL of the queue to consume"
  value       = aws_sqs_queue.openapi_document_generator.url
}

output "sqs_url_dlq" {
  description = "URL of the dead letter queue"
  value       = aws_sqs_queue.openapi_document_generator_dlq.url
}

output "rds_endpoint" {
  description = "Database URL"
  value       = aws_db_instance.openapi_document_generator.endpoint
}

output "s3_bucket" {
  description = "Bucket to store generated document"
  value       = aws_s3_bucket.openapi_document_generator.bucket
}