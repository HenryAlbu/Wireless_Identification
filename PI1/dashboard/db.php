<?php

class db{

	
	/* DASHBOARD VIEW CREATION SCRIPT
	
	CREATE OR REPLACE VIEW dashboard AS
	SELECT users.id AS userID, users.firstName, users.lastName, tracking.status, users.role, users.mac
	FROM users
	INNER JOIN tracking
	ON users.mac = tracking.mac
	*/
	
	public $db;
	
	function __construct(){
		$this->db_connect('localhost','piDB','piDBpassword','tracking_system');
	}

	
	function db_connect($host,$user,$pass,$database){
		$this->db = new mysqli($host, $user, $pass, $database);

		if($this->db->connect_errno > 0){
			die('Unable to connect to database [' . $this->db->connect_error . ']');
		}
	}
	
	/* GETS USERS FROM SELECT AND DISPLAYS ON SCREEN */
	function get_users(){
		if($result = $this->db->query('SELECT * FROM dashboard where status = 1')){
			$return = '';
			while($r = $result->fetch_object()){
				$return .= '<div class="col-md-4 mb-5">';
				$return .= '<div class="card h-100">';
				$return .= '<div class="admin-container">';				
				if ($r->pi1 > $r->pi2){	
					$return .= '<div class="floor"><img src="img/2.png"></div>';
				}else if ($r->pi1 < $r->pi2){
					$return .= '<div class="floor"><img src="img/1.png"></div>';
				}else if($r->pi1 == $r->pi2){
					$return .= '<div class="floor"></div>';
				}
				if ($r->role == 1){	
					$return .= '<div class="admin"></div>';
				}			
				$return .= '</div>';
				$return .= '<img class="card-img-top" src="img/user.jpg" alt="">';					
				$return .= '<div onclick="changeRole('.$r->role.' , \''.$r->userID.'\')" class="card-body green">';
				$return .= '<h4 class="card-title"> '.$r->firstName.' '.$r->lastName.' </h4> </div>';
				$return .= '</div></div>';
				
			}
			return $return;
		}
	}

	/* UPDATES USER ROLE IN DATABASE */
	function changeRole($role,$userID){
	if ($role == 1){
	$role = 0;
	}else if ($role == 0){
	$role = 1;
	}
	$result = $this->db->query('UPDATE users SET role = ' . $role . ' where users.id = ' . $userID . '');
		
	}

}
