<h1 align="center">Webcart application</h1>

Installation
------------
After you clone the repository, run 
```
composer install
```

Configuration
-----------------------

**Set environment**
Before using Cart application, we'll also need to prepare the environment.
Use
```
php init
```
and select your preferred environment.

The application uses database connection, so you must to set set connection in the main-config.php in your chosen environment.

**Vhost settings**
The application uses the frontend branch, so you need to set up in your virtual host file.

Apache example virtualhost settings:
```
<VirtualHost 127.0.0.1:80>
    DocumentRoot "e:/webroot/cart/frontend/web"
	    ServerName cart.local
        ServerAlias cart.local
        <Directory "e:/webroot/cart/frontend/web">
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php
            Options Indexes FollowSymLinks Includes
            AllowOverride All
            Order allow,deny
            Allow from all
            Require all granted
        </Directory>
</VirtualHost>
```

**Database Migrations**

Before using Cart application, you'll also need to prepare the database.
Use 
```php
php yii migrate 
```
and this will be create all database tables.

**Application usage**

The application is a simple webcart content managament application. 
The Backend written in PHP and communicates with frontend by API calls written by React.

**Api calls**

The API module can be found in the /common/modules/api module.
There are a several action in the controller that comprises all the webcart management.