<?php
$mysqli = new mysqli('localhost', 'hacksquad', 'codes', 'hacksquad');
 
	if($mysqli->connect_errno) {
		//printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
	}
	
?>