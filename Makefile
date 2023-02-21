WEB = nginx
PHP = php 
DB = mysql

up:
	docker-compose up -d

down:
	docker-compose down

ps:
	docker ps

web:
	docker-compose exec $(WEB) bash

php:
	docker-compose exec $(PHP) bash

db:
	docker-compose exec $(DB) sh

build:
	docker-compose build --pull

destroy:
	docker-compose down --volumes

init:
	cp ./src/.env.dev ./src/.env 
	$(MAKE) build 
	$(MAKE) up 
	docker-compose exec $(PHP) bash -c "cd ichiichiban && composer install && php artisan migrate:refresh --seed && npm install && npm run dev"