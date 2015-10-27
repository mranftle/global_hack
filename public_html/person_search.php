<?php
include "database.php";
include "classes/police.class.php";
include "classes/attorney.class.php";
/*
UPDATE `citations_copy` SET `badge_number`=1234566 WHERE `court_location`="FRONTENAC";
Insert into `police` (`badge_number`,`first_name`,`last_name`,`municipality`) Values (1234566,"Jane","Doe","FRONTENAC");
for importing new police
*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Officer/Attorney</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style>
	.municipality{
		color:blue;
	}
	.number{
		color:red;
	}
	.money{
		color:green;
	}
	body {
   		background:#CEDFCE;
	}
	.Public{
		color:blue;
	}
	.Judge{
		color:green;
	}
	.Prosecutor{
		color:red;
	}
	
	</style>
  </head>
  <body class="info">
   
  <!---->
  
  <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>aa
					</button> <a class="navbar-brand" href="index.php">Welcome</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="person_search.php">Search Police/Attorneys</a>
						</li>
						<li>
							<a href="court_search.php">Search Courts</a>
						</li>
						<li>
							<a href="my_info.php">My Citation Info</a>
						</li>
						
					</ul>
				</div>
				
			</nav>
  
  <!---->

  	<br><br><br><br>
  	<div class="input-group">
  		<span class="input-group-addon" id="basic-addon1">Search: </span>
  		<input type="text" class="form-control search-bar" placeholder="Name" aria-describedby="basic-addon1">
	</div>
	<br><br><br>
    <div class="panel panel-default">
    	<table class="table table-bordered table-hover">
  			<thead>
					<tr>
						<th>
							First Name
						</th>
						<th>
							Last Name
						</th>
						<th>
							Occupation
						</th>
					</tr>
			</thead>
			<?php
			function cmp($a, $b)
			{
    			return strcmp($a->full_name, $b->full_name);
			}
			$stmt = $mysqli->prepare("SELECT `badge_number` FROM `police` order by `first_name`");
			$stmt->execute();
 			$stmt->bind_result($badge_number);
 			$badges=array();
 			// var_dump($stmt->get_result()->fetch_assoc()["badge_number"]);
			
 			while ($stmt->fetch()){
				$badges[]=$badge_number;
 			}
 			$stmt->close();
 			$stmt = $mysqli->prepare("SELECT `first_name`,`last_name` FROM `attorney` order by `first_name`,`last_name`");
			$stmt->execute();
 			$stmt->bind_result($first,$last);
 			$firstNames=array();
			$lastNames=array();		
			$previousName="";
 			while ($stmt->fetch()){
 				if($previousName!=$first.$last){
				$firstNames[]=$first;
				$lastNames[]=$last;
				$previousName=$first.$last;
				}
 			}
 			$stmt->close();
 			$people=array();
 			$i=0;
 			while($i<count($firstNames)){
 				$people[]=new Attorney($firstNames[$i],$lastNames[$i]);
 			$i++;
 			}
 			
 			//var_dump($att->municipalityArray);
 			
 			foreach ($badges as $num){
 				$people[]=new Police($num);
 				//$police=new Police($num);
 				//$police->displayRowForSearch();
 			}
 			usort($people, "cmp");
 			foreach($people as $person){
 				$person->displayRowForSearch();
 			}
 			//var_dump($people);
			?>
		</table>
  		<!--<div class="panel-body">
    	<h4 class="col-md-4">Test</h4><div class="col-md-4">Test2</div>
  		</div>-->
	</div>

	<!--START MODAL-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		</div>
      		<div class="modal-body">
        		<div class="panel panel-default">
  					<div class="panel-heading">
    				<h2 class="" style="text-align:center;"><span class="name"></span></h2>
  					</div>
  					<div class="panel-body">
  						<h4 class="mainText">
  							
  						</h4>
  					</div>
					</div>
      			</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    		</div>
  		</div>
	</div>
	
	
	
	<!--END MODAL-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
    	$(".police").click(function() {
    		//var sum=$(this).data("sum");
    		var modal = $('#myModal');
    		modal.find('.mainText').html('Municipality: <span class="municipality"></span><br>\
  							Number of citations issued: <span class="numcitations number"></span><br>\
  							Number of violations issued: <span class="numviolations number"></span><br>\
  							Total amount of fines by this officer: <span class="fines money"></span><br>\
  							Average amount of a fine by this officer: <span class="avg money"></span><br>\
  							Most common violation: <span class="common"></span> (<span class="count"></span>)\
  							');
    		modal.find('.name').text("Officer "+$(this).data("name"));
    	  	modal.find('.fines').text("$"+$(this).data("sum"));
    	  	modal.find('.numcitations').text($(this).data("numcitations"));
    	  	modal.find('.numviolations').text($(this).data("numviolations"));
    	  	modal.find('.common').text($(this).data("mostcommon"));
    	  	modal.find('.count').text($(this).data("commoncount"));
    	  	modal.find('.avg').text("$"+($(this).data("sum")/$(this).data("numviolations")).toFixed(2));
    	  	modal.find('.municipality').text($(this).data("municipality").charAt(0).toUpperCase() + $(this).data("municipality").slice(1).toLowerCase());
    		$('#myModal').modal('show');
        	//window.document.location = "police.php?id="+$(this).data("id");
    	});
    	$(".attorney").click(function() {
    		var modal = $('#myModal');
    		modal.find('.mainText').html('');
    		modal.find('.name').text($(this).data("name"));
    		console.log( $(this).data("municipalities"));
    		for (var court in $(this).data("municipalities")) {
    			var job=$(this).data("municipalities")[court];
    			modal.find('.mainText').append("<span class=\""+job+"\">"+job+"</span> for "+court+"<br>");
    		}
    		modal.find('.mainText').append('Work Address: <span class="address number"></span><br>\
  							Work Email: <span class="email"></span><br>\
  							Work Phone #: <span class="phone money"></span><br>');
  			modal.find('.address').text($(this).data("workaddress")+" "+$(this).data("zip"));
  			modal.find('.email').text($(this).data("email"));
  			modal.find('.phone').text($(this).data("phone"));
    		$('#myModal').modal('show');
        	//alert();
    	});
    	$( "tr.person").collapse('show');
		$('.search-bar').on('input',function(e){
     		var words = $( ".search-bar" ).val().split(" ");
     		var containsString="";
     		for (i = 0; i < words.length; i++) { 
     			if(words[i]!=""){
    			containsString += ':contains("'+words[i]+'")';
    			}
			}
			
			console.log("test");
			if(containsString!=""){
			$("tr.person[name*='"+$( ".search-bar" ).val().toLowerCase()+"']").collapse("show");
			$("tr.person:not([name*='"+$( ".search-bar" ).val().toLowerCase()+"'])").collapse("hide");
				/*$( "tr.person"+containsString).collapse('show');
				$( "tr.person:not("+containsString+")" ).collapse('hide');*/
			}
			else{
				$( "tr.person").collapse('show');
			}
    	});
    	$('#myModal').on('show.bs.modal', function (event) {
  			/*var button = $(event.relatedTarget) // Button that triggered the modal
  			var sum = button.data('sum') // Extract info from data-* attributes
  			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  			var modal = $(this);
  			console.log(sum);
  			modal.find('.fines').text('New message to ' + sum);*/
  			//modal.find('.modal-body input').val(recipient)
		})
	});
</script>
  </body>
</html>