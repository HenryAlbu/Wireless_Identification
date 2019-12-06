# How To Replicate

DISCLOSURE: these steps were done on two Raspberry  Pi Model 3. We are unsure if the following steps will work on older models. 

### Raspberry Pi #1 (Main Pi):
The Main Pi will be the one located in the entrance of the building. It is known as the Main Pi because it will have a lot more scripts running on it than the other Pi. It also servers as the server that runs the database and hosts the captive portal for when a user first logs in.

**Step 1:** Install the latest version of [RaspbianOS](https://www.raspberrypi.org/downloads/raspbian/ "RaspbianOS"). We used version (September 2019).

**Step 2:** Install Apache. We used version (2.4.38).
`sudo apt install apache2`

**Step 3:** Install MySql. We used version (15.1)
`sudo apt install mysql-server`

**Step 4:** Install PHP. We used version (7.3.9-1) 
`sudo apt install php libapache2-mod-php php-mysql`

**Step 5:** Import the sql file located in the "database" folder into the mysql database 

**Step 6:** Install NoDogSplash. Nodogsplash is a Captive Portal that offers a simple way to provide restricted access to the Internet by showing a splash page to the user before Internet access is granted. We used version (4.3). We followed the instructions [here](https://pimylifeup.com/raspberry-pi-captive-portal/ "here") to install NoDogSplash.

**Step 7:** Replace the default captive portal page with the custom portal located in this github repo (PI1/dashboard). 

**Step 8:** Make the scripts named "repeater.sh" and "onHostapdChange.sh" located in the "PI1" folder run on device startup. 

**Step 9:** Place the folders "splash", "dashboard", and "scripts" located in the folder "PI1" into the directory (/etc/www/html) of the Pi.


### Raspberry Pi #2:

**Step 1:** Change Line #1 of "PI2/scripts/checker.php" and "PI2/scripts/repeat.php" to reflect the IP of the Main Pi in order to update the database.
`$conn = mysqli_connect('MAIN_PI_IP', 'pi2', 'piDBpassword', 'tracking_system');
`

**Step 2:** Make the scripts named "repeater.sh" and "onHostapdChange.sh" located in the "PI2" folder run on device startup.

# Folders/Scripts And What They Do

Shell Scripts

File  | Function
------------- | -------------
repeater.sh  |  This is a shell script that runs on boot every second. The objective of this file is to run the reapeat.php and inserter.php files
onHostapdChange.sh  | This is shell script runs on boot and runs in the background in order to check when a device is connected and disconnected. It runs the checker.php and inserter.php

PHP Scripts

File  | Function
------------- | -------------
inserter.php  | Inserts user into the tracking table (sets ip and mac into tracking)
checker.php  | Runs the same function as repeter.php to set the mac in the users table just in case the repeater.sh that runs every 10 secs fails this will launch on connect and disconnect. Also sets 0 or 1 if connected or disconnected into the tracking table
reapeat.php  | Sets the mac into the users table. It also sets the signal streght into the tracking table. 

Folders

Folders  | Function
------------- | -------------
PI1/dashboard  | Hosts all the files needed for the dashboard
PI1/scripts  | Hosts all the php scripts needed for PI2
P11/splash  | Hosts the custom splash screen a user sees when connecting to WiFi
PI2/scripts  | Hosts all the php scripts needed for PI2
database  | Contains the tracking_system.sql file
