<?php
	session_start();	
	require_once("connect_to_mysql.php");
if (!$_SESSION['potrebnaForma']) {
	$receptID=$_SESSION['id_recepta'];
	$idkorisnika=$_SESSION['korisnikid'];
	if (isset($_POST['ocjeni'])){
			$query = "SELECT count(*) AS ocjenjen FROM ocjena INNER JOIN korisnik ON (korisnik.ID=ocjena.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=ocjena.id_recepta) WHERE recept.ID_recepta = '$receptID' AND korisnik.username='".$_SESSION['user']."'";
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{$ocjenjen=$row['ocjenjen'];
				 }
	
	if(!$ocjenjen){
		$query = "INSERT INTO ocjena (id_korisnika, id_recepta, ocjena) VALUE ('$idkorisnika','$receptID', '".$_POST['ocjeni']."')";
		$result = mysql_query($query);
		echo 1;
	}else{
		$query = "UPDATE ocjena SET ocjena='".$_POST['ocjeni']."' WHERE id_korisnika='$idkorisnika' AND id_recepta='$receptID'";
		$result = mysql_query($query);
		echo 0;
	}
	}
	
	if (isset($_POST['prosjek'])){
		$query = "SELECT ROUND(AVG(ocjena),0) as prosjek FROM ocjena INNER JOIN korisnik ON (korisnik.ID=ocjena.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=ocjena.id_recepta) WHERE recept.ID_recepta = '$receptID'";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{$prosjek=$row['prosjek'];}
		echo $prosjek;
	}
}
else 
	{header('Location: index.php');}
?>