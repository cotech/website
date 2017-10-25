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

Changes to the **dev** branch are automatically applied to the [dev site](https://dev.cops.tech/). This works via a [crontab](https://git.coop/cotech/ansible/blob/master/roles/live2dev/tasks/main.yml#L29) which runs [a script](https://git.coop/cotech/ansible/blob/master/roles/live2dev/templates/cron.j2) which checks for changes and if there are any then it runs the [update script](https://git.coop/cotech/ansible/blob/master/roles/live2dev/templates/update.j2).

The [live site](https://www.coops.tech/) is set up exactly the same way but tracking the **master** branch.

If the [dev site](https://dev.cops.tech/) images and database needs syncing from the [live site](https://www.coops.tech/) then please contact `chris@webarchitects.coop` and ask him to run the [live2dev Ansible playbook](https://git.coop/cotech/ansible/blob/master/live2dev.yml).

## Deployment (manual)

Currently the [live](https://www.coops.tech/) and [dev](https://dev.cops.tech/) sites are running on [Werbarchitects shared hosting](https://webarch.net/wp) and although SFTP/SSHFS and phpMyAdmin access is to available to any developers who need it (ask `chris@webarchitects.coop` to add your SSH public keys to the server and to email you the MySQL login details), `ssh` access is only availabe to Webarchitects sysadmins, see [the wiki](https://wiki.coops.tech/wiki/CoTech_WordPress#Updating_the_code) for the steps to manually update the code.


## Querying the WordPress database directly

Even though the format of the WordPress database is pretty horrible you can perform analytics queries on a local copy of the database which can be downloaded from the admin section of the site if you have Admin permissions. 

e.g. to get the names and email addresses of co-ops that have not entered a turnover so you can nag them: 

```
SELECT * FROM (
    SELECT post_id,  post_title, meta_value as turnover 
    FROM `wp_postmeta` LEFT JOIN wp_posts on post_id = ID
    where meta_key = 'turnover'
    and post_status = 'publish'
    and meta_value = "") as noturnover
LEFT JOIN wp_postmeta on noturnover.post_id = wp_postmeta.post_id
where meta_value REGEXP  '^[^@]+@[^@]+\.[^@]{2,}$'
```