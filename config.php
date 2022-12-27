<?php

//Connection Variable

$host = "localhost";
$username = "root";
$password = "";
$dbname = "phptask";

//Function to Connect the database
$conn = mysqli_connect($host,$username,$password,$dbname);

if(!$conn)
{
	echo "Connection Could Not Connect";
}


?>