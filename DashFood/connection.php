<?php

function Connect(){

	$host="";
	$port=;
	$socket="";
	$user="";
	$password="";
	$dbname="";

	$conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());
		
	return $conn;
}
?>