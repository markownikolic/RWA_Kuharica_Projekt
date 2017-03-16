
<?php

	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	}
	if (isset($_SESSION['pass'])) {
		$pass = $_SESSION['pass'];
	}
	
	require("connect_to_mysql.php");
	
	
	$query = "SELECT * FROM korisnik WHERE username=\"" . $user . "\" AND password=\"" . $pass . "\"";
	$result = mysql_query($query);
	
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	
	if(!$row) {
		unset($_SESSION['user']);
		unset($_SESSION['pass']);
		header('Location: index.php?log=0');
	} else {
		$_SESSION['korisnikid']=$row['ID'];
	}
?>