<?php

	require("include/connect_to_mysql.php");
	
	if (!isset($_POST['userregname']) || !isset($_POST['regpsw']) || !isset($_POST['regppsw']) || !isset($_POST['regemail'])) {
		
	} else {
		$user=trim($_POST['userregname']);
		$pass=trim($_POST['regpsw']);
		$confirm=trim($_POST['regppsw']);
		$email=trim($_POST['regemail']);
		$spol=$_POST['spol'];
	}
	$query = "SELECT username FROM korisnik WHERE username='".$user."'";
	$result = mysql_query($query);
	$potvrdaUser = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$potvrdaUser[] = $row['username'];
	}
	$query = "SELECT email FROM korisnik WHERE email='".$email."'";
	$result = mysql_query($query);
	$potvrdaEmail = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$potvrdaEmail[] = $row['username'];
	}
	if (count($potvrdaUser)>0) {
		header('Location: register.php?reg=1');
	}
	else {
		if(count($potvrdaEmail)>0){
			header('Location: register.php?reg=5');
			exit();
		}
		if(strlen($pass) < 6){
			header('Location: register.php?reg=4');
			exit();
		}
		if($pass!=$confirm){
			header('Location: register.php?reg=3');
			exit();
		}else{
			$pass = md5($pass);
			$query = "INSERT INTO korisnik (ID, username, password, email, spol, join_date) VALUES (NULL, '$user', '$pass', '$email', '$spol', NOW())";
			$result = mysql_query($query);
			if( $result )
				header('Location: register.php?reg=2');
		}
    }


  ?>
	