##this instalation was made using the following link

https://platzi.com/tutoriales/2066-docker/10667-docker-para-laravel-mysql/


## Docker usage

create containers 

`docker-compose build`

to run the containers execute

`docker-compose up -d`

to stop all containers execute 

`docker-compose down`


## Docker configurations
docker-compose.yml file

if you change the name of the service, just you need to take a moment to put special attention on service php
if the php container name is php_container, just ensure that the nginx configuration is pointing to the right name in file nginx/default.conf line 14

`
location ~ \.php$ {  
    try_files $uri =404; 
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass php_container:9000;  <<< HERE 
    fastcgi_index index.php; 
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param PATH_INFO $fastcgi_path_info;
  }
`

execute bash inside the container

`docker exec -it php /bin/sh`

## Laravel commands what you most need to execute

Inside the <php_container> container

`docker exec -it <php_container> /bin/sh`


## Create a Laravel prooject
one all is working with docker, now you need to create a new laravel project, for that you need to execute

`composer create-project laravel/laravel:^11.0 .`

if is necessary use flag --force if the directory is not empty


**you need to execute the following commands to complete the setup**
1) 'composer install`
2) `php artisan key:generate`


## DB configuration
For the database, just put the name of the mysql container under the laravel .env file
and change the variable DB_HOST= <MYSQL_CONTAIINER_NAME>

DB_CONNECTION=mysql

**DB_HOST=mysql_melomandas**

DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret


## Auth in laravel
If you want to accelerate the development procedure, you can user the classic style for make auth

1) `composer require laravel/ui --dev`
2) `php artisan ui bootstrap --auth`
3) `npm install && npm run build]`
4) `php artisan migrate`



## Requirements
As a advance project, this is built in the same way as other complex projects, and for that reason it needs third party packages to improve the functionality and security as well.

PHP/Laravel packages

to handle in the better way of HTML tables and the whole functionality

`composer require yajra/laravel-datatables-oracle`


`add more packages here as needed, just add the package and a brief description`


