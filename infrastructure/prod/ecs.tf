resource "aws_ecs_cluster" "openapi_document_generator" {
  name = "${var.prefix}-reverse-openapi"
}

resource "aws_ecs_service" "openapi_document_generator" {
  name                   = "${var.prefix}-openapi-document-generator"
  cluster                = aws_ecs_cluster.openapi_document_generator.arn
  task_definition        = aws_ecs_task_definition.openapi_document_generator.arn
  desired_count          = 1
  launch_type            = "FARGATE"
  enable_execute_command = true
  network_configuration {
    subnets = [
      aws_default_subnet.default_subnet_a.id,
      aws_default_subnet.default_subnet_b.id,
      aws_default_subnet.default_subnet_c.id
    ]
    assign_public_ip = true
  }
}

resource "aws_ecs_task_definition" "openapi_document_generator" {
  family                   = "${var.prefix}-openapi-document-generator"
  requires_compatibilities = ["FARGATE"]
  network_mode             = "awsvpc"
  execution_role_arn       = aws_iam_role.ecs_task_execution_role.arn
  task_role_arn            = aws_iam_role.ecs_task_execution_role.arn
  memory                   = 512
  cpu                      = 256
  container_definitions = jsonencode([
    {
      name      = "${var.prefix}-openapi-document-generator"
      image     = aws_ecr_repository.openapi_document_generator.repository_url
      cpu       = 256
      memory    = 512
      essential = true,
      environment = [
        { "name" : "APP_ENV", "value" : var.app_env },
        { "name" : "DATABASE_URL", "value" : var.database_url },
        { "name" : "SQS_TRANSPORT_DSN", "value" : var.sqs_transport_dsn },
        { "name" : "SQS_DLQ_TRANSPORT_DSN", "value" : var.sqs_dlq_transport_dsn },
        { "name" : "S3_KEY", "value" : var.s3_key },
        { "name" : "S3_SECRET", "value" : var.s3_secret },
        { "name" : "S3_VERSION", "value" : var.s3_version },
        { "name" : "S3_REGION", "value" : aws_s3_bucket.openapi_document_generator.region },
        { "name" : "S3_BUCKET", "value" : aws_s3_bucket.openapi_document_generator.bucket },
      ]
    },
  ])
}