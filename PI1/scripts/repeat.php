<?php
$conn = mysqli_connect('localhost', 'piDB', 'piDBpassword', 'tracking_system');


// SCANS THE NETWORK AND INSERTS THE MAC ADDRESS INTO THE USER TABLE IF NOT ALREADY SET
$arp_scan = shell_exec('sudo ip neigh show dev wlan0');
$arp_scan = explode("\n", $arp_scan);
$matches;

foreach($arp_scan as $scan) {	
	$matches = array();	
	if(preg_match('/^(.+)[[:space:]]+(.+)[[:space:]]+(.+)[[:space:]]+(.+)$/', $scan, $matches) == 1) {
		$ip = $matches[1];
		$desc = $matches[2];
		$mac = $matches[3];
		

		$query = "SELECT * from users where userIP = '$ip' and mac = ''";
		$result = mysqli_query($conn,$query);

		if(mysqli_num_rows($result) > 0)
		{
			
			$sql = "UPDATE users INNER JOIN tracking ON users.userIP = tracking.ip SET users.mac = tracking.mac WHERE users.userIP = '$ip'";			
			$conn->query($sql);
    			
		}	

	}
	
	
}


// SETS AND CHANGES THE SIGNAL STRENGTH INTO THE SIGNAL COLUMN IN THE TRACKING TABLE
$station_dump = shell_exec('sudo iw wlan0 station dump | grep -E \'Station|signal\'');
$station_dump = explode("Station ", $station_dump);
$find = array(" (on wlan0)","	signal:  	"," dBm","\n","\r","-");
$replace = array(" ");
$station_dump = str_replace($find,$replace,$station_dump);
$station_dump_matches;


foreach($station_dump as $scan) {	
	$station_dump_matches = array();	
	if(preg_match('/^(.+)[[:space:]]+(.+)[[:space:]]+(.+)$/', $scan, $station_dump_matches) == 1) {

		$mac = $station_dump_matches[1];
		$signal = $station_dump_matches[2];

		$sql = "UPDATE tracking SET pi1 = '$signal' WHERE mac = '$mac'";			
		$conn->query($sql);  


		$query2 = "SELECT * from tracking where mac = '$mac'";
		$result2 = mysqli_query($conn,$query2);

		
		if(mysqli_num_rows($result2) > 0)
		{
			
			$sql2 = "UPDATE tracking SET tracking.status = 1 WHERE tracking.mac = '$mac'";			
			$conn->query($sql2);
    			
		}  			

	}
	
	
}



?>