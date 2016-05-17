# Codeigniter 3 HMVC Boilerplate

> Boilerplate for creating Codeigniter 3 [HMVC](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc) with [Propel 2 ORM](http://propelorm.org/) and [OAuth2](https://github.com/bshaffer/oauth2-server-php).

## Features
- CodeIgniter 3 with HMVC Modular Extension
- Composer project
- HTTP verbs: `GET`, `POST`, `PUT` and `DELETE`.
- [Propel 2 ORM](http://propelorm.org/) (optional)
- [OAuth2](https://github.com/bshaffer/oauth2-server-php) (optional)

## Install

Clone this repository and install composer dependencies.

```sh
$ git clone https://github.com/joseluisq/codeigniter3-hmvc-boilerplate.git
$ cd codeigniter3-hmvc-boilerplate
$ composer install
```

Run development server.

```sh
$ php -S localhost:8001 -t path_project_directory
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

## OAuth2

#### Client Credentials

```
POST http://localhost:8001/v1/login/oauth/access_token
```

Header params:

- `API-KEY` : (View `application/constants.php` file for change `API_KEY`)
- `Authorization` : `client_id` and `client_secret`

Example:

```sh
$ curl \
      -H "API-KEY:32563b81ec7288ef87bbe39c3b7001a7bff35395eec1eac906a580e6a12d189e" \
      -u admin \
      -X POST http://localhost:8001/v1/login/oauth/access_token
```

Output:

 ```json
{"access_token":"8ea0d5aedc6c7da8f3b6603b8ba783c85c7f0ef7","expires_in":3600,"token_type":"Bearer","scope":null}
 ```

Use `Accept` header for choose the format of the data that you wish to receive.
For example: `application/json` (default) and `application/xml`

## API (example)

`User` API requires `access_token`.

#### Get all Users

```
GET "http://localhost:8001/v1/user?access_token=..."
```

Example: 

`access_token` via query string:

```sh
$ curl \
      -H "API-KEY: 32563b81ec7288ef87bbe39c3b7001a7bff35395eec1eac906a580e6a12d189e" \
      -X GET "http://localhost:8001/v1/user?access_token=6b3a73aaa27f3a8495d7588fee56ab15628e64d7"
```

Or `access_token` via `Authentication` header:

```sh
$ curl \
      -H "API-KEY: 32563b81ec7288ef87bbe39c3b7001a7bff35395eec1eac906a580e6a12d189e" \
      -H "Authorization: Bearer 44cc7ead29d1855900c084d713ca21c9409a4675" \
      -X GET "http://localhost:8001/v1/user"
```

#### Get specific User by Id

```
GET "http://localhost:8001/v1/user/[:Id]?access_token=..."
```

Example: 

```sh
$ curl \
      -H "API-KEY: 32563b81ec7288ef87bbe39c3b7001a7bff35395eec1eac906a580e6a12d189e" \
      -H "Authorization: Bearer 44cc7ead29d1855900c084d713ca21c9409a4675" \
      -X GET "http://localhost:8001/v1/user/2"
```

**Note:** Check out `application/config.php` for change default timezone.

## License
MIT license

© 2016 [José Luis Quintana](http://git.io/joseluisq)
