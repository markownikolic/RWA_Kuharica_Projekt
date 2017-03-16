<?php
  	require("connect_to_mysql.php");
	if($_POST['email']){
		$query= $_POST['email'];
		$query = mysql_query("SELECT * FROM korisnik WHERE email='$query'");
		if(mysql_num_rows($query) > 0){
			echo"<span style='color:red;'> E-mail je nedostupan. </span>";
		}
	}
	if($_POST['username']){
		$query= $_POST['username'];
		$query = mysql_query("SELECT * FROM korisnik WHERE username='$query'");
		if(mysql_num_rows($query) > 0){
			echo"<span style='color:red;'> Korisničko ime je nedostupno. </span>";
		}
	}
?>
	
	
     