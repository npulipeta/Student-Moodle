<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Example of Bootstrap 3 Fixed Navbar</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                <li><a href="student.php">Course Registration</a></li>
                <li ><a href="course_reg.php">Registration Record</a></li>
                <li class="active"><a href="#">Report</a></li>
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

        <h1>Your Academic Report</h1>
    <table class="data-table">
        <!-- <caption class="title">Your Academic Report</caption> -->
        <thead>
            <tr>
                <th>NO</th>
                <th>semester</th>
                <th>year</th>
                <th>course_id</th>
                <th>title</th>
                <th>credit</th>
                <th>grade</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
        $username = $_SESSION['username'];
        $sql="SELECT * FROM getStudentReport('{$username}')";
        //echo $sql;
        $result = pg_query($db, $sql);
        $no     = 1;
        $total  = 0;

        while ($row = pg_fetch_row($result))
        {
                    
             echo '<tr>
                <td>'.$no.'</td>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
            </tr>';
            
            $no++;
        }
        $sql="SELECT * FROM getStudentCGPA('{$username}')";
        $result = pg_query($db, $sql);
        $row = pg_fetch_row($result);
        $cgpa= $row[0];
        
        $sql="SELECT * FROM getStudentCredit('{$username}')";
        $result = pg_query($db, $sql);
        $row = pg_fetch_row($result);
        $credits= $row[0];
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">CGPA</th>
                <th><?=($cgpa)?></th>
            </tr>
        </tfoot>
         <tfoot>
            <tr>
                <th colspan="5">Total Credits</th>
                <th><?=($credits)?></th>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>                            