start:
	php artisan serve

test:
	php artisan test

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	npm install && npm run dev

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

