up:
	docker-compose up -d
down:
	docker-compose down
dev:
	docker-compose run --rm --service-ports npm run dev
build:
	docker-compose run --rm  npm run build
ch_build:
	sudo chmod -R 777 src/public/build/
migrate:
	docker-compose run --rm artisan migrate
init:
	docker-compose run --rm composer create-project laravel/laravel:^10.0 .