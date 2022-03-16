resource "aws_db_instance" "openapi_document_generator" {
  allocated_storage   = 20
  engine              = "mysql"
  engine_version      = "8.0.27"
  instance_class      = "db.t2.micro"
  name                = "openapi_document_generator"
  identifier          = "${var.prefix}-openapi-document-generator"
  username            = var.db_username
  password            = var.db_password
  publicly_accessible = true
  skip_final_snapshot = true
}