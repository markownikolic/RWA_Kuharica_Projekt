
	<?php
	session_start();
	
	require("include/connect_to_mysql.php");
	echo "<script>var tmp=0;</script>";
	$query = "SELECT ID, username, email, slika FROM korisnik WHERE username='".$_SESSION['user']."'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$username =  $row['username'];
		$email = $row['email'];
		$idkorisnika = $row['ID'];
		$slika=$row['slika'];
	}
	
	$query = "SELECT ID_recepta, Ime_recepta FROM recept WHERE ID_autora='".$idkorisnika."'";
	$result = mysql_query($query);
	$receptIme = Array();
	$receptID = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$receptID[] = $row['ID_recepta'];
		$receptIme[] = $row['Ime_recepta'];
	}
	if (isset($_POST['submitUser'])){
		$query = "SELECT username FROM korisnik WHERE username='".$_POST['newuser']."'";
		$result = mysql_query($query);
		$potvrda = Array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$potvrda[] = $row['username'];
		}
		if (count($potvrda)>0) {
			echo "<script>var tmp=1;</script>";
		}else{					
			$query = "UPDATE korisnik SET username='".$_POST['newuser']."' WHERE ID=".$idkorisnika;
			mysql_query($query);}
	}elseif (isset($_POST['submitPass'])){
		if (strlen($_POST['newpsw'])<6) {echo "<script>var tmp=4;</script>";}
		else {
			if($_POST['newpsw']!=$_POST['newppsw']){
				echo "<script>var tmp=5;</script>";
			}else{
				$query = "UPDATE korisnik SET password='".md5($_POST['newpsw'])."' WHERE ID=".$idkorisnika;
				mysql_query($query);
				}}
	}else if(isset($_POST['submitEmail'])){
		$query = "SELECT email FROM korisnik WHERE email='".$_POST['newemail']."'";
		$result = mysql_query($query);
		$potvrda = Array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$potvrda[] = $row['email'];
		}
		if (count($potvrda)>0) {
			echo "<script>var tmp=3;</script>";
		}else{
		$query = "UPDATE korisnik SET email='".$_POST['newemail']."' WHERE ID=".$idkorisnika;
		mysql_query($query);
		$email = $_POST['newemail'];
		echo "<script>var tmp=2;</script>";}
	}
	
	

	
?>
<?php if (!$_SESSION['potrebnaForma']) { ?>
<html>
	<head>	
		<meta charset="utf-8">	
        <title>Moj profil</title>	
        <link href="css/style.css" rel="stylesheet">
		<link href="css/grid.css" rel="stylesheet" media="all">
		<link href="css/hover.css" rel="stylesheet" media="all">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</head>
	
	<body>		
		<?php include 'include/header.php'; ?>
		<div style="min-height:100%;"><br/>
		<div class="alert" id="obavijest" style="margin:-12px 20px -12px 20px;text-align:center; height:20px; opacity:0.9"></div>
		<div class="box1" style="width:70%; margin: 20px 14% 0 14%; float:center">	
		<div class="register_area" style="float:center">
				<div style="height:50%;float:left; width:25%">
					<form action="ProfileSlikaUpload.php" method="POST" enctype="multipart/form-data">
					<input type="file" 
						name="profileUpload" 
						id="profileUpload"
						name="upload_btn"
						style="margin-left: 15px; display:none">
					<input id="profileSubmit" style="display:none" value="Upload" type="submit">
					</form>
					<div id="profileUploadDiv" style="cursor:pointer;margin: 8% 8% 8% 8%; width:200; height:200; background-size:cover; border-radius:999px; background-color:#ccc; 
							background-position: center center; background-image: url('images/profile/<?php echo $slika; ?>');border: solid 2px #888888;"></div>
				</div>
				<div class="container" style="float:left; width:70%;color:#000000">
					<label style="float:left;font-family: Georgia, serif; font-size: 80%; font-weight:normal">Korisničko ime: &emsp; <?php echo "$username"?></label>
					<form action='' method='POST'>
					<div style="float:right">
						<input type="submit" value="Promjeni" name="submitUser" class="btn btn-success" >
					</div>
					<input id='username' style="font-family:LatoLight;" class="text_psw_input" type="text" placeholder="Novo korisničko ime" name="newuser" required>					
					</form>
					<hr/>
					
					<label style="float:left;font-family: Georgia, serif; font-size: 80%; font-weight:normal">Lozinka</label>
					<form action='' method='POST'>
					<div style="float:right">
						<input type="submit" value="Promjeni" name="submitPass" class="btn btn-success" >
					</div>
					<input id='lozinka' style="font-family:LatoLight;" class="text_psw_input" type="password" placeholder="Nova lozinka" name="newpsw" required>
					<input id='plozinka' style="font-family:LatoLight;" class="text_psw_input" type="password" placeholder="Ponovite lozinku" name="newppsw" required>
					</form>
					<hr/>	
					
					<label style="float:left;font-family: Georgia, serif; font-size: 80%; font-weight:normal">E-mail: &emsp;<?php echo "$email" ?></label>
					<form action='' method='POST'>
					<div style="float:right">
						<input type="submit" value="Promjeni" name="submitEmail" class="btn btn-success" >
					</div>
					<input id='email' style="font-family:LatoLight;" class="text_psw_input" type="email" placeholder="Nova e-mail adresa" name="newemail" required>
					</form>
					
				</div>

		</div>
		</div>
		</div>
			<script>
				$(function(){
					$("#profileUploadDiv").on('click', function(e){
						e.preventDefault();
						$("#profileUpload:hidden").trigger('click');
					});
					$("input:file").change(function (){
						$("#profileSubmit:hidden").trigger('click');
					});
				});
			</script>
			<script>
				function obavijest(tmp){
					if (tmp==1){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Korisničko ime već postoji</strong>';
					}
					if (tmp==2){
						document.getElementById('obavijest').className='alert alert-success';
						document.getElementById('obavijest').innerHTML='<strong>E-mail uspješno promjenjen</strong>';
					}
					if (tmp==3){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! E-mail se već koristi</strong>';
					}
					if (tmp==4){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Lozinka sadrži manje od 6 znakova!</strong>';
					}
					if (tmp==5){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Lozinke se ne podudaraju!</strong>';
					}
				} 
				obavijest(tmp); 
			</script>
		<?php include 'include/footer.php'; ?>
<?php }else{
			header('Location: index.php');
			exit();}?>
	
	</body>
</html>