docker-up: memory
	cd laradock && docker-compose up -d

docker-down:
	cd laradock && docker-compose down

docker-build: memory
	cd laradock && docker-compose up --build -d

test:
	cd laradock && docker-compose exec workspace vendor/bin/phpunit

assets-install:
	cd laradock && docker-compose exec workspace npm install

assets-rebuild:
	cd laradock && docker-compose exec workspace npm rebuild node-sass --force

assets-dev:
	cd laradock && docker-compose exec workspace npm run dev

assets-watch:
	cd laradock && docker-compose exec workspace npm run watch

queue:
	cd laradock && docker-compose exec workspace php artisan queue:work

horizon:
	cd laradock && docker-compose exec workspace php artisan horizon

horizon-pause:
	cd laradock && docker-compose exec workspace php artisan horizon:pause

horizon-continue:
	cd laradock && docker-compose exec workspace php artisan horizon:continue

horizon-terminate:
	cd laradock && docker-compose exec workspace php artisan horizon:terminate

memory:
	sudo sysctl -w vm.max_map_count=262144

perm-cache:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache

perm:
	sudo chown -R ${USER}:${USER} *

clear-c:
	cd laradock && docker-compose exec workspace composer clear-all
