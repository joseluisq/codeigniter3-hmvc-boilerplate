# Codeigniter 3 HMVC Boilerplate

> Boilerplate for creating Codeigniter 3 [HMVC](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc) and [Propel 2 ORM](http://propelorm.org/)

## Features
- CodeIgniter 3 with HMVC Modular Extension
- Composer project
- RESTful compatible methods: GET, POST, PUT and DELETE.
- Propel 2 ORM

## Install

Clone this repository and install composer dependencies.

```sh
$ git clone https://github.com/joseluisq/codeigniter3-hmvc-boilerplate.git
$ cd codeigniter3-hmvc-boilerplate
$ composer install
```

## Propel 2
This project brings [Propel 2 ORM](http://propelorm.org/) buit-in.

### Settings
[Propel configuration file](http://propelorm.org/documentation/10-configuration.html) is located at `/propel.yml`.

### Reverse Engineering
Reverse-engineer the XML schema based on given database.

```sh
$ ./propel database:reverse --output-dir=orm development
```

### Build model classes
Build the model classes based on Propel XML schemas.

```sh
$ ./propel model:build
```

### Build config file
Transform the configuration to PHP code leveraging the ServiceContainer.

```sh
$ ./propel config:conver
```

### Build SQL
Build SQL files

```sh
$ ./propel sql:build
```

Note: See `application/config.php` file for change default timezone.

## License
MIT license

© 2016 [José Luis Quintana](http://git.io/joseluisq)
