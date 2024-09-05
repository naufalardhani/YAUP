#!/bin/bash

su postgres -c '/usr/lib/postgresql/15/bin/pg_ctl -D /var/lib/postgresql/data start'
su postgres -c 'psql -c "ALTER USER postgres PASSWORD '\''postgres'\'';"'
su postgres -c 'psql -c "CREATE DATABASE yaup;"'

echo $FLAG_1 > /var/www/html/webroot/assets/flag.txt
chmod 000 /var/www/html/webroot/assets/flag.txt
chown www-data:www-data /var/www/html/webroot/assets/flag.txt

echo $FLAG_3 > /flag.txt
chmod 400 /flag.txt

/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf --pid=/var/run/supervisord.pid