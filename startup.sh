#!/bin/bash
# Azure App Service (Linux, PHP) runs this as the site's Startup Command.
# Set it in Configuration > General settings > Startup Command to:
#   bash /home/site/wwwroot/startup.sh
set -e

APP_ROOT=/home/site/wwwroot

# Azure's default Nginx config serves from $APP_ROOT, but Laravel's
# entry point is $APP_ROOT/public — swap in a config that points there.
cp "$APP_ROOT/deploy/azure/nginx-site.conf" /etc/nginx/sites-available/default
service nginx reload

# storage/ isn't writable-by-default on a fresh deploy and the public
# symlink to storage/app/public won't exist yet.
mkdir -p "$APP_ROOT/storage/framework/"{sessions,views,cache}
chmod -R 775 "$APP_ROOT/storage" "$APP_ROOT/bootstrap/cache"
php "$APP_ROOT/artisan" storage:link --force

# Config/route/view caching needs to happen here (not at build time)
# since Azure injects Application Settings as env vars only at
# container start, not during the Oryx build step.
php "$APP_ROOT/artisan" config:cache
php "$APP_ROOT/artisan" route:cache
php "$APP_ROOT/artisan" view:cache

# Not run automatically — multiple instances restarting at once would
# each try to migrate. Run migrations manually once per release via
# the SSH console (Azure Portal > SSH), or uncomment this for a
# single-instance deployment:
# php "$APP_ROOT/artisan" migrate --force
