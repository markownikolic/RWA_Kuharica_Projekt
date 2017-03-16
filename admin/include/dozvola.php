<?php		
		require_once("connect_to_mysql.php");
		if (isset($_GET['delete'])){
			$receptID=$_GET['delete'];
			$query = "SELECT * FROM slika where ID_recepta =".$receptID;
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptSlika =  $row['Ime_slike'];
			}
			if ($receptSlika!="no-picture.jpg") unlink("images/$receptSlika");
			$query = "DELETE FROM slika WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM sastojci WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM priprema WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM ocjena WHERE id_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM spremljenirecepti WHERE id_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM recept WHERE ID_recepta=".$receptID;
			mysql_query($query);
			}
		if (isset($_GET['dozvoli'])){
			$receptID=$_GET['dozvoli'];
			$query = "UPDATE recept SET flag=1 WHERE ID_recepta=".$receptID;
			mysql_query($query);
			}	
		header('Location: /Projekt/admin.php?no=2&page=1');
?>