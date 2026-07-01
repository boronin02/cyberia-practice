docker compose exec fpm bash
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
cat .env | grep APP_URL
exit
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan filament:cache-clear
exit
php artisan filament:clear-cached-components
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
exit
echo "SESSION_DOMAIN=localhost" >> .env
echo "SANCTUM_STATEFUL_DOMAINS=localhost:8000" >> .env
cat .env | grep -E "SESSION_DOMAIN|SANCTUM_STATEFUL_DOMAINS"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
exit
mkdir -p public/vendor/filament
ln -sf ../css/filament public/vendor/filament/css
ln -sf ../js/filament public/vendor/filament/js
ls -la public/vendor/filament/
exit
mkdir -p public/vendor/filament
cp -r public/css/filament public/vendor/filament/css
cp -r public/js/filament public/vendor/filament/js
ls -la public/vendor/filament/
exit
rm -rf public/vendor/filament
mkdir -p public/vendor/filament
cp -r public/css/filament/* public/vendor/filament/
cp -r public/js/filament/* public/vendor/filament/
ls -la public/vendor/filament/
exit
cd /var/www/public
mkdir -p css/filament
ln -sf ../vendor/filament/filament css/filament/filament
ln -sf ../vendor/filament/forms css/filament/forms
ln -sf ../vendor/filament/support css/filament/support
ln -sf ../vendor/filament/dotswan css/filament/dotswan
exit
