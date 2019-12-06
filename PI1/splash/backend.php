<?php

/*
 * This page will serve as the backend of our site and will be responsible for adding the data to
 * the database and performing any other functions that we may need(ex: the facial recognition of the other team)
 * Once all of our processes are complete and the page is loaded the user will have a continue button that once
 * clicked will give them access to the wifi
*/

//--------------------- DATA BASE STUFF --------------------

$conn = mysqli_connect('localhost', 'piDB', 'piDBpassword', 'tracking_system');
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userIP = getUserIpAddr();

$query = "SELECT * from users where ip = '$userIP'";
$result = mysqli_query($conn,$query);

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }	
    return $ip;
}

if(mysqli_num_rows($result) == 0)
{
$sql = "INSERT INTO users (firstName, lastName, userIP) VALUES ('$firstName', '$lastName', '$userIP')";
$conn->query($sql);
}

$sql = "UPDATE users INNER JOIN tracking ON users.userIP = tracking.ip SET users.mac = tracking.mac WHERE users.userIP = '$userIP'";  
$conn->query($sql);
//--------------------- END DATA BASE STUFF --------------------


$_GET['fas'] = "YES";
		$_GET['iv'] = "YES";
if (isset($_GET['fas']) and isset($_GET['iv']))  {
	$string=$_GET['fas'];
	$iv=$_GET['iv'];
	$decrypted=openssl_decrypt( base64_decode( $string ), $cipher, $key, 0, $iv );
	$dec_r=explode(", ",$decrypted);

	foreach ($dec_r as $dec) {
		list($name,$value)=explode("=",$dec);
		if ($name == "clientip") {$clientip=$value;}
		if ($name == "clientmac") {$clientmac=$value;}
		if ($name == "gatewayname") {$gatewayname=$value;}
		if ($name == "tok") {$tok=$value;}
		if ($name == "gatewayaddress") {$gatewayaddress=$value;}
		if ($name == "authdir") {$authdir=$value;}
		if ($name == "originurl") {$originurl=$value;}
		#if ($name == "originurl") {$originurl="google.com";}
	}

} else if (isset($_GET["status"])) {
	$gatewayname=$_GET["gatewayname"];
	$gatewayaddress=$_GET["gatewayaddress"];
	$originurl="";
	$loggedin=true;
} else {
	$invalid=true;
}

	echo 
	
	"<link rel=\"stylesheet\" type=\"text/css\" href=\"bootstrap.css\">".
	"<div class=\"wrapper\">\n".
    	"<form class=\"form-signin\" action=\"http://192.168.4.1:2050/nodogsplash_auth/\" method=\"get\" enctype=\"multipart/form-data\">\n".     
      	"<img src=\"logo.png\" height=\"\"> \n".
	"<input type=\"hidden\" name=\"tok\" value=\"".$_POST['tok']."\">\n".
	"<input type=\"hidden\" name=\"redir\" value=\"".$_POST['redir']."\"><br>\n".
	"<h1 style=\"color:white;text-align: center;margin: 5%;\">DO YOU AGREE TO RECEVE THE SWEET NECTAR THAT IS WIFI?</h1>\n". 
      	"<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\">AGREE</button>\n".
    	"</form>\n".
	"</div>\n";

	
?>
