<?php
include 'connect.php';
session_start();

$username = $_SESSION['username'];
$sql="SELECT * FROM Faculty WHERE faculty_id = '{$username}'";

$result = pg_query($db, $sql);

while($row = pg_fetch_row($result)) {
	echo $row[1];
}
echo "Your UserName is: ".$username.".";

?>