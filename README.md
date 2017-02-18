# Cooperative Technologists

## Requirements

* PHP >= 5.4
* Node & NPM
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)


## Deployment

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

