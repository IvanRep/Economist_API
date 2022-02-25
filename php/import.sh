#!/bin/bash

cd /var/www/html

mysql -u phpmyadmin -pbananapi phpmyadmin < ./Copias_de_seguridad/$1
