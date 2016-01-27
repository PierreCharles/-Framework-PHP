Usage:

    php -S localhost:8080 -t web/


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

The `index.php` file is the only entry point of your application.  It is called
a **front controller**.


Autoloading
-----------
