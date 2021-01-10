start:
	php artisan serve

test:
	php artisan test

run-test-method:
	composer exec -v phpunit -- --colors=always --filter $(M) $(F)

run-test-file:
	composer exec -v phpunit -- --colors=always $(F)

setup:
	composer install
	make setup-env
	make setup-db
	make setup-assets

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

lint:
	composer exec phpcs

lint-fix:
	composer exec phpcbf

setup-env:
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

setup-db:
	touch database/database.sqlite
	php artisan migrate

setup-assets:
	npm install && npm run dev

