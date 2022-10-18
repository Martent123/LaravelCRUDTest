# LaravelCRUDTest
##A simply CRUD Laravel Web Application

##### Demo
[AWS](http://34.230.90.50/)
##### Installation
**If you wish to deploy on a server please check this [link](https://www.interserver.net/tips/kb/deploy-laravel-project-apache-ubuntu/)**

**If you wish to deploy on your local with sail, make sure you have docker installed, your Database service is offline (it would start another DB in your docker container). please check this [link](https://laravel.com/docs/9.x/sail#installation)**

**If you dont want to use Sail, follow the steps of basic laravel setup**
1. Install PHP and database you would like to use
```
sudo apt install php libapache2-mod-php php-mbstring php-cli php-bcmath php-json php-xml php-zip php-pdo php-common php-tokenizer php-mysql
```
2. Install and Enable the PHP CURL extension
[link](https://www.geeksforgeeks.org/how-to-install-php-curl-in-ubuntu/)

3. Install Composer
```
curl -sS https://getcomposer.org/installer | php
```
4. Go to root directory of the project
```
composer install
```
5. Install NPM
[link](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)
```
npm install
npm run dev (use prod if you are on server)
```

6. Get database ready
copy the .env.example and rename it to .env
Update the DB config.
```
php artisan migrate

php artisan migrate:refresh --seed  (if you want the default seed)
```

7. Server ready, start the server
```
php artisan serve
```

8.vist localhost to make sure its working