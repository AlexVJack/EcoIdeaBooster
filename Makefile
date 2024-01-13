build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

bash:
	docker exec -it ecoideabooster-php-fpm-1 bash
