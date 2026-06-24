include .env

# ========================================
# DEPLOY AUTOMATIONS
# ========================================
build:
	make check-dotenv;
	docker compose -f docker-compose.yml build

up:
	make check-dotenv;
	docker compose -f docker-compose.yml up -d

down:
	make check-dotenv;
	docker compose -f docker-compose.yml down

# ========================================
# UTILITY AUTOMATIONS
# ========================================
fix-permissions:
	chown -R www-data:www-data ./ && chmod -R 775 ./

check-dotenv:
	@test -e .env || (echo "[ ERROR ] - .env file not found!"; exit 1)

ide:
	php artisan ide-helper:generate
	php artisan ide-helper:eloquent
	php artisan ide-helper:models --nowrite
	php artisan ide-helper:meta


# ========================================
# LINTER AUTOMATIONS
# ========================================
pint:
	./vendor/bin/pint

pint-d:
	./vendor/bin/pint --dirty

# ========================================
# PHPSTAN
# ========================================
phpstan:
	./vendor/bin/phpstan clear-result-cache
	./vendor/bin/phpstan analyse app --memory-limit=-1


