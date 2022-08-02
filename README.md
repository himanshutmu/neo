# create a .env file
cp .env.example .env

# install composer dependencies
composer install

# install npm dependencies
npm install

# generate a key for your application
php artisan key:generate

# run webpack and watch for changes
npm run watch or npm run dev