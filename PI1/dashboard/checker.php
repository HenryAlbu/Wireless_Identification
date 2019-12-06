<?php 

require_once ('db.php'); 
$db = new db();
// GETS USERS FROM db.php TO DISPLAY ON index.php
$data['users'] =  $db->get_users();
echo json_encode($data);

// SENDS USER INFROMATION TO db.php TO CHAGE THE ROLE OF THE USER
if ($_POST['checker'] == 'true'){
$db->changeRole($_POST['role'],$_POST['userID']);
}

?>