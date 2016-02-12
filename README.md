CHARLES Pierre & DEVAUD Max - PHP Project

### Install dependencies

    composer install

### Database installation with Docker

    docker run -d \
        --volume /var/lib/mysql \
        --name data_mysql \
        --entrypoint /bin/echo \
        busybox \
        "mysql data-only container"

Initialize MySQL with a user/password and a database

    docker run -d -p 3306 \
        --name mysql \
        --volumes-from data_mysql \
        -e MYSQL_USER=uframework \
        -e MYSQL_PASS=p4ssw0rd \
        -e ON_CREATE_DB=uframework \
        tutum/mysql

Executing your SQL from the command line

    mysql uframework -uuframework -pp4sswOrd < app/config/schema.sql

### Launch server

    php -S localhost:8080 -t web/

---------------------------------
You can register you or you can log in on this website with a default user:
    - login : UserTest
    - password : kg4GKGu5hjk


# Testing
-----------
Filtering the query result

    GET /statuses?limit=0,5&order=status_user_name&by=DESC
    GET /statuses?limit=2,4&order=status_id&by=ASC
    GET /statuses?limit=0,10&order=status_user_name
    GET /statuses?user_id=UserTest&limit=0,1
    GET /statuses?order=status_date
    GET /statuses?limit=0,5

####Php Unit : In a terminal, try this commands:

    phpunit

In a terminal, try these commands:

    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses
    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses/1
    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses/1000

Also, try to create new statuses using JSON:

    curl -XPOST -H "Accept: application/json" -H 'Content-Type: application/json' \
    -d '{ "user": "picharles", "message": "Je suis un TweetTweet de test"}' \
    http://localhost:8080/statuses

### Fixer

    php vendor/fabpot/php-cs-fixer/php-cs-fixer fix src/

### Realized tasks
------------------

    - Routes
    - Using the request
    - Post, get, Delete Resource
    - DataMapper (User and Status)
    - Entity (User and Status)
    - Database connection
    - DataFinder (User and Status)
    - Authentication
    - Login, register, status, statuses view
    - Filtering the results
    - Firewall with a dispatcher
    - Use composer for autoloading
    - Validation and verification for all parameters
    - Mock connection
    - Unit tests
    - Functional tests
    - Fix with php-cs-fixer


Anatomy of &micro;Framework
---------------------------

The directory layout looks like this:

    ├ app/      # the application directory
    ├ src/      # the framework sources
    ├ tests/    # the test suite
    ├ vendor/   # project's dependencies
    ├ web/      # public directory

### `app` directory

Your application controllers will be registered as closures in `app.php`.
Templates will be put into the `templates/` directory.

### `src` directory

The framework sources. You will have to complete the missing parts.

### `tests` directory

The test suite, all tests have to pass at the end :)

### `web` directory

Contains the public files. Most of the time, we put assets (CSS, JS files)
and a `index.php` file.

The `index.php` file is the only entry point of this application.  It is called a **front controller**.

