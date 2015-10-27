<?php
require 'database.php';
	
	class Person{ 
		public $first_name; 
		public $last_name;
		public $badge_id
		public $municipality;
		public $num_citations;
		public $num_violations
		public $violation_type
		public $dept;

		function _construct($badge_id){ 
			$this->$badge_id = $badge_id;

			$params_array = sqlFetch($badge_id); 

			while($row = $result->fetch_assoc()){ 

				$this->$first_name = $row["first_name"]; 
				$this->$last_name = $row["last_name"];
				$this->$municipality = $row["municipality"]; 
				$this->$num_citations = $row["num_citations"];
				$this->$num_violations = $row["num_violations"];
				$this->$violation_type = $row["violation_type"]; 
				$this->$dept = $row["dept"];
			}

		}

		function sqlFetch($badge_id){ 

			$stmt = $mysqli->prepare("select first_name, last_name, municipality, num_citations, num_violations, violation_type, dept from police_officers where badge_id = '$badgeid");
			if(!$stmt){ 
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}

			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result
		}
	}