#!/bin/bash

cd /var/www/html

mysql -u $2 -p$3 $4 < ./backup/$1
