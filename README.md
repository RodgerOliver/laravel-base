# Laravel + Docker Project

[![version](https://img.shields.io/badge/PHP-8.1-787CB5)](https://php.net)
[![version](https://img.shields.io/badge/Composer-2.3-89552C)](https://getcomposer.org)
[![version](https://img.shields.io/badge/Laravel-9.12-FF291A)](https://laravel.com)
[![version](https://img.shields.io/badge/Nginx-1.21.6-009639)](https://nginx.com)
[![version](https://img.shields.io/badge/MySQL-8.0-1C4863)](https://mysql.com)
[![version](https://img.shields.io/badge/npm-8.5.5-CC3534)](https://npmjs.com)
[![version](https://img.shields.io/badge/Node.js-16-026E00)](https://nodejs.com)

## Installation

```
docker up -d --build php mysql nginx
docker-compose run --rm composer create-project laravel/laravel:9.0 --prefer-dist application
mv application/* application/.* -t . && rm -rf application/
docker-compose run --rm composer install
docker-compose run --rm npm install
docker-compose run --rm npm run dev
```
