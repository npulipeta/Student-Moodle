<!DOCTYPE html>
<html>
<head>
    <title>Login to Portal</title>
</head>
<body>
<?php
require 'connect.php';
include ('api.php');
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["user"]);
?>

    <!-- Begin Page Content -->
    <div id="container">
        <form name="loginForm" action = "<?php $_PHP_SELF ?>" method = "POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="lower">
                <input type="submit" value="Login" name="login">
            </div><!--/ lower-->
        </form>
    </div><!--/ container-->
    <!-- End Page Content -->


<?php
    
if(!empty($_POST["login"])) 
{
    // echo $_POST["username"] . " " . $_POST["password"];
    //echo "login----";
    $sql ="SELECT * FROM Person WHERE id = '{$_REQUEST['username']}' AND password='{$_REQUEST['password']}'";
    //echo $sql;
    $ret = pg_query($db, $sql);
    $row = pg_fetch_row($ret);
    if (is_array($row))
    {
        
        $_SESSION["username"] = $row[0];
        $_SESSION["password"] = $row[1];
        $_SESSION["user"]=$row[2];
        echo $_SESSION["username"];

       // $_SESSION["login"] = 2;
    }
    else
    {
        echo "Invalid username and password";
    }
}
if(!empty($_SESSION["username"]))
{
    echo $_SESSION["username"];
    header("Location: homepage.php");
}
?>
</body>
</html>
