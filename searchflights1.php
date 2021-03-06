<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">

	<title> Customer Page </title>


	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- JS Files - Jquery Bootstrap -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




</head>

<body>

	
	<div class = "wrapper">
		
		<header class="small">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#" data-toggle="modal" data-target="#basicModal" >Login</a></li>
							
				</ul>
		</header>		
		
		<div id = "breaksection2" style="height:50px;">
		</div>
		
		<form class="form-signin" action='makereservation.php' method='POST'>
		<div class="row">
				
					
					<?PHP  

						if(isset ($_POST ['Submit']))
						{
				
							
							$departs = $_POST['searchdepart'];
							$arrives = $_POST['searcharrive'];
							$date1 = $_POST['searchdate1'];
							$date2 = $_POST['searchdate2'];
							$class = $_POST['searchClass'];
							
							$departs = substr($departs, 0,3);
							$arrives = substr($arrives, 0,3);
							
							$day1 = substr($date1, 0,10);
							$day2 = substr($date2, 0,10);
							
							$servername = "localhost";
							$user = "root";
							$pass = "mfs12";
							$dbname = "airline";

							$con = mysqli_connect($servername, $user, $pass, $dbname);

							if (mysqli_connect_errno())
							{
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							if($class == 'Economy')
							{
								$sql = "SELECT flight_id,date,economy_price as price From customer_flight_view WHERE departs = '$departs' and arrives = '$arrives' and date BETWEEN DATE_SUB('$day1', INTERVAL 2 DAY) and DATE_ADD('$day1', INTERVAL 2 DAY) ";
							}
							else
							{	
								$sql = "SELECT flight_id,date,business_price as price From customer_flight_view WHERE departs = '$departs' and arrives = '$arrives' and date BETWEEN DATE_SUB('$day1', INTERVAL 2 DAY) and DATE_ADD('$day1', INTERVAL 2 DAY) ";
							
							}
							$result = mysqli_query($con,$sql);
							
							$selection1= "";
							$selection2= "";
							$selection3= "";
							
							if($result)
							{
								if ($result->num_rows > 0) 
								{
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$id = $row["flight_id"];
										$selection1 = $selection1 	.	"<th>"
														.	$row["date"]
														.	"</th>	";
										$selection2 = $selection2 	.	"<td>"
														.	$row["price"]
														.	"$</td>	";
										$selection3 = $selection3 	.	"<td>"
														.	"<input type='radio' name='radio1' value='$id' data-toggle='collapse' data-target='#t1'>"
														.	"</td>";
									}	
								} else {
									$selection1= "<td> NO FLIGHTS AVAILABLE <a href = 'index.php' class='btn btn-primary'> GO BACK</a></td>";
								}
							}

							$html = "<div class='col-md-12'>	<div class='panel panel-success'>";
							$html = $html. "<div class='panel-heading'> Flights are within 2 days before and after from your selection </button></div>
												<div class='panel-body'>
												<h3> OUTBOUND FROM : $departs </h3>
												<table class='table table-sm'>
												<thead class='thead-inverse'>";
								
							$html = $html. "<tr>"  .$selection1 . "</tr></thead><tbody>";
							$html = $html. "<tr>"  .$selection2 . "</tr>";
							$html = $html. "<tr>"  .$selection3 . "</tr></tbody></table>";
							$html = $html.  "<div id='t1' class='collapse'>	<h3> INBOUND  FROM $arrives </h3><table class='table table-sm'>
									 <thead class='thead-inverse'>";
							
							if($class == 'Economy')
							{
								$sql = "SELECT flight_id,date,economy_price as price From flight NATURAL JOIN route WHERE departs = '$arrives' and arrives = '$departs' and date > '$day1' and date BETWEEN DATE_SUB('$day2', INTERVAL 2 DAY) and DATE_ADD('$day2', INTERVAL 2 DAY)  ";
							}
							else
							{	
								$sql = "SELECT flight_id,date,business_price as price From flight NATURAL JOIN route WHERE departs = '$arrives' and arrives = '$departs' and date > '$day1' and date BETWEEN DATE_SUB('$day2', INTERVAL 2 DAY) and DATE_ADD('$day2', INTERVAL 2 DAY) ";
							
							}
							
							$result = mysqli_query($con,$sql);
							$selection1= "";
							$selection2= "";
							$selection3= "";
							
							if($result)
							{
								if ($result->num_rows > 0) 
								{
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$id = $row["flight_id"];
										$selection1 = $selection1 	.	"<th>"
														.	$row["date"]
														.	"</th>	";
										$selection2 = $selection2 	.	"<td>"
														.	$row["price"]
														.	"$</td>	";
										$selection3 = $selection3 	.	"<td>"
														.	"<input type='radio' name='radio2' value='$id' data-toggle='collapse' data-target='#t2'>"
														.	"</td>";
									}	
								} else {
									$selection1= "<td> NO FLIGHTS AVAILABLE <a href = 'index.php' class='btn btn-primary'> GO BACK</a></td>";
								}
							}
							
							$con->close();
							
							$html = $html. "<tr>"  .$selection1 . "</tr></thead><tbody>";
							$html = $html. "<tr>"  .$selection2 . "</tr>";
							$html = $html. "<tr>"  .$selection3 . "</tr></tbody></table></div></div></div>";
							echo $html;
						}
					?>
			</div>
		</div>
		<div class='row'>
			<div id='t2' class='collapse'>
			
				<div class="col-md-12">
					<div class="panel panel-success">
						<div class="panel-heading"> Choose action </button></div>
						<div class="panel-body">
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#basicModal" class='btn btn-warning'>You need to login before making reservations or buying tickets</a>
							</div>
							<div class="col-md-4">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	
		</form>
	</div>


	<!-- Modal for login -->
	<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">User Login</h4>
				</div>
				<div class="modal-body">

					<form class="form-signin" action='login.php' method='POST'>
						<label for="user_name" class="sr-only">User Name</label>
						<input type="text" name='user_name' id='user_name' class="form-control" placeholder="User Name" required="" autofocus="">
						<label for="inputPassword" class="sr-only">Password</label>
						<input type="password" name='inputPassword' id='inputPassword' class="form-control" placeholder="Password" required="">
						<input type='submit' name='Submit' value='Sign In' class='btn btn-primary'/>
					</form>
			</div>
		</div>
	</div>
</body>
</html>
