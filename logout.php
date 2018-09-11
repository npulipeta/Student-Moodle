<?php
require 'connect.php';
include('api.php');
session_start();
$_SESSION["username"] = "";
$_SESSION["password"] = "";
session_destroy();
header("Location: login.php");
?>