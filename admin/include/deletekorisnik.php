<?php		
		require_once("connect_to_mysql.php");
		$query = "SELECT ID from korisnik WHERE username = '".$_GET['username']."'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$id_korisnika =  $row['ID'];
		}
		$query = "SELECT ID_recepta from recept WHERE ID_autora = '".$id_korisnika."'";
		$result = mysql_query($query);
		$id_recepta_delete = Array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$id_recepta_delete[] =  $row['ID_recepta'];
		}
		for ($i=0;$i<count($id_recepta_delete);$i++){
			$query = "SELECT Ime_slike FROM slika where ID_recepta =".$id_recepta_delete[$i];
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptSlikaDelete =  $row['Ime_slike'];
			}
			if ($receptSlikaDelete!="no-picture.jpg") unlink("images/$receptSlikaDelete");
			$query = "DELETE FROM slika WHERE ID_recepta=".$id_recepta_delete[$i];
			mysql_query($query);
			$query = "DELETE FROM sastojci WHERE ID_recepta=".$id_recepta_delete[$i];
			mysql_query($query);
			$query = "DELETE FROM priprema WHERE ID_recepta=".$id_recepta_delete[$i];
			mysql_query($query);
			$query = "DELETE FROM spremljenirecepti WHERE id_recepta =".$id_recepta_delete[$i];
			mysql_query($query);
			$query = "DELETE FROM ocjena WHERE id_recepta =".$id_recepta_delete[$i];
			mysql_query($query);
		}
		$query = "DELETE FROM spremljenirecepti WHERE id_korisnika = '".$id_korisnika."'";
		mysql_query($query);
		$query = "DELETE FROM ocjena WHERE id_korisnika = '".$id_korisnika."'";
		mysql_query($query);
		$query = "DELETE FROM recept WHERE ID_autora = '".$id_korisnika."'";
		mysql_query($query);
		$query = "DELETE FROM korisnik WHERE username = '".$_GET['username']."'";
		mysql_query($query);
			
		header('Location: /Projekt/admin.php?no=1&page=1');
?>