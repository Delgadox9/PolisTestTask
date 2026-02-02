<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Стек

Фреймворк: Laravel 12.48.0 <br>
База данных: PostgreSQL 16

## Инструкция по запуску

Сначала необходимо заполнить .env файл, для успешного запуска необходимо задать параметры базы данных:
>DB_DATABASE= <br>
>DB_USERNAME= <br>
>DB_PASSWORD= <br>

А так же параметры пользователя и хоста для xdebug:
> UID= <br>
> GID=
>
>XDEBUG_HOST=

Для запуска проекта необходимо собрать его с помощью команды: <br>
> docker compose -f compose.dev.yaml up --build -d <br>

Данная команда собирает проект в версии для разработки. Отличие от production версии в наличие контейнера **Workspace**,
внутри которого можно выполнять команды artisan'а. А так же подключенного xdebug для откладки.

Далее необходимо выполнить команду по запуску миграций:
> php artisan migrate

И команду по запуску seeder'ов:
> php artisan db:seed

Если по каким-то причинам frontend проекта не собрался, выполните:
> composer update<br>
> npm install<br>
> npm run build

В корне проекта так же лежит коллекция постмана.
