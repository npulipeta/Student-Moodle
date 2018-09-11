<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
</head>
<body>
<form action="" method="post" id="frmLogout">
	<input type="submit" value="logout" name="logout">
</form>

<?php
require 'connect.php';
include('api.php');
session_start();

if(!empty($_POST["logout"])) {
	$_SESSION["username"] = "";
	$_SESSION["password"] = "";
	session_destroy();
	header("Location: login.php");
}


echo "Hello ".$_SESSION['user']. ". Welcome to Portal. <br>";

if (isStudent($_SESSION["username"],$db))
{
	// student page display
	echo "student <br>";
	header('Location: student.php');
	//getCurrentCourses($_SESSION["username"], $db);
}
if (isFaculty($_SESSION["username"], $db))
{
	// faculty page display
	echo "Faculty";

}
if (isNonTeachingStaff($_SESSION["username"], $db))
{
	// faculty page display
	echo "Non Teaching Staff";

}

?>

</body>
</html>