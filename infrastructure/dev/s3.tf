resource "aws_s3_bucket" "openapi_document_generator" {
  bucket        = "${var.prefix}-openapi-document-generator"
  force_destroy = true
}