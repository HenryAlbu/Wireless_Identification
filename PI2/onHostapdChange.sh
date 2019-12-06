#!/bin/bash

# SET WIFI RANGE OF THE PI TO A FEW METERS
sudo iw dev wlan0 set txpower fixed 100


# IF USER CONNECTS TO NETWORK 
if [[ $2 == "AP-STA-CONNECTED" ]]
then  
  # RUNS THE CHECKER PHP SCRIPT AND PASSES THE PARAMETER 1
  sudo php -f /var/www/html/scripts/checker.php $3 1
  echo "someone has connected with mac id $3 on $1"
fi
# IF USER DISCONNECTS FROM NETWORK
if [[ $2 == "AP-STA-DISCONNECTED" ]]
then
  # RUNS THE CHECKER PHP SCRIPT AND PASSES THE PARAMETER 0
  sudo php -f /var/www/html/scripts/checker.php $3 0
  echo "someone has disconnected with mac id $3 on $1"
fi

