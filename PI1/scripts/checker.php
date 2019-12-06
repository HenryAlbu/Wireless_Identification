<?php
$conn = mysqli_connect('localhost', 'piDB', 'piDBpassword', 'tracking_system');


// SCANS THE NETWORK AND INSERTS THE MAC ADDRESS INTO THE USER TABLE IF NOT ALREADY SET
$arp_scan = shell_exec('sudo ip neigh show dev wlan0');
$arp_scan = explode("\n", $arp_scan);
$matches;

foreach($arp_scan as $scan) {	
	$matches = array();	
	if(preg_match('/^([0-9\.]+)[[:space:]]+(.+)[[:space:]]+([0-9a-f:]+)[[:space:]]+(.+)$/', $scan, $matches) == 1) {
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


// IF THE USER IS CONNECTING THEN SET TRACKING STATUS TO 1 (ONLINE)
if ($argv[2] == 1){

	$query = "SELECT * from tracking where mac = '$argv[1]'";
	$result = mysqli_query($conn,$query);

	if(mysqli_num_rows($result) > 0)
	{
 		$sql = "UPDATE tracking SET status=1 WHERE mac='$argv[1]'";
		$conn->query($sql);
		
		
	} else {
 		print_r("USER DOES NOT EXIST");
	}	
	
	
	$conn->close();
}
// IF THE USER IS DISCONNECTING THEN SET TRACKING STATUS TO 0 (OFFLINE)
else{
	$query = "SELECT * from tracking where mac = '$argv[1]'";
	$result = mysqli_query($conn,$query);

	if(mysqli_num_rows($result) > 0)
	{
 		$sql = "UPDATE tracking SET status=0, pi1=100 WHERE mac='$argv[1]'";
		$conn->query($sql);
	}else {
 		print_r("USER DOES NOT EXIST");
	}		
	
	
	$conn->close();	
}

?>
