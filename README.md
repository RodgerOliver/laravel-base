# Laravel + Docker Project

[![version](https://img.shields.io/badge/PHP-8.1-787CB5)](https://php.net)
[![version](https://img.shields.io/badge/Composer-2.3-89552C)](https://getcomposer.org)
[![version](https://img.shields.io/badge/Laravel-9.12-FF291A)](https://laravel.com)
[![version](https://img.shields.io/badge/Nginx-1.21.6-009639)](https://nginx.com)
[![version](https://img.shields.io/badge/MySQL-8.0-1C4863)](https://mysql.com)
[![version](https://img.shields.io/badge/npm-8.5.5-CC3534)](https://npmjs.com)
[![version](https://img.shields.io/badge/Node.js-16-026E00)](https://nodejs.com)

## About

Laravel + Docker is a base project that others can use to start their development
with Laravel in containers. All softwares and dependencies are inside the containers
so it can run anywhere.

## Important

**All commands from NPM, ARTISAN and COMPOSER must bt executed
inside the containers with the command `docker-compose run --rm [service]`
as listed below.**

## Installation

1. Configure `.env` file:

```sh
cp .env.example .env
```

> Set 3 first name fields
>
> Set `DB_PASSWORD` and `DB_PASSWORD_ROOT` fields
>
> Set `APP_URL NGINX_HTTP_PORT MYSQL_PORT` if needed

> If running linux, configure `docker-compose.override.yml` file:

```sh
cp docker-compose.override.yml.example docker-compose.override.yml
```

2. Start containers:

```sh
docker-compose up -d --build php mysql nginx
```

3. Install composer packages:

```sh
docker-compose run --rm composer install
```

4. Install npm packages:

```sh
docker-compose run --rm npm install
```

5. Mix resources files (js, css):

```sh
docker-compose run --rm npm run dev
```

6. Generate Laravel key:

```sh
docker-compose run --rm artisan key:generate
```

7. Run migrations and seeders:

```sh
docker-compose run --rm artisan migrate --seed
```

## Setup New Project

- Copy the files to your project folder
  - `.docker/`
  - `.env.example > .env`
    - Follow step 1 from [Installation](#installation)
  - `.npmrc`
  - `docker-compose.override.yml.example > docker-compose.override.yml` if running on linux
  - `docker-compose.yml`
  - `Dockerfile`
- Between [Installation](#installation) step 2 and 3 run the commands bellow

```sh
docker-compose run --rm composer create-project laravel/laravel:9.0
rm laravel/{.env,.env.example} ; mv laravel/* laravel/.* -t . ; rm -rf laravel/
```

- Follow the rest of the [Installation](#installation) steps

## Useful Commands

Mix resource files in real time:

```sh
docker-compose up -d npm_watch
```

Run migrations from a specific version:

```sh
docker-compose run --rm artisan migrate --path=/database/migrations/v1/
```

Stop and remove all containers:

```sh
docker-compose down
```

If any artisan command needs to use composer:

```sh
docker-compose run --rm --entrypoint php composer artisan breeze:install vue
```

## Developer

_Rodger Bittencourt_ `2022`
