<?php
	session_start();
	require("include/connect_to_mysql.php");
	
	$receptID = $_GET['id'];
	
	if(is_numeric($receptID)) {
				
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
				$receptSlikaArray[] =  $row['Ime_slike'];
			}
		$query = "SELECT username, join_date, spol, last_login FROM korisnik INNER JOIN recept ON (recept.ID_autora=korisnik.ID) WHERE ID_recepta = '$receptID'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptUsername =  $row['username'];
				$spol = $row['spol'];
				$receptJoinD =  date('d.m.Y', strtotime( $row['join_date'] ));
				$receptLastL =  date('d.m.Y  H:i', strtotime( $row['last_login'] ));
			}
		$query = "SELECT count(*) as BrRecepata FROM korisnik INNER JOIN recept ON (recept.ID_autora=korisnik.ID) WHERE username = '$receptUsername'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$BrRecepata =  $row['BrRecepata'];
			}
		$query = "SELECT slika FROM korisnik WHERE username='".$receptUsername."'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$slikaProf=$row['slika'];
		}
			
		if(!$_SESSION['potrebnaForma']){
		$prosjek=0;
		$glasova=0;			
		$query = "SELECT count(*) as glasova FROM ocjena INNER JOIN korisnik ON (korisnik.ID=ocjena.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=ocjena.id_recepta) WHERE recept.ID_recepta = '$receptID'";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{$glasova=$row['glasova'];}			
		if ($glasova>0){
			$query = "SELECT ROUND(AVG(ocjena),0) as prosjek FROM ocjena INNER JOIN korisnik ON (korisnik.ID=ocjena.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=ocjena.id_recepta) WHERE recept.ID_recepta = '$receptID'";
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{$prosjek=$row['prosjek'];}				
			}
		$query = "SELECT count(*) AS spremljen FROM spremljenirecepti INNER JOIN korisnik ON (korisnik.ID=spremljenirecepti.id_korisnika) INNER JOIN recept ON (recept.ID_recepta=spremljenirecepti.id_recepta) WHERE recept.ID_recepta = '$receptID' AND korisnik.username='".$_SESSION['user']."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	    $spremljen=$row['spremljen'];
			
		mysql_free_result($result);
		
		$_SESSION['id_recepta']=$receptID;
		}
	
	
	if ($dozvola<2 AND ($_SESSION['potrebnaForma'])){header('Location: index.php');}
?>



