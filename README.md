# Laravel Base Project

[![version](https://img.shields.io/badge/PHP-8.1-787CB5)](https://php.net)
[![version](https://img.shields.io/badge/Composer-2.3-89552C)](https://getcomposer.org)
[![version](https://img.shields.io/badge/Laravel-9.12-FF291A)](https://laravel.com)
[![version](https://img.shields.io/badge/Nginx-1.21.6-009639)](https://nginx.com)
[![version](https://img.shields.io/badge/MySQL-8.0-1C4863)](https://mysql.com)
[![version](https://img.shields.io/badge/Redis-7.0.2-D82C20)](https://redis.io)
[![version](https://img.shields.io/badge/npm-8.5.5-CC3534)](https://npmjs.com)
[![version](https://img.shields.io/badge/Node.js-16-026E00)](https://nodejs.com)
[![version](https://img.shields.io/badge/Meilisearch-0.27.2-FF5CAA)](https://meilisearch.com)

## About

Laravel Base is a base project that others can use to start their development
with Laravel in containers. All software and dependencies are inside the docker
containers, so it can run anywhere.

There are some features developed that I learned and put in this project.
Generally, examples of functionality, like CRUDs, storage management, to show how it is done and be used as a reference for other projects.

It also has some packages pre-installed to easy the development.

## Important

**All commands from NPM, ARTISAN and COMPOSER must bt executed
inside the containers with the command `docker-compose run --rm [service]`
as listed below.**

## Usage

Interacting with Redis container:

```sh
docker-compose exec redis redis-cli
> select [DB]
> keys *
> mget [key]
```

Interacting with Php container:

```sh
docker-compose exec php sh
```

Interacting with MySQL container:

```sh
docker-compose exec mysql mysql -u laravel -p
```

## Installation

1. Configure `.env` file:

```sh
cp .env.example .env
```

2. Build Dockerfile and start containers:

```sh
docker-compose up -d --build php mysql redis nginx mailhog horizon meilisearch npm-watch
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

8. Install Horizon (Redis Queues Dashboard):

```sh
docker-compose run --rm artisan horizon:install
```

9. Index data and configure Meilisearch:

```sh
docker-compose run --rm artisan scout:import-all

# get master (backend) and public (frontend) keys
curl \
  -X GET 'http://localhost:7700/keys' \
  -H 'Authorization: Bearer masterKey'

```

## Setup New Project

- Copy the files to your project folder
  - `.docker/`
  - `.env.example > .env`
    - Follow step 1 from [Installation](#installation)
  - `.npmrc`
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
docker-compose up -d npm-watch
```

Run migrations from a specific version:

```sh
docker-compose run --rm artisan migrate --path=/database/migrations/v1/
```

Stop and remove all containers:

```sh
docker-compose down
```

## References

### Meilisearch

- [Meilisearch Docs](https://meilisearch.com)
- [Meilisearch and Laravel Scout](https://laravel-news.com/getting-started-laravel-scout-meilisearch)
- [Filtering with Meilisearch and Scout](https://serversideup.net/filtering-meilisearch-search-results-with-laravel-scout)
- [Configure Filterable and Sortable](https://laracasts.com/discuss/channels/general-discussion/laravel-scout-meilisearch-add-filterableattributes-sortableattributes-upon-import)

### Algolia

- [Algolia and Laravel Scout](https://code.tutsplus.com/tutorials/how-to-setup-a-full-text-search-using-scout-in-laravel--cms-30702)

## Elasticsearch

- [Elasticsearch and Laravel Scout](https://github.com/matchish/laravel-scout-elasticsearch)
- [With Third Party Package, Without Scout](https://developer.okta.com/blog/2022/02/09/a-developers-guide-to-elasticsearch-with-laravel)
- [With Official Package, Without Scout](https://madewithlove.com/blog/software-engineering/how-to-integrate-elasticsearch-in-your-laravel-app-2022)

## Developer

_Rodger Bittencourt_ `2022`
