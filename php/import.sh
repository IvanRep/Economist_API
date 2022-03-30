#!/bin/bash

cd /var/www/html

mysql -u phpmyadmin -pbananapi economist < ./backup/$1
