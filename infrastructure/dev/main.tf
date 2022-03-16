terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.27"
    }
  }

  backend "s3" {
    bucket = "openapi-document-generator-tfstate"
    key    = "dev/terraform.tfstate"
    region = "eu-west-3"
  }

  required_version = ">= 0.14.9"
}

provider "aws" {
  region     = "eu-west-3"
  access_key = var.access_key
  secret_key = var.secret_key
}