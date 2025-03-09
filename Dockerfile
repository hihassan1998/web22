# Official PHP image with Apache
FROM php:8.3-apache

# Set the working directory to the web server's document root
WORKDIR /var/www/html

# Copy the application files to the web server directory
COPY public /var/www/html/public
COPY config /var/www/html/config
COPY includes /var/www/html/includes
COPY uploads /var/www/html/uploads
COPY index.php /var/www/html/index.php
COPY login.php /var/www/html/login.php
COPY functions.php /var/www/html/functions.php
COPY handleLogin.php /var/www/html/handleLogin.php

RUN chmod -R 777 /var/www/html/uploads

# Expose port 80 for HTTP traffic
EXPOSE 80