# Lunch order (Laravel 5 App)

### Prerequisites 
* php v7.1.x, [see](https://laravel.com/docs/installation) Laravel specific requirements
* Apache v2.4.18 with ```mod_rewrite```
* MySql v5.7.x
* [Composer](https://getcomposer.org) v1.6.3
* [node-js](https://github.com/creationix/nvm) >=8.9.3 and [yarn](https://yarnpkg.com/en/) >=1.5.x

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
```
* You should rebuild these cache on each new deployment


### Asset building
* This project is using [Laravel-Mix](https://github.com/JeffreyWay/laravel-mix)
* You can use standard terminal commands:
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

### 3rd party services used
* E-mail service
* [Bugsnag](https://www.bugsnag.com/) error reporting service (optional)
