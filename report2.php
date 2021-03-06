<?php
	require_once("classes.php");
	session_start();
	if (!isset($_SESSION['logged_in'])) {
		header('Location: login.php');
	} else {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		}
	}
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM users INNER JOIN enrolment ON users.email = enrolment.sUserName INNER JOIN unitoffering ON enrolment.unitOfferingID = unitoffering.UnitOfferingID WHERE CONCAT(`fName`,`lName`,`unitCode`,`term`,`year`,`censusDate`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
   $query = "SELECT * FROM users INNER JOIN enrolment ON users.email = enrolment.sUserName INNER JOIN unitoffering ON enrolment.unitOfferingID = unitoffering.UnitOfferingID";
   $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "tcabs");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <body class="loggedin">
		<?php include "styles/stylesheet.php"; ?>

			<body class="loggedin">
				<?php include "views/header.php"; ?>
			<div class="content">
			<h2>Available reports to generate</h2><h2-date><?php echo date('d F, Y (l)'); ?></h2-date><br>
			<div>
				<?php
				//Check the Users role to see if they have access to this
				$roleFound = FALSE;
				foreach($_SESSION['loggedUser']->uRoles as $userType => $access) {
					if($userType=='admin') {
						$roleFound = TRUE;
				?>
    <div class="btn-group btn-group-justified">
      <a href="report.php" class="btn btn-primary">Overview</a>
      <a href="report1.php" class="btn btn-primary">1</a>
      <a href="report2.php" class="btn btn-primary">2</a>
      <a href="report3.php" class="btn btn-primary">3</a>
      <a href="report4.php" class="btn btn-primary">4</a>
      <a href="report5.php" class="btn btn-primary">5</a>
      <a href="report6.php" class="btn btn-primary">6</a>
      <a href="report7.php" class="btn btn-primary">7</a>
      <a href="report8.php" class="btn btn-primary">8</a>
      <a href="report9.php" class="btn btn-primary">9</a>
      <a href="report10.php" class="btn btn-primary">10</a>
    </div>
    <br>
    <p class="h4 mb-4 text-center">2. List of students enrolled in a unit of study</p>

    <body>
        <form action="report2.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search.."><br><br>
            <input type="submit" name="search" value="Filter"><br><br>

            <table>
                <tr>
                  <th>Unit Code</th>
                  <th>Unit Offering Period</th>
                  <th>Student Name</th>
                  <th>Student Email</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                  <td><?php echo $row["unitCode"];?></td>
                  <td><?php echo $row["term"]; ?> - <?php echo $row["year"]; ?></td>
                  <td><?php echo $row["fName"]; ?> <?php echo $row["lName"]; ?></td>
                  <td><?php echo $row["email"]; ?></td>
                </tr>
                <?php endwhile;?>
            </table>
            <br>
            <br>
            <div class="btn-group btn-group-justified">
              <a href="report2.php" class="btn btn-primary">Clear Search</a>
            </div>
        </form>
    </body>
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
<?php include "views/footer.php"; ?>
</html>
