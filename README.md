# Cooperative Technologists

## Requirements

* PHP >= 5.4
* Node & NPM
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## Development

For an easy to use development environment run we use Docker Compose.

0. Make sure you have [downloaded Docker](https://www.docker.com/community-edition#/download) and have it installed on your machine and running.
1. On your command line of choice kickstart it all with `docker-compose up -d` run from inside this directory. You can follow the logs with `docker-compose logs -f`.
2. It will take some time, especially for the first run.

Then you can access:

| URL | Description |
| --- | --- |
| [localhost:18080](http://localhost:18080) | WordPress URL (dev:dev) |
| [localhost:18081](http://localhost:18081) | PHPMyAdmin |

### Images

Images used on the cotech website (go in `web/app/uploads`) will be downloaded when you
first setup your environment. If you want to update them again, you can run:

```
docker-compose exec assets /download-images.sh --force
```

## Deployment

Testing deployment via a script... WIP

`~/git-hooks` contains all files required for deployment - copy all files into the `~/.git/hooks` directory


## Deployment (manual)

**NOTE:** a git hook has been created to run deployment automatically so that following should not be necessary.

From the base directory, once the latest changes have been pulled from Git, run the following series of commands in order:

```
composer install
cd ./web/app/themes/coop-tech-oowp-theme
composer install
npm install
./node_modules/gulp/bin/gulp.js
```
