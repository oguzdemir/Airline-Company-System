<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script src="countdown.js"></script>
	
	<link href='https://fonts.googleapis.com/css?family=New+Rocker' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="jquery.bootstrap-touchspin.js"></script>
	<!-- ... -->
	  <script type="text/javascript" src="bower_components/moment/min/moment.min.js"></script>
	  <script type="text/javascript" src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	  <link rel="stylesheet" href="bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	  <link rel="stylesheet" type="text/css" href="manager_style.css">
	<title> Manager </title>
</head>

<!-- Openning modal on delete application -->
<?PHP
	
	if(isset($_GET['function']))
	{		
		if($_GET['function'] == 1 )
		{
			echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#editModal').modal('show');
				});
				</script>";		
		}
		if($_GET['function'] == 2 )
		{
			echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#editSuccess').modal('show');
				});
				</script>";		
			header('Refresh: 2; URL=airports.php');
		}
		if($_GET['function'] == 3 )
		{
			echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#deleteSuccess').modal('show');
				});
				</script>";		
			header('Refresh: 2; URL=airports.php');
		}	
		if($_GET['function'] == 4 )
		{
			echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#deleteFail').modal('show');
				});
				</script>";		
			header('Refresh: 2; URL=airports.php');
		}			
	}
	
?>


<body>
	
	<div class = "wrapper">
		<header>
		
			<ul>
				<li>Welcome Manager</li>
				<li><button type="button" class="btn btn-primary">LOG OUT</button></li>
			</ul>
	
		</header>		
		
		<div id = "breaksection2">
		</div>
		<div class="row">
			<div class="col-sm-2">
			
				<nav class="navbar navbar-default" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><b>Airline Corp</b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li><a href="index.html">Flights</a></li>
							<li><a href="routes.html">Routes</a></li>
							<li><a href="crews.html">Crews</a></li>
							<li class="active"><a href="airports.php">Airports</a></li>	
							<li><a href="customers.html">Customers</a></li>
							<li><a href="flights.html">Flight Information</a></li>
							<li><a href="planes.html">Planes</a></li>
						</ul>
					 </div><!-- /.navbar-collapse -->
				</nav>
			</div>
			
			<div class="col-sm-10">
				
					<h2>AIRPORTS</h2>
					<h3><button class="btn btn-lg btn-primary " data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-plus"></i>Add Airport </button></h2>
					
					<div id="demo" class="collapse">
					<form class="form-signin">
						<label for="formflno" >Code </label>
						<input type="text" id="formflno" class="form-control" placeholder="withoutspaces,eng chars only" required="">
						
						<label for="formfrom" >City </label>
						<input type="text" id="formfrom" class="form-control" placeholder="eng chars only" required="">
						
						<label for="formcapacity" >Airport Capacity </label>
						<input type="text" id="formcapacity" class="form-control" placeholder="10" required="">
						
						<label for="formadress" >Address </label>
						<input type="text" id="formadress" class="form-control" placeholder="10" required="">
						
						<br/>
						<button class="btn btn-lg" type="submit">Add</button>
					</form>	
					</div>
					<br/>          
					<table class="table table-striped">
						
						<thead>
							<tr>
								<th>Airport Code</th>
								<th>Airport City</th>
								<th>Adress</th>
								<th>Capacity</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?PHP
					
							$servername = "localhost";
							$user = "root";
							$pass = "mfs12";
							$dbname = "airline";
							
							$con = mysqli_connect($servername, $user, $pass, $dbname);
	
							if (mysqli_connect_errno())
							{
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							
							$sql = "SELECT * FROM airport";
							$result = mysqli_query($con,$sql);
							
							$html = "";
							if($result)
							{
								if ($result->num_rows > 0) 
								{
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$id = $row['airport_id'];
										$html = $html 	.	"<tr>"
														.	"<td>". $row["airport_id"] . "</td>"
														.	"<td>". $row["city_name"] . "</td>"
														.	"<td>". $row["address"] . "</td>"
														.	"<td>". $row["airport_capacity"] . "</td>"
														.   "<td>". "<a href='airports.php?function=1&id=$id'>Edit</a>". "</td>"
														.   "<td>". "<a href='airports_remove.php?id=$id'>Remove</a>". "</td>"
														.	"</tr>";
									}
								} else {
									echo "";
								}
							}
							echo $html;
						?>
		
						</tbody>
					</table>
				
			</div>
			
		</div>
	</div>
	
	<!-- Modal Edit -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Edit Airport</h4>
				</div>
				<div class="modal-body">

					<form class="form-signin" action='airports_update.php' method='POST'>
					<?PHP
						$id = $_GET['id'];
						$servername = "localhost";
						$user = "root";
						$pass = "mfs12";
						$dbname = "airline";
						
						$con = mysqli_connect($servername, $user, $pass, $dbname);

						if (mysqli_connect_errno())
						{
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						
						$sql = "SELECT * FROM airport WHERE '$id' = airport_id";
						$result = mysqli_query($con,$sql);
						
						if ($result->num_rows > 0) 
						{
							while($row = $result->fetch_assoc()) {									
											$city =		$row['city_name'];
											$address =	$row['address'];
											$capacity =	$row['airport_capacity'];										
							}
						}
						$html = "<label for='aircode' >Code </label>
						<input type='text' name='aircode' id='aircode' class='form-control' value='$id' required=''>
						
						<label for='aircity' >City </label>
						<input type='text' name='aircity' id='aircity' class='form-control' value='$city' required=''>
						
						<label for='airaddr' >AddressAirport </label>
						<input type='text' name='airaddr' id='airaddr' class='form-control' value='$address' required=''>
						
						<label for='aircity' > Capacity </label>
						<input type='text' name='aircity' id='aircity'class='form-control' value='$capacity' required=''>";
						echo $html;
					?>	
						<br/>
						<button class="btn btn-default" data-dismiss="modal">Close</button>
						<button class="btn btn-lg" name='Submit' value='Submit' type="submit">Save Changes</button>
						<input type='submit' name='Submit' value='Submit' class='btn btn-primary'/>
					</form>	
					
				</div> <!-- /container -->
			</div>
		</div>
	</div>
	
	<!-- Airport Delete -->
	<div class="modal fade" id="editSuccess" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<p>Your changes have been saved.  </p>
				</div> <!-- /content -->
			</div>
		</div>
	</div>
	
	<!-- Airport Delete -->
	<div class="modal fade" id="deleteSuccess" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<p> Airport has been deleted successfully, you will be redirected </p>
				</div> <!-- /content -->
			</div>
		</div>
	</div>
	
	<!-- Modal1 -->
	<div class="modal fade" id="deleteFail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<p> Airport cannot be deleted, there may be assigned routes. You will be redirected </p>
				</div> <!-- /content -->
			</div>
		</div>
	</div>
	
</body>
</html>