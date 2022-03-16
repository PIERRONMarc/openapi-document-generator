prepare-test:
	docker exec -ti openapi-document-generator php bin/console doctrine:database:create --env=test
	docker exec -ti openapi-document-generator php bin/console doctrine:schema:update --force --env=test
	docker exec -ti openapi-document-generator php bin/console doctrine:fixtures:load --group=test --env=test -n

run-test:
	docker exec -ti openapi-document-generator php bin/console cache:clear --env=test
	docker exec -ti openapi-document-generator php bin/phpunit

run-unit-test:
	docker exec -ti openapi-document-generator php bin/console cache:clear --env=test
	docker exec -ti openapi-document-generator php bin/phpunit --testsuite unit

run-integration-test:
	docker exec -ti openapi-document-generator php bin/console cache:clear --env=test
	docker exec -ti openapi-document-generator php bin/phpunit --testsuite integration

connect:
	docker exec -ti openapi-document-generator /bin/bash

start:
	export DATABASE_URL=$$(cd infrastructure/dev && terraform output --raw db_dsn) && \
	export SQS_TRANSPORT_DSN=$$(cd infrastructure/dev && terraform output --raw sqs_dsn) && \
	export SQS_DLQ_TRANSPORT_DSN=$$(cd infrastructure/dev && terraform output --raw sqs_dsn_dlq) && \
	export S3_KEY=$$(cd infrastructure/dev && terraform output --raw access_key) && \
	export S3_SECRET=$$(cd infrastructure/dev && terraform output --raw secret_key) && \
	export S3_REGION=$$(cd infrastructure/dev && terraform output --raw region) && \
	export S3_BUCKET=$$(cd infrastructure/dev && terraform output --raw s3_bucket) && \
	export S3_VERSION=$$(cd infrastructure/dev && terraform output --raw s3_version) && \
	export APP_ENV=dev && \
	docker compose up -d

stop:
	docker compose stop

deploy-dev:
	cd infrastructure/dev && terraform init
	cd infrastructure/dev && terraform apply --auto-approve
	make start
	docker exec -ti openapi-document-generator php bin/console d:m:m -n
	docker exec -ti openapi-document-generator php bin/console d:f:l -n --group=app