<?php
	$host 		= "localhost";
	$username 	= "root";
	$password 	= "";
	$db_name 	= "spkkn";

	$connect = mysqli_connect($host, $username, $password, $db_name);

	if (mysqli_connect_errno()){
		echo "Error Connection!" . mysqli_connect_error();
	}
?>