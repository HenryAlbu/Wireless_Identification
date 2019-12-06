#!/bin/sh

while true
do 
#RUNS THE REPEAT.PHP SCRIPT EVERY SECOND
sudo php -f /var/www/html/scripts/repeat.php
#RUNS THE INSERTER.PHP SCRIPT EVERY SECOND
sudo php -f /var/www/html/scripts/inserter.php
sleep 1s
done
