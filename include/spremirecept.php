<?php
	session_start();	
	require_once("connect_to_mysql.php");

if (!$_SESSION['potrebnaForma']) {
	$receptID=$_SESSION['id_recepta'];
	$idkorisnika=$_SESSION['korisnikid'];
	if (isset($_POST['spremi'])){
			$query = "SELECT count(*) AS spremljen FROM spremljenirecepti INNER JOIN korisnik ON (korisnik.ID=spremljenirecepti.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=spremljenirecepti.id_recepta) WHERE recept.ID_recepta = '$receptID' AND korisnik.username='".$_SESSION['user']."'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
		    $spremljen=$row['spremljen'];
	
	if($spremljen==0){
		$query = "INSERT INTO spremljenirecepti (id_korisnika, id_recepta) VALUE ('$idkorisnika','$receptID')";
		$result = mysql_query($query);
		echo 1;
	}else{
		$query = "DELETE FROM spremljenirecepti WHERE id_korisnika='$idkorisnika' AND id_recepta='$receptID'";
		$result = mysql_query($query);
		echo 0;
	}
	}
}
else 
	{header('Location: index.php');}
?>