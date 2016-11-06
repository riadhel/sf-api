Auto-api
========

A Symfony 3 project demonstration on how to use api rest json api.

# Installation

## Git

* Clone git repository :

    git clone git@github.com:riadhel/sf-api.git auto-api

## Install dependancies

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

## Create database & load data

    bin/console doctrine:database:create
    bin/console doctrine:schema:update --force
        
    bin/console doctrine:fixtures:load -n -e dev
    
## Run your application
    1. Execute the php bin/console server:start command.
    2. Browse to the http://localhost:8000 URL.
    
## Run tests
    phpunit
    
## Get API Doc  tests
    http://localhost:8000/app_dev.php/api/doc
