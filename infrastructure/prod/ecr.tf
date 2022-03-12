resource "aws_ecr_repository" "openapi_document_generator" {
  name = "${var.prefix}-openapi-document-generator"
}