output "sqs_dsn" {
  description = "Queue Data Source Name used by Symfony/Messenger"
  value       = "${aws_sqs_queue.openapi_document_generator.url}?access_key=${var.access_key}&secret_key=${var.secret_key}"
  sensitive   = true
}

output "sqs_dsn_dlq" {
  description = "Dead letter queue Data Source Name used by Symfony/Messenger"
  value       = "${aws_sqs_queue.openapi_document_generator_dlq.url}?access_key=${var.access_key}&secret_key=${var.secret_key}"
  sensitive   = true
}

output "db_dsn" {
  description = "Database Data Source Name used by Doctrine"
  value       = "mysql://${var.db_username}:${var.db_password}@${aws_db_instance.openapi_document_generator.endpoint}:${aws_db_instance.openapi_document_generator.port}/${aws_db_instance.openapi_document_generator.name}"
  sensitive   = true
}

output "s3_bucket" {
  description = "Bucket name to store generated document"
  value       = aws_s3_bucket.openapi_document_generator.bucket
}

output "s3_version" {
  value = "latest"
}

output "access_key" {
  description = "AWS access key"
  value       = var.access_key
  sensitive   = true
}

output "secret_key" {
  description = "AWS secret key"
  value       = var.secret_key
  sensitive   = true
}

output "region" {
  value = var.region
}