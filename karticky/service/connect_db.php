<?php
/**
 * Pripojeni k DB.
 * @return DB spojeni pokud ok/false pri chybe + ji vypise.
 */





	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="root";
	$dbname="karticky_db";
	
	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

?>

