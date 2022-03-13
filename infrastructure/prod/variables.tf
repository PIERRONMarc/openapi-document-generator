variable "region" {
  type        = string
  description = "This is the cloud hosting region where the service will be deployed."
}

variable "prefix" {
  type        = string
  default     = "prod"
  description = "This is the environment where the service is deployed. test, prod, or dev"
}

variable "app_env" {
  type        = string
  default     = "dev"
  description = "Symfony's configuration environments"
}
variable "database_url" {
  type = string
  sensitive   = true
}

variable "sqs_transport_dsn" {
  type = string
  sensitive   = true
}

variable "sqs_dlq_transport_dsn" {
  type        = string
  description = "DSN of the failed queue"
  sensitive   = true
}

variable "s3_key" {
  type        = string
  description = "Key of IAM user"
  sensitive   = true
}

variable "s3_secret" {
  type        = string
  description = "Private key of IAM user"
  sensitive   = true
}

variable "s3_version" {
  type    = string
  default = "latest"
}

variable "db_username" {
  type        = string
  description = "Username for the master DB user"
  sensitive   = true
}

variable "db_password" {
  type        = string
  description = "Password for the master DB user"
  sensitive   = true
}

variable "sentry_dsn" {
  type = string
  sensitive   = true
}
