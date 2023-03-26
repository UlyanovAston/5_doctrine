migrate:
	php bin/console doctrine:migrations:status --no-interaction -vvv
	php bin/console doctrine:migrations:list --no-interaction -vvv
	php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction -vvv
	php bin/console doctrine:cache:clear-metadata