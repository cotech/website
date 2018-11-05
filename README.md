[![Build Status](https://travis-ci.org/cotech/website.svg?branch=dev)](https://travis-ci.org/cotech/website)

# Cooperative Technologists Website

https://www.coops.tech/

## Editing Content

For content that cannot be edited on the Wordpress Admin interface, please see:

> https://github.com/cotech/website/tree/master/web/app/themes/coop-tech-oowp-theme/views

For example, [frontPage.php](https://github.com/cotech/website/blob/master/web/app/themes/coop-tech-oowp-theme/views/frontPage.php).

## Wiki Documentation

Please see more information on [the wiki](https://wiki.coops.tech/wiki/CoTech_WordPress).

## Hack On It

Firstly, install [docker](https://docs.docker.com/install/)

Then, get [docker-compose](https://docs.docker.com/compose/install/) installed.

Finally, run the following magic incantation:

```bash
$ docker-compose up
```

### Get Latest Images

Manually update the latest images with the following magic incantation:

```bash
$ docker-compose exec assets /download-images.sh --force
```

## How The Deployment Works

Currently the [live](https://www.coops.tech/) and [dev](https://dev.coops.tech/) sites are running on [Werbarchitects shared hosting](https://webarch.net/wp).

Changes to the **dev** branch are automatically applied to the [dev site](https://dev.coops.tech/).

This works via a [crontab](https://git.coop/cotech/ansible/blob/master/roles/live2dev/tasks/main.yml#L29) which runs [a script](https://git.coop/cotech/ansible/blob/master/roles/live2dev/templates/cron.j2) which checks for changes and if there are any then it runs the [update script](https://git.coop/cotech/ansible/blob/master/roles/live2dev/templates/update.j2).

The [live site](https://www.coops.tech/) is set up exactly the same way but tracking the **master** branch.

If the [dev site](https://dev.coops.tech/) images and database needs syncing from the [live site](https://www.coops.tech/) then please contact `chris@webarchitects.coop` and ask him to run the [live2dev Ansible playbook](https://git.coop/cotech/ansible/blob/master/live2dev.yml).

## Getting Deployment Machine Access

Ask `chris@webarchitects.coop` to add your SSH public keys to the server and to email you the MySQL login details.

When you have SSH access, you can then:

```
$ ssh cotechdev@webarch1.co.uk
```

The site is in `~/sites/web`, add yourself to `~/.forward` if you wish to get emails.

If you want to change the crontab, please make changes [over here](https://git.coop/cotech/ansible/blob/master/roles/live2dev/tasks/main.yml#L29).

## Querying the WordPress database directly

Even though the format of the WordPress database is pretty horrible you can perform analytics queries on a local copy of the database which can be downloaded from the admin section of the site if you have Admin permissions.

e.g. to get the names and email addresses of co-ops that have not entered a turnover so you can nag them:

```sql
SELECT * FROM (
    SELECT post_id,  post_title, meta_value as turnover
    FROM `wp_postmeta` LEFT JOIN wp_posts on post_id = ID
    where meta_key = 'turnover'
    and post_status = 'publish'
    and meta_value = "") as noturnover
LEFT JOIN wp_postmeta on noturnover.post_id = wp_postmeta.post_id
where meta_value REGEXP  '^[^@]+@[^@]+\.[^@]{2,}$'
```
