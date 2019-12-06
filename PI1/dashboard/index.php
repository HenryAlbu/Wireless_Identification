<?php 
require_once ('db.php'); 
$db = new db(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="js/jquery-1.10.2.min.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet">
	<script>
		// UPDATES THE DASHBOARD EVERY 3 SECONDS WITH NEW DATABASE INFROMATION
		function check(){
			$.ajax({
				type: 'POST',
				url: 'checker.php',
				dataType: 'json'
			}).done(function( response ) {
				$('#message-list').html(response.users);
			});
		}
		setInterval(check,3000);
	</script>
</head>
<body>
	<div class="container">
		<div class="row" id="message-list">
			<?php echo $db->get_users();?>			
		</div>
	</div>
<script>
// PASSES USER INFROMATION INTO CHECKER.PHP WHEN THE CHANGE ROLE BUTTON IS CLICKED
function changeRole(role,userID) {
$.post( 
    'checker.php', 
    { checker: true, role: role, userID: userID }
);
check();
}
</script>
</body>
</html>


