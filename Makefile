prepare-test:
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:schema:update --force --env=test
	php bin/console doctrine:fixtures:load --group=test --env=test -n

run-test:
	php bin/console cache:clear --env=test
	php bin/phpunit

run-unit-test:
	php bin/console cache:clear --env=test
	php bin/phpunit --testsuite unit

run-integration-test:
	php bin/console cache:clear --env=test
	php bin/phpunit --testsuite integration

fixtures:
	php bin/console doctrine:fixtures:load --group=app -n