<?php

	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	
	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'vertrigo';
	$database = 'Projekt';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_set_charset('utf8mb4', $conn);

    if(!$conn ) {
        die('Could not connect: ' . mysql_error());
    }
	
	$select = mysql_select_db($database);
	
	 if(!$database ) {
        die('Could not connect: ' . mysql_error());
    }
	
?>