<?php
		session_start();
		require("include/connect_to_mysql.php");
		if (isset($_POST['obrisi'])){
			$receptID=$_POST['obrisi'];
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
			header('Location: mojirecepti.php?ob=1');
			exit();
		}
		
		if (isset($_POST['uredi'])){
			$receptID=$_POST['uredi'];
			$query = "SELECT * FROM sastojci where ID_recepta = '$receptID'";
			$result = mysql_query($query);
			$receptSastojciArray = Array();
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptSastojciArray[] =  $row['Sastojak'];
			}
		
		$query = "SELECT * FROM priprema where ID_recepta = '$receptID'";
			$result = mysql_query($query);
			$receptIDArray = Array();
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptPripremaArray[] =  $row['Priprema'];
			}
		
		$query = "SELECT * FROM recept where ID_recepta = '$receptID'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptDatum = date('d.m.Y', strtotime( $row['datum_objave'] ));
				$receptIme = $row['Ime_recepta'];
				$receptOpis = $row['Kratki_opis'];
				$dozvola = $row['dozvola'];
			}
			
		$query = "SELECT Ime_slike FROM slika where ID_recepta = '$receptID'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptSlika =  $row['Ime_slike'];
			}
?>
		<link href="css/style.css" rel="stylesheet">
		<link href="css/grid.css" rel="stylesheet" media="all">
		<link href="css/hover.css" rel="stylesheet" media="all">
		<?php include 'include/header.php'; ?>
		<div class="unos_recepta" style="width:70%; margin: 27px auto; float:center">	
		<div class="box1" style="margin-left:0; float:center; width:100%">
			<form method="POST" action="unos_validation.php" enctype="multipart/form-data">
				<div class="container" style="color:#000000">
					<label><b>Ime recepta</b></label>
					<input 	style="font-family:LatoLight;" 
							class="text_psw_input" 
							type="text"
							value="<?php echo $receptIme ?>"
							placeholder="Unesite ime recepta!" 
							name="imeRecepta" required>
					
					<label><b>Kratak opis</b></label>
					<textarea 	rows="5" 
								style="font-family:LatoLight;" 
								class="text_psw_input"
								id="kratakOpis"
								placeholder="Unesite kratak opis recepta!" 
								name="kratakOpis" required><?php echo $receptOpis; ?></textarea>
								
					<label><b>Sastojci</b></label>
					<textarea 	rows="10" 
								style="font-family:LatoLight;" 
								class="text_psw_input" 
								id="sastojci"
								placeholder="Unesite svaki sastojak u poseban red!" 
								name="sastojciRecepta" required><?php echo implode("\n",$receptSastojciArray); ?></textarea>
					
					<label><b>Priprema</b></label>
					<textarea 	rows="10" 
								style="font-family:LatoLight;" 
								class="text_psw_input" 
								placeholder="Unesite svaki korak u poseban red!" 
								name="pripremaRecepta" required><?php echo implode("\n",$receptPripremaArray); ?></textarea>
					
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
					<input type="hidden"
							name="uredisliku"
							value="<?php echo $receptSlika; ?>">
					<input type="hidden"
							name="receptidd"
							value="<?php echo $receptID; ?>">
					<br/>	
					<div class="container" style="border-radius:5px; height:30px">	
						<button type="submit"
								name="upload_btn"
								value="Upload"
								class="btn btn-success"
								style="float:left; border-radius:20px; width:150px">Spremi recept</button>
							
						<input type="reset" class="btn btn-danger" style="width:150px;border-radius:20px;float:right">									
					</div>
				</div>
			</form>
		</div> 
		</div>
<?php }include 'include/footer.php';?>