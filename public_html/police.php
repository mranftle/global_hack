<?php
if(empty($_GET["id"])||!is_numeric($_GET["id"])){
header("Location: person_search.php");
}
include "database.php";
include "classes/police.class.php";
$police=new Police($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Officer/Attorney</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	
  </head>
  <body>
  <div class="panel panel-default">
  	<div class="panel-heading">
    	<h2 class="" style="text-align:center;">Officer <?php echo $police->full_name; ?></h2>
  	</div>
  <div class="panel-body">
    	<?php
    	echo "Municipality: ".$police->municipality."<br>";
    	echo "Number of citations issued: ".$police->num_citations."<br>";
    	echo "Number of violations issued: ".$police->num_violations."<br>";
    	echo "Total amount of fines by this officer: $".$police->violations_sum."<br>";
    	echo "Average amount of a fine by this officer: $".($police->violations_sum/$police->num_violations)."<br>";
    	?>
  		</div>
	</div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
    </HTML>
