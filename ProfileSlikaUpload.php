<?php
	session_start();	
	require_once("include/connect_to_mysql.php");
	
if (!$_SESSION['potrebnaForma']) {
		if($_FILES['profileUpload']['name'] != ''){
        $photo = $_FILES['profileUpload'];
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
        $uploadpath = 'images/profile/'.$uploadname;
		
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
         header('Location: profil.php');
      }else{
        //upload file and database instert
        if(!empty($_FILES)){
          move_uploaded_file($tmploc,$uploadpath);
        }
		if ($uploadname==''){$uploadname='no-picture.jpg';}
		$query = "SELECT slika FROM korisnik WHERE username='".$_SESSION['user']."'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$slika=$row['slika'];
		}
		if ($slika!="default-profile.jpg"){unlink("images/profile/".$slika);}
		$query = "UPDATE korisnik SET slika='$uploadname' WHERE username='".$_SESSION['user']."'";
		$result = mysql_query($query);
		
      }
		header('Location: profil.php');
	}
else 
	{header('Location: index.php');}
?>