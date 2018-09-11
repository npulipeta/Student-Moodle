<?php
$host= "host = 127.0.0.1";
$port = "port = 5432";
$dbname  = "dbname = project";
$credentials = "user = shailendra password=password";
$db = pg_connect( "$host $port $dbname $credentials") or die("Could not connect");

?>
