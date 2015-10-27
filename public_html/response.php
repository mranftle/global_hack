<?php
//SELECT * FROM `citations` JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE 1 ORDER BY `citations`.`citation_number`
   /*
   
   NEED TO ADD WHETHER OR NOT THERE IS A WARRANT!!!
   
   */
   
    include "database.php";
    $return="";
    if((!empty($_POST["Body"])&&!empty($_POST["AccountSid"])&&$_POST["AccountSid"]=="AC5116442e315629c15424c8dbbecfeb5f")||true){//Add other post stuff
    	//$_POST["Body"]="110852006";
    	preg_match_all("/\d{5,}/x",$_POST["Body"],$out, PREG_PATTERN_ORDER);//check for citation #
    	$citationCheck=False;
		if(!empty($out[0][0])){ 
		$citationCheck=True;
		}
		else{
			preg_match_all("/([A-z,'-]+)\s([A-z,'-]+)\s(\d{2}\/\d{2}\/\d{4})/x",$_POST["Body"],$out, PREG_PATTERN_ORDER);//check for citation #
    		$nameCheck=False;
			if(!empty($out[0][0])){ 
				$nameCheck=True;
			}
		}
		
    	if(!empty($out[0][0])){
    		if($citationCheck){
    			$stmt = $mysqli->prepare("SELECT `citations`.`citation_number`,`first_name`,`last_name`,`court_date`,`court_address`,`court_location`,`violation_number`,`violation_description`,`warrant_status` FROM `citations` LEFT OUTER JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE `citations`.`citation_number`=? ORDER BY `citations`.`citation_number`");
				if(!$stmt){
					exit;
				}
				$stmt->bind_param('i', $out[0][0]);
			}
			else if($nameCheck){
				$stmt = $mysqli->prepare("SELECT `citations`.`citation_number`,`first_name`,`last_name`,`court_date`,`court_address`,`court_location`,`violation_number`,`violation_description`,`warrant_status` FROM `citations` LEFT OUTER JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE `first_name`=? AND `last_name`=? AND STR_TO_DATE(`date_of_birth`,'%d/%m/%Y')=STR_TO_DATE(?,'%d/%m/%Y') ORDER BY `citations`.`citation_number`");
				if(!$stmt){
					exit;
				}
				$stmt->bind_param('sss', $out[1][0],$out[2][0],$out[3][0]);
			}
			
 			$stmt->execute();
 			$stmt->bind_result($citation_number,$first_name,$last_name,$court_date,$court_address,$court_location,$violation_number,$violation_description,$warrant_status);
 			$lastcitation="";
 			$count=0;
		
 			while($stmt->fetch()){
				if($citation_number!=$lastcitation){
				$return.="FIRST NAME: ".htmlspecialchars($first_name)."\nLAST NAME: ".htmlspecialchars($last_name)."\n";
				$return.="Court Date: ".htmlspecialchars($court_date)."\n";
				$return.="Court location: ".htmlspecialchars($court_address)."\n".htmlspecialchars($court_location)."\n";
				$return.="\n";
				$lastcitation=$citation_number;
				}
				if(!empty($violation_number)){
				$return.="Violation #: ".htmlspecialchars($violation_number)."\n Violation DESC: ".htmlspecialchars($violation_description)."\n";
				if($warrant_status=="TRUE"){
				$return.="WARRANT ISSUED\n";
				}
				else if($warrant_status=="FALSE"){
				$return.="No warrant has been issued\n";
				}
				}
				$count++;
			}
			if($count==0){
				$return.="No data found with that information. Please type in either: \n your citation number i.e. \"4239048\" \n or your First name Last name DOB(DD/MM/YYYY) i.e. \"John Doe 01/01/1990\"";
			}
 
		$stmt->close();	
    }
    if($return==""){
    $return.="Welcome to My Saint Louis Mobile. Please type in either: \n your citation number i.e. \"4239048\" \n or your First name Last name DOB(DD/MM/YYYY) i.e. \"John Doe 01/01/1990\"";
    }
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo"<Response>
    <Message>".$return."</Message>
		</Response>";
    }
    
   /* if($_POST["Body"]=="Test"){
    	$return.="WO!";
    }
    else{
    	$return.="Oh :(";
    }*/
?>

