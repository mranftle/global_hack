<?php
	
	class Police{ 
		public $first_name; 
		public $last_name;
		public $badge_id;
		public $municipality;
		public $num_citations;
		public $num_violations;
		public $violations_sum;
		public $full_name;
		public $most_common;
		public $most_common_count;
		function __construct($badge_id){ 
			$this->$badge_id = $badge_id;

			$params_array = $this->sqlFetch($badge_id); 
			
			while($row = $params_array->fetch_assoc()){ 

				$this->first_name = $row["first_name"]; 
				$this->last_name = $row["last_name"];
				$this->municipality = $row["municipality"]; 
				$this->num_citations = $row["num_citations"];
				$this->num_violations = $row["num_violations"];
				$this->violations_sum=$row["Sum"];
				$this->most_common=$row["most_common"];
				$this->most_common_count=$row["common_count"];
				$this->full_name=$this->first_name." ".$this->last_name;
				//$this->badge_id = $row["violation_type"]; 
			}
		}

		function sqlFetch($badge_id){ 
			global $mysqli;
			$this->badge_id=$badge_id;
			$stmt = $mysqli->prepare("select first_name, last_name, municipality,(SELECT  count(*) FROM   `citations` JOIN `violations` ON `citations`.`citation_number`=`violations`.`citation_number` WHERE  `badge_number`=? GROUP  BY `violation_description` ORDER  BY COUNT(*) DESC Limit 1)as common_count,(SELECT  `violation_description` FROM   `citations` JOIN `violations` ON `citations`.`citation_number`=`violations`.`citation_number` WHERE  `badge_number`=? GROUP  BY `violation_description` ORDER  BY COUNT(*) DESC Limit 1) as most_common, (SELECT Sum(CAST((REPLACE ( `fine_amount` , '$' , '' )) AS DECIMAL(12,2))) as Sum FROM `citations` LEFT OUTER JOIN `violations` on `citations`.`citation_number`=`violations`.`citation_number` WHERE `badge_number`=?) as Sum, (SELECT COUNT(*) FROM `citations` WHERE `badge_number`=?) AS num_citations,(SELECT COUNT(*) FROM `citations` JOIN `violations` ON `citations`.`citation_number`=`violations`.`citation_number` WHERE `badge_number`=?) as num_violations from `police` where `badge_number` = ?");
			if(!$stmt){ 
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$stmt->bind_param("iiiiii",$badge_id,$badge_id,$badge_id,$badge_id,$badge_id,$badge_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result;
		}
		function displayRowForSearch(){
		echo '<tr class="info person police collapse.in" name="'.strToLower($this->first_name.' '.$this->last_name).'" data-id="'.$this->badge_id.'" data-sum="'.$this->violations_sum.'" data-municipality="'.$this->municipality.'" data-numcitations="'.$this->num_citations.'" data-numviolations="'.$this->num_violations.'" data-name="'.$this->full_name.'" data-mostcommon="'.$this->most_common.'" data-commoncount="'.$this->most_common_count.'">
						<td>
							'.$this->first_name.'
						</td>
						<td>
							'.$this->last_name.'
						</td>
						<td>
							Police
						</td>
			</tr>';
		
		}


	}

?>