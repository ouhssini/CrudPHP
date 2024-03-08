<?php

$host = 'localhost';
$user = 'root';
$pass  = '199716';
$db = 'school';
$stagiares = array();

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

$query =  "select * from filiere";
$run = mysqli_query($conn, $query);
$filiers =[] ;
while ($row = mysqli_fetch_array($run)){
   array_push($filiers,$row);
}
