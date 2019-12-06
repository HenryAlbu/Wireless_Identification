<?php
$conn = mysqli_connect('localhost', 'piDB', 'piDBpassword', 'tracking_system');


// SCANS NETWORK AND INSERTS USER IP AND MAC INTO THE TRACKING TABLE
$arp_scan = shell_exec('sudo ip neigh show dev wlan0');
$arp_scan = explode("\n", $arp_scan);
$matches;

foreach($arp_scan as $scan) {	
	$matches = array();	
	if(preg_match('/^([0-9\.]+)[[:space:]]+(.+)[[:space:]]+([0-9a-f:]+)[[:space:]]+(.+)$/', $scan, $matches) == 1) {
		$ip = $matches[1];
		$desc = $matches[2];
		$mac = $matches[3];
		

		$query = "SELECT * from tracking where ip = '$ip'";
		$result = mysqli_query($conn,$query);

		if(mysqli_num_rows($result) == 0)
		{
			echo "INSIDE IF STATMENT";
			$sql = "INSERT INTO tracking (ip, mac) VALUES ('$ip', '$mac')";			
			$conn->query($sql);
    			
		}	

	}
	
	
}
$conn->close();




?>
