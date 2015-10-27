<?php
include "database.php";
include "classes/court.class.php";
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
						<li>
							<a href="person_search.php">Search Police/Attorneys</a>
						</li>
						<li class="active">
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
							Municipality
						</th>
					</tr>
			</thead>
			<?php
			$stmt = $mysqli->prepare("SELECT `id` FROM `courts` order by `Municipality`");
			$stmt->execute();
 			$stmt->bind_result($id);
 			$ids=array();
 			// var_dump($stmt->get_result()->fetch_assoc()["badge_number"]);
			
 			while ($stmt->fetch()){
				$ids[]=$id;
 			}
 			$stmt->close();
 			foreach($ids as $id){
 			$court=new Court($id);
 			$court->displayRowForSearch();
 			//var_dump($court);
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
    	$(".court").click(function() {
    		//id,Municipality,Filed,dates_per_month,population,fines,court_fee,issued_FY2014,Avg_num_cases,Avg_num_warrants,Avg_fines_pcase,cases_per_person,warrants_per_Person,fines_per_Person
    		var modal = $('#myModal');
    		modal.find('.mainText').html('');
    		modal.find('.name').text($(this).data("everything").Municipality);
    		var data=$(this).data("everything");
    		modal.find('.mainText').append('Cases filed: <span class="number">'+data.Filed+'</span><br>\
  							Court dates per month: <span class="money">'+data.dates_per_month+'</span><br>\
  							Population of municipality: <span class="municipality">'+data.population+'</span><br>\
  							Total fines: <span class="money">$'+Math.round(data.fines*100)/100.00+'</span><br>\
  							Court fee: <span class="money">$'+Math.round(data.court_fee*100)/100.00+'</span><br>\
  							Warrants issued in 2014: <span class="municipality">'+Math.round(data.issued_FY2014*100)/100.00+'</span><br>\
  							Average number of cases per session: <span class="municipality">'+Math.round(data.Avg_num_cases*100)/100.00+'</span><br>\
  							Average number of warrants per session: <span class="municipality">'+Math.round(data.Avg_num_warrants*100)/100.00+'</span><br>\
  							Average fines per case: <span class="municipality">'+Math.round(data.Avg_fines_pcase*100)/100.00+'</span><br>\
  							Average number of cases per person: <span class="municipality">'+Math.round(data.cases_per_person*100)/100.00+'</span><br>\
  							Average number of warrants per person: <span class="municipality">'+Math.round(data.warrants_per_Person*100)/100.00+'</span><br>\
  							Average number of fines per person: <span class="municipality">'+Math.round(data.fines_per_Person*100)/100.00+'</span><br>\
  							');
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
	});
</script>
  </body>
</html>