<html>
    <head>
        <meta charset="utf-8">
		
        <!--Title-->
        <title><?php echo $receptIme ?></title>
     
		<!--Main Style Css-->
        <link href="css/style.css" rel="stylesheet">
		<link href="css/hover.css" rel="stylesheet" media="all">
		<link href="css/grid.css" rel="stylesheet" media="all">
		<link href="css/rating.css" rel="stylesheet" media="all">
		
		<script src="js/jquery.js"></script>
    </head>
	
    <body onload='ocjena(<?php echo "$prosjek,$glasova" ?>);'>
	
		<!-- Start Header area  -->
        <?php include 'include/header.php'; 
			if ($permission!='admin'){
				$query = "SELECT flag FROM recept where ID_recepta = '$receptID'";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
					if($row['flag']==0){
						header('Location: index.php');
						exit();
					}
				}else {
					$query = "SELECT flag FROM recept where ID_recepta = '$receptID'";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
				}
			  include("include/profil_modal.php"); ?>
		<!-- End Header area  -->
		
		<!-- Content -->	
		<div style="margin-left:4%; color:#1a1a1a;"><br/><br/>
		<h1><span style="float:left"><?php echo $receptIme ?></h1></span>
							   <?php if ($permission=='admin'){?>
								<span style="float:left; margin-left:50px; margin-top:-15px">				
								<?php if($row['flag']==0){ ?>
							   <form action="admin/include/dozvola.php" method="GET" style="display:inline">
							   <input type="text" style="display:none;" name="dozvoli" value="<?php echo $receptID;?>">
							   <input type="submit" class="btn btn-success" value="Dozvoli">
							   </form>
							   <?php }?>			   
							   <form action="admin/include/dozvola.php" method="GET" style="display:inline">
							   <input type="text" style="display:none;" name="delete" value="<?php echo $receptID;?>">
							   <input type="submit" class="btn btn-danger" value="Obrisi">
							   </form>
							   <form action="/Projekt/uredi_recept.php" method="POST" style="display:inline">
							   <input type="text" style="display:none;" name="uredi" value="<?php echo $receptID;?>">
							   <input type="submit" class="btn btn-info" value="Uredi"></span> <?php } ?>
		</div>
		<br/><br/>
		<div style="color: #8c8c8c; font-weight:bold; margin: 0 0 20px 4%;">				
			<table>
			<tr><td><span style="font-family: Jura; font-size:120%"><?php echo "{$receptDatum} <br/>"; ?></span>
			<span style="color: #ff3333;font-family: Georgia, serif; font-style: italic; font-size:120%">
				<span style="cursor: pointer;" onclick="profil('<?php echo $receptUsername; ?>','<?php echo $slikaProf; ?>',' &emsp;<?php echo $spol; ?>',' &emsp;<?php echo $receptJoinD; ?>',' &emsp;<?php echo $receptLastL; ?>',' &emsp;<?php echo $BrRecepata; ?>');">
						<div class="search-option" style="position:relative; float:left">						
							<div style="margin-left:15px;margin-right:-10px;margin-top:-8px">
								<svg class="edit-pen-title">
								  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
								</svg>
							</div>
						</div>
				<b><?php echo "{$receptUsername}"; ?></b></span>
			</span></td>
			<?php if (!$_SESSION['potrebnaForma']) { ?>	
			<td>
			<div class="rating" style="margin-left:30px;">
					<input type="radio" id="star5" name="rating" value="5" <?php if($_SESSION['user']!=$receptUsername) print("onclick='dodajocjenu(5);'");else print("disabled=true");?>/><label for="star5" title="Odlicno!">5 stars</label>
					<input type="radio" id="star4" name="rating" value="4" <?php if($_SESSION['user']!=$receptUsername) print("onclick='dodajocjenu(4);'");else print("disabled=true");?>/><label for="star4" title="Vrlo dobro">4 stars</label>
					<input type="radio" id="star3" name="rating" value="3" <?php if($_SESSION['user']!=$receptUsername) print("onclick='dodajocjenu(3);'");else print("disabled=true");?>/><label for="star3" title="Dobro">3 stars</label>
					<input type="radio" id="star2" name="rating" value="2" <?php if($_SESSION['user']!=$receptUsername) print("onclick='dodajocjenu(2);'");else print("disabled=true");?>/><label for="star2" title="Dovoljno">2 stars</label>
					<input type="radio" id="star1" name="rating" value="1" <?php if($_SESSION['user']!=$receptUsername) print("onclick='dodajocjenu(1);'");else print("disabled=true");?>/><label for="star1" title="Nedovoljno">1 star</label>
				</div>
				</td><td><br/>(<span id="brojglasova" style="font-family: Jura;font-weight:bold; font-style:italic; "></span>)</td>
			<?php } ?>
			</tr>
			</table>
		</div>
		
		<div class="content-wrapper">
			<table class="box1" style="width:auto; margin: 0 100px 0 100px;">
			<?php if (!$_SESSION['potrebnaForma']) { ?>
				<tr><td colspan=3><span style="float:right"> <button id="btnfollow" class="btn1 followButton <?php if($spremljen==1)echo 'following'; ?>" onclick="spremirecept();" style="margin-bottom:20px" rel="6"><?php if($spremljen==1)echo 'Recept spremljen'; else echo 'Spremi recept'; ?></button></h1></span></td></tr>
				<?php }else echo"<tr><td><div style='height:25px'></div></td></tr>";  ?>
				<tr>
					<td>
						<div class="content-column" style="height:100%;">
							<div class="temp_content" style='border:solid 2px #f2f2f2;border: none;border-radius:10px; background-color: #ffffff; color: #333333; font-family: Georgia, serif; font-style: italic;"' >
								<h2 style="color:#0059b3">Sastojci:</h2>
								<br>
								<?php
									for($i = 0; $i < sizeof($receptSastojciArray); $i++) {
										echo $receptSastojciArray[$i];
										echo "<br>";
									}
								?>
							</div>
						</div>
					</td>
					<td>
						
							<div class="pic_content_prikaz" style="margin: 4px 10px 0 10px;">
								<img src="images/<?php echo $receptSlikaArray[0]  ?>" alt="Ne mozemo prikazati sliku =/" style="border-radius:10px; box-shadow: 5px 5px 2px #888888;width:600px;" onclick="document.getElementById('slika').style.display='block'" >
							</div>
							
					</td>
					<td>
						<div class="content-column" style="height:100%;">
						<div class="temp_content" style='border:solid 2px #f2f2f2; border-radius:10px; background-color: #ffffff; color: #333333; font-family: Georgia, serif; font-style: italic;'>
	
							<h2 style="color:#0059b3">Kratki opis:</h2>
								<br>
								<span style="font-style: italic;">
								<?php
									echo $receptOpis;
								?></span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br/><br/>
						<div style="max-width: 96.2%; border-radius:10px; margin: 0 50px 50px 50px">
							<div class="container" style=' color: #333333; font-family: Georgia, serif;' >
								<h2 style="color:#0059b3;">Priprema:</h2>
								<span style="color:#333333">
								<?php
									for($j = 0; $j < sizeof($receptPripremaArray); $j++) {
										echo "<br><br>";
										echo "<b>" . ($j+1) . ":&emsp;</b>";
										echo $receptPripremaArray[$j];
										echo "<br>";
									}
								?>
								</span>
									
							</div>
						</div>
					</td>
					<td>
					</td>
				</tr>
			</table>
		</div>
		<?php include 'include/footer.php'; ?>
		<script>
			function ocjena(prosjek, glasova){
				var radios = document.getElementsByName("rating");
				if(prosjek>0) {document.getElementById("brojglasova").innerHTML= glasova; radios[5-prosjek].checked='true';}
				else{
				document.getElementById("brojglasova").innerHTML="0";}
			}
			
			function dodajocjenu(ocj){
				$.ajax({
					type: "POST",
					url: 'include/dodajocjenu.php',
					data: {ocjeni: ocj},
					success: function(data){
						document.getElementById("brojglasova").innerHTML = (parseInt(document.getElementById("brojglasova").innerHTML)+parseInt(data));
						updateVote();
					}
			});
			}
			
		 	function updateVote(){
				var radios = document.getElementsByName("rating");
				$.ajax({
					type: "POST",
					url: 'include/dodajocjenu.php',
					data: {prosjek: true},
					success: function(data){
						radios[5-parseInt(data)].checked='true';
					}
			});
			}

		function spremirecept(){
			$.ajax({
						type: "POST",
						url: 'include/spremirecept.php',
						data: {spremi: true},
						success: function(data){
							if (data==1){
								document.getElementById("btnfollow").className="btn1 followButton following";
								document.getElementById("btnfollow").innerHTML="Recept spremljen";
							}else{
								document.getElementById("btnfollow").className="btn1 followButton";
								document.getElementById("btnfollow").innerHTML="Spremi recept";
							}
						}
				});
		}
		function profil(tmp1,tmp2,tmp3,tmp4,tmp5,tmp6){		
		document.getElementById('korisnickoime').innerHTML=tmp1;
		document.getElementById('spolProf').innerHTML=tmp3;
		document.getElementById('JoinDProf').innerHTML=tmp4;
		document.getElementById('LastLProf').innerHTML=tmp5;
		document.getElementById('BrRProf').innerHTML=tmp6;
		document.getElementById('slikaProf').style.backgroundImage="url('images/profile/"+tmp2+"')";
		document.getElementById('profil').style.display='block';
	}
		</script>
	</body>
</html>

	<?php } else header('Location: index.php');?>