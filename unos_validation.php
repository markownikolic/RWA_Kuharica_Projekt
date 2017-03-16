<?php
	session_start();
	require("include/connect_to_mysql.php");
	
	if ( isset($_SESSION['user']) && isset($_SESSION['pass']) ) {		
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		
		$query = "SELECT permission FROM korisnik WHERE username = '".$_SESSION['user']."'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$permission =  $row['permission'];}
	// ----- upload slike ------ //
	$tmp=false;
	$uredi=false;
	if (!isset($_POST['uredisliku']) OR (isset($_POST['uredisliku']) AND !empty($_FILES['fileToUpload']['name'])))$tmp=true;
		if(isset($_POST['receptidd'])){
			$receptID=$_POST['receptidd'];
			if (!empty($_FILES['fileToUpload']['name'])) if ($_POST['uredisliku']!="no-picture.jpg") unlink("images/".$_POST['uredisliku']);
			if($tmp) $query = "DELETE FROM slika WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM sastojci WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$query = "DELETE FROM priprema WHERE ID_recepta=".$receptID;
			mysql_query($query);
			$uredi=true;
			}
	
	if($_FILES['fileToUpload']['name'] != ''){
        $photo = $_FILES['fileToUpload'];
        $name = $photo['name'];
        $namearray = explode('.',$name);
        $filename = $namearray[0];
        $fileext = $namearray[1];
        $mime = explode('/',$photo['type']);
        $mimetype = $mime[0];
        $mimeext = $mime[1];
        $tmploc = $photo['tmp_name'];
        $filesize = $photo['size'];
        $allowed = array('png', 'jpg', 'jpeg', 'gif');

        $uploadname = md5(microtime()).'.'.$fileext;
        $uploadpath = 'images/'.$uploadname;

        //form validation
        if($mimetype != 'image'){
          $errors[] = 'The file must be an image';
        }
        if(!in_array($fileext, $allowed)){
          $errors[] = 'The file format is not allowed';
        }
        if($filesize > 15000000){ //15mb max
          $errors[] = 'The file is bigger than 15MB';
        }
        if($fileext != $mimeext && ($mimeext == 'jpeg' && $fileext != 'jpg')){
          $errors[] = 'File extention does not match the file.';
        }
      }
      if(!empty($errors)){
        header('Location: dodaj_recept.php?rec=1');
      }else{
        //upload file and database insert
        if(!empty($_FILES)){
          move_uploaded_file($tmploc,$uploadpath);
        }
		
	$imeRecepta = $_POST['imeRecepta'];
	$opis = $_POST['kratakOpis'];
	$sastojci = preg_split ('/$\R?^/m', $_POST['sastojciRecepta']);
	$priprema = preg_split ('/$\R?^/m', $_POST['pripremaRecepta']);
	$dozvola = $_POST['dozvola'];
	$query = "SELECT ID from korisnik where username = '$user' and password = '$pass'";	
	$result = mysql_query($query);
	$id = mysql_fetch_array($result, MYSQL_ASSOC);
	if(!$uredi){
	$query = "INSERT INTO recept (Ime_recepta, Kratki_opis, ID_autora, datum_objave, dozvola) VALUES ('$imeRecepta', '$opis', '$id[ID]', NOW(),'$dozvola')";
	$result = mysql_query($query);
	$receptID = mysql_insert_id();
	}else{
		$query = "UPDATE recept SET Ime_recepta='$imeRecepta', Kratki_opis='$opis', dozvola='$dozvola' WHERE ID_recepta=".$receptID;
		$result = mysql_query($query);
	}
	if($tmp==true){
	if ($uploadname==''){$uploadname='no-picture.jpg';}
		$query = "INSERT INTO slika (ID_slike, ID_recepta, Ime_slike) VALUES (NULL, '$receptID', '$uploadname')";
		$result = mysql_query($query);
	}
	for($i = 0; $i < sizeof($sastojci); $i++) {
		$sastojak = $sastojci[$i];
		$query = "INSERT INTO sastojci (ID_recepta, Sastojak) VALUES ('$receptID', '$sastojak')";
		$result = mysql_query($query);
	}
	
	for($j = 0; $j < sizeof($priprema); $j++) {
		$korak = $priprema[$j];
		$query = "INSERT INTO priprema (ID_recepta, Priprema) VALUES ('$receptID', '$korak')";
		$result = mysql_query($query);
	}
	 if(!$uredi)header('Location: dodaj_recept.php?rec=2');
	 else if($permission!='admin') header('Location: mojirecepti.php?ob=2'); else header('Location: recept.php?id='.$receptID);
}
}else header('Location: index.php');
?>