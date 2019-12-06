<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<?php
/*
 * This will serve as the splash page where the user will input their name and picture(if we include this)
 * The site will also grab their IP address and pass it to the next page
*/


#echo $_SERVER['REMOTE_ADDR'];

echo 
	"<div class=\"wrapper\">\n".
    	"<form class=\"form-signin\" action=\"backend.php\" method=\"post\" enctype=\"multipart/form-data\">\n".     
      	"<img src=\"logo.png\" height=\"\"> \n".
	"<input type=\"hidden\" name=\"tok\" value=\"".$_GET['tok']."\">\n".
	"<input type=\"hidden\" name=\"redir\" value=\"".$_GET['redir']."\"><br>\n".
	"<input type=\"hidden\" name=\"userIP\" value=\"".$_SERVER['REMOTE_ADDR']."\"><br>\n".
      	"<input type=\"text\" class=\"form-control\" id=\"firstName\" name=\"firstName\" placeholder=\"First Name\" required=\"\" autofocus=\"\" /><br>\n".
      	"<input type=\"text\" class=\"form-control\" id=\"lastName\" name=\"lastName\" placeholder=\"Last Name\" required=\"\"/><br>\n".     	
      	"<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\">Login</button>\n".
    	"</form>\n".
	"</div>\n";


?>


