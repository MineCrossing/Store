# Basic setup file to run all the commands required to make this thing work
composer update
composer install
php artisan config:cache
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
php artisan config:cache
