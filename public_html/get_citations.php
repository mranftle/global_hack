<?php
	include "database.php"; 
	//header("Content-Type: application/json");

	$cit_num = $_POST['cit_num']; 
	//var_dump($_POST);
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$dob = $_POST['dob']; 

	#var_dump($_POST);
	#if citation number not entered
	if(!empty($cit_num)){
		$stmt = $mysqli->prepare("SELECT `citations`.`citation_number`,`first_name`,`last_name`,`court_date`,`court_address`,`date_of_birth`,`court_location`,`violation_number`,`violation_description`, `warrant_status`, `warrant_number`, `status`, `status_date`, `fine_amount`, `court_cost` FROM `citations` LEFT OUTER JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE `citations`.`citation_number`=? ORDER BY `citations`.`citation_number`");
		if(!$stmt){
			exit;
		}
		$stmt->bind_param('i', $cit_num);

	} 
	else { 
		 #if not all fields return
		 if(empty($f_name) || empty($l_name) || empty($dob)) { 
		 	header("Location: my_info.php");
		 }
		 else { 
			$stmt = $mysqli->prepare("SELECT `citations`.`citation_number`,`first_name`,`last_name`,`court_date`,`court_address`,`court_location`,`violation_number`,`violation_description`, `warrant_status`, `warrant_number`, `status`, `status_date`, `fine_amount`, `court_cost` FROM `citations` LEFT OUTER JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE `first_name`=? AND `last_name`=? AND STR_TO_DATE(`date_of_birth`,'%d/%m/%Y')=STR_TO_DATE(?,'%d/%m/%Y') ORDER BY `citations`.`citation_number`");

		 	if(!$stmt){ 
		 		exit;
		 	}

		 	$stmt->bind_param('sss', $f_name, $l_name, $dob);
		 }
	}
	
	
	$stmt->execute();
	#print('execute');
	
	$result = $stmt->get_result();

	#var_dump($result);

	$data = array();
	while($row = $result->fetch_assoc()){
		 $data[] = $row;
		 #print(json_encode($row));
	}
	$stmt->close();	
	echo json_encode( $data );
	//exit;
	
?>