<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	function AddToRegister(argument) {
		// body...
		//alert(argument);
		$.ajax({
		    type: "POST",
		    url: 'api.php',
		    data: "data="+argument,

		    success: function (data) {
		                // alert(data);
		            }
		});

	}
</script>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
</head> 
<body>
	<?php
	require 'connect.php';
	include ('api.php');
	session_start();
	?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Brand</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Course Registration</a></li>
                <li><a href="course_reg.php">Registration Record</a></li>
                <li><a href="report.php">Report</a></li>
                <li ><a href="ticket.php">Your Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron">
    <div class="container">
    	  <?php
        echo "Hello ".$_SESSION['user']. ". Welcome to Portal. <br>";
        ?>
        <!-- <h1>Fixed Navbar</h1> -->
      
        <!-- <p>The Bootstrap navigation bar is fixed at the top of the viewport and does not scroll with the rest of the page.</p> -->
    </div>
</div>
<div class="container">

    	<h1>All Offered Courses</h1>
	<table class="data-table">
		<!-- <caption class="title">All Offered Courses</caption> -->
		<thead>
			<tr>
				<th>NO</th>
				<th>Course</th>
				<th>Title</th>
				<th>Credits</th>
				<th>Instructor</th>
				
			</tr>
		</thead>
		<tbody>
		<?php

		//include 'connect.php';

		//session_start();

		$username = $_SESSION['username'];

		// echo "Hello ".$_SESSION['user']. ". Welcome to Portal. <br>";

		$sql1="SELECT * FROM Student WHERE student_id = '{$username}'";

		//echo $sql1;
		$result = pg_query($db, $sql1);
		//echo pg_num_rows($result);
		//$result = pg_exec($sql1);

		//while($row1 = pg_fetch_row($result)) {
			//echo $row1[1];
		//}

		//echo "Your UserName is: ".$username.".";

		$sql2 = "SELECT * FROM getCourseOffered()";
		$result1 = pg_query($db, $sql2);
		//echo pg_num_rows($result1);
		//$result1 = pg_exec($sql2);
		$no 	= 1;
		$total 	= 0;
		while ($row = pg_fetch_row($result1))
		{
			
			echo '<tr>
					<td>'.$no.'</td>
					<td name=>'.$row[0].'</td>
					<td name=>'.$row[1].'</td>
					<td name=>'.$row[2].'</td>
					<td name=>'.$row[3].' '.$row[4].'</td>
					<td><button name='.'insert'.'$'.$username.'$'.$row[5].'$'.$row[6].'$'.$row[0].'$'.' type="button" onclick="AddToRegister(this.name)">ADD</button></td>
				</tr>';
			
			$no++;
		}
        $sql="SELECT * FROM getRegisteredCredit('{$username}')";
        $result = pg_query($db, $sql);
        $row = pg_fetch_row($result);
        $credits= $row[0];

		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4">Total Registered Credits</th>
				<th><?=($credits)?></th>
			</tr>
		</tfoot>
	</table>
</div>
</body>
</html>
