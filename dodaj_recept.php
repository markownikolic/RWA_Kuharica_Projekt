<?php session_start(); 
		require_once("include/connect_to_mysql.php");
		if (isset($_GET['rec'])) {
			if(($_GET['rec'])==2)
				echo "<script>var tmp=2;</script>";
			if(($_GET['rec'])==1)
				echo "<script>var tmp=1;</script>";
		}

?>

<html>
	<head>
	
		<meta charset="utf-8">
		
        <title>Kuharica | Dodaj recept</title>
		
        <link href="css/style.css" rel="stylesheet">
		<link href="css/grid.css" rel="stylesheet" media="all">
		<link href="css/hover.css" rel="stylesheet" media="all">
		
	</head>
	
	<body>
		
		<?php
		if (!$_SESSION['potrebnaForma']) {
		include 'include/header.php';			
		?>
		<div class="alert" id="obavijest" style="margin: 5px 20px -40px 20px;text-align:center; height:20px; opacity:0.9"></div>	
		<div class="unos_recepta" style="width:70%; margin: 27px auto; float:center">	
		<div class="box1" style="margin-left:0; float:center; width:100%">
			<form method="POST" action="unos_validation.php" enctype="multipart/form-data">
				<div class="container" style="color:#000000">
					<label><b>Ime recepta</b></label>
					<input 	style="font-family:LatoLight;" 
							class="text_psw_input" 
							type="text" 
							placeholder="Unesite ime recepta!" 
							name="imeRecepta" required>
					
					<label><b>Kratak opis</b></label>
					<textarea 	rows="5" 
								style="font-family:LatoLight;" 
								class="text_psw_input" 
								placeholder="Unesite kratak opis recepta!" 
								name="kratakOpis" required></textarea>
								
					<label><b>Sastojci</b></label>
					<textarea 	rows="10" 
								style="font-family:LatoLight;" 
								class="text_psw_input" 
								placeholder="Unesite svaki sastojak u poseban red!" 
								name="sastojciRecepta" required></textarea>
					
					<label><b>Priprema</b></label>
					<textarea 	rows="10" 
								style="font-family:LatoLight;" 
								class="text_psw_input" 
								placeholder="Unesite svaki korak u poseban red!" 
								name="pripremaRecepta" required></textarea>
					
					<label><b>Tko može vidjeti vaš recept:</b></label><br/>
					<select name="dozvola" style="border-radius:5px; margin-left:15px">
					<option value="2" selected="selected"> Svi </option>
					<option value="1"> Registrirani korisnici </option>
					</select><br/><br/>					
					
					<label><b>Slika:</b></label><br/>		
					<input type="file" 
						name="fileToUpload" 
						id="fileToUpload"
						style="margin-left: 15px;"><br/><br/>
					<br/>	
					<div class="container" style="border-radius:5px; height:30px">	
						<button type="submit"
								name="upload_btn"
								value="Upload"
								class="btn btn-success"
								style="float:left; border-radius:20px; width:150px">Dodaj recept</button>
							
						<input type="reset" class="btn btn-danger" style="width:150px;border-radius:20px;float:right">									
					</div>
				</div>
			</form>
		</div> 
		</div>
			<script>
				function obavijest(tmp){
					if (tmp==2){
						document.getElementById('obavijest').className='alert alert-success';
						document.getElementById('obavijest').innerHTML='<strong>Recept poslan adminu na pregled</strong>';
						setTimeout(function(){
							window.location.href='index.php';
							}, 2000);
					}
					if (tmp==1){
						document.getElementById('obavijest').className='alert alert-danger';
						document.getElementById('obavijest').innerHTML='<strong>Neuspješno dodavanje, greška pri odabiru slike!</strong>';
					}
					var tmp=0;
				}
				obavijest(tmp); 
			</script>
		<?php include 'include/footer.php'; ?>
		<?php }
		else {
			header('Location: index.php');
		}?>
	</body>
</html>