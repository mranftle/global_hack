<?php
	//id,Municipality,Filed,dates_per_month,population,fines,court_fee,issued_FY2014,Avg_num_cases,Avg_num_warrants,Avg_fines_pcase,cases_per_person,warrants_per_Person,fines_per_Person
	class Court{ 
		public $id; 
		public $Municipality;
		public $Filed;
		public $dates_per_month;
		public $population;
		public $fines;
		public $court_fee;
		public $issued_FY2014;
		public $Avg_num_cases;
		public $Avg_num_warrants;
		public $Avg_fines_pcase;
		public $cases_per_person;
		public $warrants_per_Person;
		public $fines_per_Person;
		public $all;
		function __construct($id){ 
			$this->id = id;

			$params_array = $this->sqlFetch($id); 
			
			while($row = $params_array->fetch_assoc()){ 
				$this->all=$row;
				$this->id = $row["id"]; 
				$this->Municipality = $row["Municipality"];
				$this->Filed = $row["Filed"]; 
				$this->dates_per_month = $row["dates_per_month"];
				$this->population = $row["population"];
				$this->fines=$row["fines"];
				$this->court_fee=$row["court_fee"];
				$this->issued_FY2014=$row["issued_FY2014"];
				$this->Avg_num_cases=$row["Avg_num_cases"];
				$this->Avg_num_warrants=$row["Avg_num_warrants"];
				$this->Avg_fines_pcase=$row["Avg_fines_pcase"];
				$this->cases_per_person=$row["cases_per_person"];
				$this->warrants_per_Person=$row["warrants_per_Person"];
				$this->fines_per_Person=$row["fines_per_Person"];
				//$this->badge_id = $row["violation_type"]; 
			}
		}

		function sqlFetch($id){ 
			global $mysqli;
			$stmt = $mysqli->prepare("select * FROM `courts` WHERE `id`=?");
			if(!$stmt){ 
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$stmt->bind_param("i",$id);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result;
		}
		function displayRowForSearch(){
		echo '<tr class="danger person court collapse.in" name="'.strToLower($this->Municipality).'" data-everything=\''.str_replace('\"',"'",json_encode($this->all)).'\'>
						<td>
							'.$this->Municipality.'
						</td>
			</tr>';
		
		}


	}

?>