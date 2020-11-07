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
