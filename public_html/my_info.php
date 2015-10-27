<!DOCTYPE html>
<html land = "en">
	<head> 
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Citation Info</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<style>
			body {
			  background-color:#fff;
			  -webkit-font-smoothing: antialiased;
			  font: normal 14px Roboto,arial,sans-serif;
			}

			.container {
			    padding: 25px;
			    position: fixed;

			}

			.form-search { 
				background-color: #EDEDED;
			    padding-top: 10px;
			    padding-bottom: 20px;
			    padding-left: 20px;
			    padding-right: 20px;
			    border-radius: 15px;
			    border-color:#d2d2d2;
			    border-width: 5px;
			    box-shadow:0 1px 0 #cfcfcf;


			}

			h4 { 
			 border:0 solid #fff; 
			 border-bottom-width:1px;
			 padding-bottom:10px;
			 text-align: center;
			}

			.form-control {
			    border-radius: 10px;
			}

			.wrapper {
			    text-align: center;
			}

	    	h1{ 
	    		font-family: Arial, Helvetica, sans-serif;
	    		text-align: left;
	    	}
	    	h2{ 
	    		color:black;
	    		font-family: Arial, Helvetica, sans-serif;
	    		/*text-align: left;*/
	    		font-size: medium;

	    	}
	   		body {
   				background:#CEDFCE;
			}
			.form-actions {
   				margin: 0;
				background-color: transparent;
				text-align: center;
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
									<a href="my_info.php">My Citation Info</a>
								</li>
								
							</ul>
						</div>	
					</nav>


	
				<div>
						<br><br><br><br>
						<form class = "form-inline"> 
							<div class = "form-group"> 
								Please enter ether the Citation Number or your Personal Information (First Name, Last Name, Phone#)
							</div>
						</form>
						<br>
					    <form class="form-inline">
					        <div class="form-group">
					      	    <label for="cit_num">Citation Number:</label>
    								<input type="text" class="form-control" id="cit_num">
  						   </div>
  						   <div class="form-group space">
					      	    <label for="cit_num">First Name:</label>
    								<input type="text" class="form-control" id="f_name">
  						   </div>
  						   <div class="form-group">
					      	    <label for="cit_num">Last Name:</label>
    								<input type="text" class="form-control" id="l_name">
  						   </div>
  						    <div class="form-group">
					      	    <label for="cit_num">Birthday:</label>
    								<input type="text" id="dob" class="form-control" placeholder="Date of Birth(DD/MM/YYYY)">
  						   </div>
  						   <div class = "form-group"> 
  						   		<button type = "button" id = "get_cit" class="btn btn-primary">Search</button>
  						   </div>
  						</form>
  				</div>
  				<br><br><br>

  				<div 


				<table id="table1" class = "table-responsive table-striped table-bordered table-condensed">
					<thead>
					</thead>
				</table>
		<!-- <!-- <!-- 				</table> -->

					<!-- 		//citation_number: 938854466
						court_address: "7150 Natural Bridge Road"
						court_cost: "$24.50"
						court_date: ""
						court_location: "BEVERLY HILLS"
						date_of_birth: "8/11/1978 0:00"
						fine_amount: "$101.14 "
						first_name: "Kathleen"
						last_name: "Evans"
						status: "CONT FOR PAYMENT"
						status_date: "8/13/2015"
						violation_description: "Failure to Obey Electric Signal"
						violation_number: "938854466-01"
						warrant_number: ""
						warrant_status: "FALSE" -->
			<!-- <table>
			    <thead>
			        <tr>
			            <th>citation_number</th> 
			            <th>court_address</th>
			            <th>court_cost</th>
			            <th>court_date</th> 
			            <th>court_location</th> 
			            <th>fine_amount</th> 
			            <th>status</th>
			            <th>status_date</th> 
			            <th>violation_decription</th> 
			            <th>violation_number</n>
			            <th>warrent_number</th>
			            <th>warrent_status</th>
           
        			</tr>
    			</thead>
		    <tbody data-bind="foreach: teams">
		        <tr>
		            <td data-bind="text: User_Name"></td>
		            <td data-bind="text: score "></td>
		            <td data-bind="text: team "></td>
		        </tr>
		    </tbody>
		</table> --> 
  		<!--<div class="panel-body">
    	<h4 class="col-md-4">Test</h4><div class="col-md-4">Test2</div>
  		</div>-->
  	<!--
					
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



					<!--JQuery script -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			    	<!-- Include all compiled plugins (below), or include individual files as needed -->
			   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
					<script>

						function setData(data){ 
							// for (var k in data[0]){ 
							// 	console.log(data[0]);
							// 	 switch (data[0]){ 
							// 	 	case "citation_number":
							// 	 		data[0] = "Citation #"; 
							// 	 	case "first_name": 
							// 	 		data[0] = "First Name"; 
							// 	 	case "last_name":
							// 	 		data[0]= "Last Name"; 
							// 	 	case "court_date":
							// 	 		data[0] = "Court Date"; 
							// 	 	case "court_address":
							// 	 		data[0] = "Court Address";
							// 	 	case "date_of_birth":
							// 	 		data[0]= "Date of Birth";
							// 	 	case "court_location":
							// 	 		date[0] = "Court Location"; 
							// 	 	case "violation_number": 
							// 	 		date[0] = "Violation #"; 
							// 	 	case "violation_description":
							// 	 		date[0] = "Violation Description"; 
							// 	 	case "warrant_status": 
							// 	 		date[0] = "Warrent Status"; 
							// 	 	case "warrant_number":
							// 	 		date[0]= "Warrant #"; 
							// 	 	case "status": 
							// 	 		date[0]="Status Date": 
							// 	 	case "fine_amount":
							// 	 		date[0] = "Fine Amount"; 
							// 	 	case "court_cost":
							// 	 	 	date[0]= "Court Cost"; 
							// 	 }
							// }
				            var table = $('<table border=1>');
				            var tblHeader = "<tr>";
				            for (var k in data[0]) tblHeader += "<th>" + k + "</th>";
					            tblHeader += "</tr>";
					            $(tblHeader).appendTo(table);
					            $.each(data, function (index, value) {
					                var TableRow = "<tr>";
					                $.each(value, function (key, val) {
					                    TableRow += "<td>" + val + "</td>";
					                });
					                TableRow += "</tr>";
					                $(table).append(TableRow);
				            });
				            return ($(table));
						}

						
				


						$('#get_cit').click(
							function(event){ 
								$.post( 
									"get_citations.php", 
			  						{
			  							cit_num: document.getElementById("cit_num").value, 
			  							f_name: document.getElementById("f_name").value,
			  							l_name: document.getElementById("l_name").value,
			  							dob: document.getElementById("dob").value,
			  						},

									function(data){ 
										console.log(data);
										var mydata = eval(data);
										var table = setData(mydata);
										$(table).appendTo("#table1");
										//showTable();
										// setData(data);
									}, 
									"json"
								)
								.fail(function(){ 
								alert("Search Error");
									//hideTable();

								});
							}
						);

						// $('#get_pi').click(
						// 	function(event){ 
						// 		$.post( 
						// 			"get_citations.php", 
			  	// 					{
			  	// 						cit_num: document.getElementById("cit_num").value, 
			  	// 						f_name: document.getElementById("f_name").value,
			  	// 						l_name: document.getElementById("l_name").value,
			  	// 						dob: document.getElementById("dob").value
			  	// 					},
						// 			function(data){ 
						// 				 console.log(data);
						// 				 setData(data);
						// 			}, 
						// 			"json"
						// 		)
						// 		.fail(function(){ 
						// 			alert("Search Error");
						// 		});
						// 		document.getElementById("cit_num").value = "";
			  	// 				document.getElementById("f_name").value = "";
			  	// 				document.getElementById("l_name").value = "";
			  	// 				document.getElementById("dob").value = "";
						// 	}
						// );

						

				    </script>

			</div>
		</div>
	</body>
</html>
