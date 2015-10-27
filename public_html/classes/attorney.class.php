<?php
class Attorney{ 
		public $first_name; 
		public $last_name;
		public $full_name;
		public $id;
		public $municipalityArray=Array();
		public $phone;
		public $email;
		public $work_address;
		public $zip;
		

		function __construct($first_name,$last_name){ 
			//$this->id = $id;
			$params_array = $this->sqlFetch($first_name,$last_name); 
			
			while($row = $params_array->fetch_assoc()){ 

				$this->first_name = $row["first_name"]; 
				$this->last_name = $row["last_name"];
				$job="Public Defendant";
				if($row["p_j_pd"]==0){
					$job="Prosecutor";
				}
				else if($row["p_j_pd"]==1){
					$job="Judge";
				}
				$this->municipalityArray[$row["municipality"]]=$job; 
				$this->phone = $row["phone"];
				$this->email = $row["email"];
				$this->work_address = $row["work_address"];
				$this->zip=$row["zip"];
				$this->full_name=$this->first_name." ".$this->last_name;
				//$this->badge_id = $row["violation_type"]; 
			}
		}

		function sqlFetch($first_name,$last_name){ 
			global $mysqli;
			$stmt = $mysqli->prepare("Select * from `attorney` where `first_name`=? AND `last_name`=?");
			if(!$stmt){ 
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$stmt->bind_param("ss",$first_name,$last_name);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result;
		}
		function displayRowForSearch(){
		echo '<tr class="warning person attorney collapse.in" name="'.strToLower($this->first_name.' '.$this->last_name).'" data-email="'.$this->email.'" data-phone="'.$this->phone.'" data-municipalities=\''.str_replace('\"',"'",json_encode($this->municipalityArray)).'\' data-zip="'.$this->zip.'" data-workaddress="'.$this->work_address.'" data-name="'.$this->full_name.'">
						<td>
							'.$this->first_name.'
						</td>
						<td>
							'.$this->last_name.'
						</td>
						<td>
							Attorney
						</td>
			</tr>';
		
		}


	}

?>