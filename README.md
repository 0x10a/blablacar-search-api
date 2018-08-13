# Docker Symfony Development Environment (PHP7-FPM + NGINX + MySQL + PHPMyAdmin + ELK)

Docker Symfony Development Environment is a basic set of docker containers to run your Symfony application. This complete stack run with docker and [docker-compose (1.7 or higher)](https://docs.docker.com/compose/).

This stack comes with:
PHP7-FPM
NGINX
MySQL
PHPMyAdmin
ELK (Elasticsearch Logstash and Kibana) 

# Installation

## 1. Docker installation

Docker for Windows is the Community Edition (CE) of Docker for Microsoft Windows. To download Docker for Windows, head to e[Docker Store](https://store.docker.com/editions/community/docker-ce-desktop-windows).

## 2. Git installation

Download the latest version of Git for Windows [here](https://git-scm.com/download/win).

## 3. Clone this repository

Once Git is up and running you can now clone this repository on your local machine.

    ```bash
    git clone 
    ```

## 4. Set configuration

Create a `.env` from the `.env.dist` file. Change it according to your symfony application

    ```bash
    cp .env.dist .env
    ```

## 5. Build docker containers

Build/run containers with (with and without detached mode)

    ```bash
    $ docker-compose build
    $ docker-compose up -d
    ```

**Note:** To use a custom host name, you can edit hosts file (on Windows, edit C:\Windows\System32\drivers\etc\hosts)

## 6. Symfony application configuration

Prepare your Symfony application.

    1. Update app/config/parameters.yml

        ```yml
        # path/to/your/symfony-project/app/config/parameters.yml
        parameters:
            database_host: db
        ```

    2. Composer install & create database

        ```bash
        $ docker-compose exec php bash
        $ composer install
        # Symfony2
        $ sf doctrine:database:create
        $ sf doctrine:schema:update --force
        # Only if you have `doctrine/doctrine-fixtures-bundle` installed
        $ sf doctrine:fixtures:load --no-interaction
        # Symfony3
        $ sf3 doctrine:database:create
        $ sf3 doctrine:schema:update --force
        # Only if you have `doctrine/doctrine-fixtures-bundle` installed
        $ sf3 doctrine:fixtures:load --no-interaction
        ```

Now your Symfony application is up and running @ http://localhost

# Usage

* Symfony app: Visit [localhost](http://localhost)  
* Symfony dev mode: Visit [localhost/app_dev.php](http://localhost/app_dev.php)  
* Logs (Kibana): Visit [localhost:81](http://localhost:81)  
* PHPMyAdmin: Visit [localhost](http://localhost)  
* Logs (files location): logs/nginx and logs/symfony


# Docker compose

Have a look at the `docker-compose.yml` file, here are the `docker-compose` built images:

* `db`: This is the MySQL database container
* `php`: This is the PHP-FPM container in which the application volume is mounted
* `nginx`: This is the Nginx webserver container in which application volume is mounted too
* `elk`: This is a ELK stack container which uses Logstash to collect logs, send them into Elasticsearch and visualize them with Kibana.
* `phpmyadmin`: PHPMyAdmin database management application.

# Useful commands

```bash
# bash commands
$ docker-compose exec php bash

# Composer (e.g. composer update)
$ docker-compose exec php composer update

# SF commands (Tips: there is an alias inside php container)
$ docker-compose exec php php /var/www/symfony/app/console cache:clear # Symfony2
$ docker-compose exec php php /var/www/symfony/bin/console cache:clear # Symfony3
# Same command by using alias
$ docker-compose exec php bash
$ sf cache:clear

# Retrieve an IP Address (here for the nginx container)
$ docker inspect --format '{{ .NetworkSettings.Networks.dockersymfony_default.IPAddress }}' $(docker ps -f name=nginx -q)
$ docker inspect $(docker ps -f name=nginx -q) | grep IPAddress

# MySQL commands
$ docker-compose exec db mysql -uroot -p"root"

# F***ing cache/logs folder
$ sudo chmod -R 777 app/cache app/logs # Symfony2
$ sudo chmod -R 777 var/cache var/logs var/sessions # Symfony3

# Check CPU consumption
$ docker stats $(docker inspect -f "{{ .Name }}" $(docker ps -q))

# Delete all containers
$ docker rm $(docker ps -aq)

# Delete all images
$ docker rmi $(docker images -q)
```

# Contributing
For contributing, feel free to create a Pull Request on GitHub, please write a description which gives the context and/or explains why you are creating it.
