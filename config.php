<?php
	$host 		= "localhost";
	$username 	= "root";
	$password 	= "";
	$db_name 	= "spkkn";

<<<<<<< HEAD
	$connect = mysqli_connect($host, $username, $password, $db_name);
=======
	$conn = mysqli_connect($host, $username, $password, $db_name);
>>>>>>> 53a8fb8 (edit dpl, mahasiswa and tempat)

	if (mysqli_connect_errno()){
		echo "Error Connection!" . mysqli_connect_error();
	}
?>