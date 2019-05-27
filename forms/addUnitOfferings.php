
<?php
	require_once("../classes.php");
	session_start();
	if (!isset($_SESSION['logged_in'])) {
		header('Location: /tcabs/login.php');
	} else {
	
		// if there was a post request
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// do something
			}
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Stylesheets -->
		<?php include "../styles/stylesheet.php"; ?>
		
		<title>Add Unit Offering - TCABS</title>
  </head>

  <body class="loggedin">
		<?php include "../views/header.php"; ?>
  
		<div class="content">
			<h2>Manage Unit Offerings > Add Offering</h2><h2-date><?php echo date('d F, Y (l)'); ?></h2-date><br>
			<div>
		<?php 
		//Check the Users role to see if they have access to this
		$roleFound = FALSE;						
		foreach($_SESSION['loggedUser']->uRoles as $userType => $access) {
			if($userType=='admin') {
				$roleFound = TRUE;
		?>
			
				<form style="width: 90%; margin: auto;" action="addUnitOfferings.php" method ="post" class="was-validated">
		<br>
  	  <p class="h4 mb-4 text-center">Add Unit Offerings</p>

			<select class="browser-default custom-select" id="unitCode" name="unitCode" required>
 	  		<option value="" disabled="" selected="">Select Unit Code</option>
 	    	
			<!-- Populate based on units table here -->
			
 	  	</select>
		
		<br>
		<br>
		
					<select class="browser-default custom-select" id="teachingPeriod" name="teachingPeriod" required>
 	  		<option value="" disabled="" selected="">Select Teaching Period</option>
 	    	
			<!-- Populate based on Teaching Period table here -->
			
 	  	</select>
		
<br><br>
  		<button class="btn btn-info my-4 btn-block" type="submit">Add Unit Offering</button>
		</form>
				
		<?php  } }
		
		//If they dont have correct permission
		if ($roleFound == FALSE) { ?>
		
			<h2>Permission Denied</h2>
			<div>
			<p>Sorry, you do not have access to this page. Please contact your administrator.</p>
			</div>
		<?php  }  ?>
			</div>
		</div>
  </body>
  <?php include "../views/footer.php"; ?>  
</html>