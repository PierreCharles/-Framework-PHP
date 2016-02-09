### Launch server with :
------------------------

    composer install

    php -S localhost:8080 -t web/

### Testing
-----------
Php Unit : In a terminal, try this commands:

    php phpunit-5.2.3.phar

In a terminal, try these commands:

    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses
    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses/1
    curl -XGET -H "Accept: application/json" http://localhost:8080/statuses/1000

Also, try to create new statuses using JSON:

    curl -XPOST -H "Accept: application/json" -H 'Content-Type: application/json' \
    -d '{ "user": "picharles", "message": "Je suis un TweetTweet de test"}' \
    http://localhost:8080/statuses

Anatomy of &micro;Framework
---------------------------


The directory layout looks like this:

    ├ app/      # the application directory
    ├ src/      # the framework sources
    ├ tests/    # the test suite
    ├ web/      # public directory
    └ autoload.php

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

The `index.php` file is the only entry point of this application.  It is called
a **front controller**.


Autoloading
-----------

This is a PSR-0 compliant autoloader. The &micro;Framework has a `autoload.php` file.
