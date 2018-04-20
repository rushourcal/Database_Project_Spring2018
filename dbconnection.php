<?php #use include_once ('dbconnection.php'); surrounded by a php tag on any page which may need to query the database.
$user = 'root';
$password = 'root';
$db = 'bookstore';
$host = 'localhost';
$port = 3306;

$link = mysqli_init(); #any time you need to query the database in php code, use mysqli_query($link,[your query string]);
$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);
?>