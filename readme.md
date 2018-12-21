# Lunch Order (Laravel 5 App)

### Prerequisites 
* php v7.2.13, [see](https://laravel.com/docs/installation) Laravel specific requirements
* Apache v2.4.34 with ```mod_rewrite```
* MySql v5.7.23
* [Composer](https://getcomposer.org) v1.8
* [node-js](https://github.com/creationix/nvm) >=10.13 and [yarn](https://yarnpkg.com/en/) >=1.12.3

### Quick setup 
* Clone this repo, checkout to ```dev``` branch
* Install dependencies
```
composer install
yarn install
```
* Write permissions on ```storage``` and ```bootstrap/cache``` folders
* Create config (copy from ```.env.example```), and update environment variables in ```.env``` file
```
cp .env.example .env
php artisan key:generate
```
* Migrate and Seed database
```
php artisan migrate
php artisan db:seed
```
* Create the symbolic link for local file uploads
```
php artisan storage:link
```
* Point your web server to **public** folder of this project
* Additionally you can run these commands on production server
```
php artisan route:cache
php artisan config:cache
php artisan view:cache
```
* You should rebuild these cache on each new deployment


### Asset building
* This project is using a custom webpack solution [Laravel-Bundler](https://github.com/ankurk91/laravel-bundler)
* You can still use standard terminal commands:
* During development
```
# incremental build
npm run watch
# hmr
npm run hot
```
* On server
```
npm run prod
```

### Credentials
* Development credentials can be found in `database/seeds`
* In production you may want to create very first user with admin role using artisan command -
```
php artisan create:user
```

### 3rd party services used
* E-mail service
