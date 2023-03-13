# PHP-NGINX-MySQL-phpMyAdmin

Preconfigured Docker services for development environment.

## Prerequisite

### Brew

[Brew](https://docs.brew.sh/Installation) is required for dependencies installation.

### `.env`

Create `.env` from `.env.dist` in the `./src` directory and update environment variables

Example content for the `.env` file

```text
DOMAIN=local.app.com
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=app
MYSQL_USER=user
MYSQL_PASSWORD=password
PMA_HOST=mysql
PMA_PORT=3306
```

## Installation

The following script will install dependencies, create temporary directories, create the certificat for the `DOMAIN` and update the hosts automatically.

```bash
make install
```

Following dependencies will be installed:

- `docker`
- `docker-compose`
- `composer`
- `mkcert`
- `nss`
- `hostess`

## Available Make scripts

| Command          | Description                                                                                 |
| ---------------- | :------------------------------------------------------------------------------------------ |
| `make install`   | Install dependencies, create temp directories, create and install certificate, update hosts |
| `make start`     | Start Docker services                                                                       |
| `make stop`      | Stop Docker services                                                                        |
| `make stop`      | Stop Docker services                                                                        |
| `make uninstall` | Uninstall certificates, remove temp directories and remove all services data                |

## Services

### NGINX

The application run on `DOMAIN` value. Log are available in `./docker/nginx/log` directory.

### MySQL

SQL dump located in `./dump` will provision the database.

### phpMyAdmin

The phpMyAdmin run on [http://localhost:8080](http://localhost:8080).
