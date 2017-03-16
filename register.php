<?php
	session_start();
	require_once("include/connect_to_mysql.php");
		if (isset($_GET['reg'])) {
			if(($_GET['reg'])==1)
				echo "<script>var tmp=1;</script>";
			if(($_GET['reg'])==2)
				echo "<script>var tmp=2;</script>";
			if(($_GET['reg'])==3)
				echo "<script>var tmp=3;</script>";
			if(($_GET['reg'])==4)
				echo "<script>var tmp=4;</script>";
			if(($_GET['reg'])==5)
				echo "<script>var tmp=5;</script>";
		}
?>

<!DOCTYPE html>

<html>
	<head>
	
		 <meta charset="utf-8">
		
        <title>Kuharica | Registracija</title>
		
        <link href="css/style.css" rel="stylesheet">
		<link href="css/hover.css" rel="stylesheet" media="all">
		<script src="js/jquery.js"></script>
	</head>
	
	<body>
		<?php 	
		if ($_SESSION['potrebnaForma']) {	
		include 'include/header.php';		
		?>
		<div style="min-height:100%;">
		<div class="alert" id="obavijest" style="margin: 5px 20px -40px 20px;text-align:center; height:20px; opacity:0.9"></div>	
		<div class="box1" style="width:70%; margin: 50px 15% 0 15%; margin-right:-10px">
			<div class="register_area" style="float:center; width:100%;">
				<form method="POST" action="register_validation.php">
					<div class="container" style="color:#000000">
						<label><b>Korisničko ime <span style="font-size:80%;">*</span></b></label>
						<span id="previewIme"  style="font-size:65%; font-family: Georgia, serif; font-style: italic;
														position:absolute; margin-left:20px; margin-top:8px;"></span>
						<input style="font-family:LatoLight; border-radius:5px;" class="text_psw_input" type="text" placeholder="Unesite korisničko ime" id="username_unos" name="userregname" required>
						
						<label><b>Lozinka <span style="font-size:80%;">*</span></b></label>
						<span id="previewLozinka"  style="font-size:65%; font-family: Georgia, serif; font-style: italic;
														position:absolute; margin-left:20px; margin-top:8px;"></span>
						<input style="font-family:LatoLight;border-radius:5px;" class="text_psw_input" id="lozinka_unos" type="password" placeholder="Unesite lozinku (minimalno 6 znakova)" name="regpsw" required>
						
						<label><b>Ponovite lozinku <span style="font-size:80%;">*</span></b></label>
						<input style="font-family:LatoLight;border-radius:5px;" class="text_psw_input" type="password" placeholder="Ponovite lozinku" name="regppsw" required>
						
						<label><b>E-mail <span style="font-size:80%;">*</span></b></label>
						<span id="previewEmail"  style="font-size:65%; font-family: Georgia, serif; font-style: italic;
														position:absolute; margin-left:20px; margin-top:8px;"></span>
						<input style="font-family:LatoLight;border-radius:5px;" class="text_psw_input" type="email" placeholder="Unesite E-mail" name="regemail" id="email_unos" required>
						
						<label><b>Spol <span style="font-size:80%;">*</span></b></label><br/>
						<input style="font-family:LatoLight;border-radius:5px;" type="radio" name="spol" value="musko" checked="checked">Musko
						<input style="font-family:LatoLight;border-radius:5px;" type="radio" name="spol" value="zensko">Žensko

						
						<div class="container" style="height:auto; border-radius:10px; margin-top: 20px;">
							<button type="submit"
									name="reg_btn"
									value="Register"
									class="btn btn-success"
									style="border-radius:20px;">Registriraj se</button>
								
							<input type="reset" class="btn btn-danger" style="float: right; border-radius:20px;">
					
						</div>
					</div>
				</form>
			</div>
		</div>
		</div>
			<script>
				function obavijest(tmp){
					if (tmp==1){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Korisničko se ime već koristi</strong>';
					}
					if (tmp==2){
						document.getElementById('obavijest').className='alert alert-success';
						document.getElementById('obavijest').innerHTML='<strong>Registracija uspješna</strong>';
						setTimeout(function(){
							window.location.href='index.php';
							}, 1500);
					}
					if (tmp==3){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Lozinke se ne podudaraju</strong>';
					}
					if (tmp==4){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! Lozinka ne smije bit kraća od 6 znakova</strong>';
					}
					if (tmp==5){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Greška! E-mail se već koristi</strong>';
					}
				var tmp=0;
				}
				obavijest(tmp); 
			</script>
			<script type="text/javascript">
				$(function(){
				 $('#lozinka_unos').change(function(){
					 var a = $('#lozinka_unos').val();		 		 			 
					 if(a.length<6) $('#previewLozinka').html("<span style='color:red'>Lozinka mora imati minimalno 6 znakova</span>");	
						else $('#previewLozinka').html('');
				   });
				 $('#email_unos').change(function(){
					 var a = $('#email_unos').val();		 
					 $.post('include/check.php', {"email": a }, 		 
					 function(data){		 
					 $('#previewEmail').html(data);		 
					  });		 
				   });
				$('#username_unos').change(function(){
					 var a = $('#username_unos').val();		 
					 $.post('include/check.php', {"username": a }, 		 
					 function(data){		 
					 $('#previewIme').html(data);		 
					  });		 
				   });				   
				});	
			</script>
	<?php }
		else {
			header('Location: index.php');
		}?>
	<?php include 'include/footer.php';?>
	</body>
	
</html>