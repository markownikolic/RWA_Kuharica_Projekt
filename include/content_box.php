<?php		
		$query = "SELECT * FROM recept where ID_recepta = '$idRecepta'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptDatum = date('d.m.Y', strtotime( $row['datum_objave'] ));
				$receptIme = $row['Ime_recepta'];
				$receptOpis = $row['Kratki_opis'];
				$dozvola = $row['dozvola'];
			}
		$query = "SELECT Ime_slike FROM slika where ID_recepta = '$idRecepta'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptSlika =  $row['Ime_slike'];
			}
		$query = "SELECT username, join_date, spol, last_login FROM korisnik INNER JOIN recept ON (recept.ID_autora=korisnik.ID) WHERE ID_recepta = '$idRecepta'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptUsername =  $row['username'];
				$spol = $row['spol'];
				$receptJoinD =  date('d.m.Y', strtotime( $row['join_date'] ));
				$receptLastL =  date('d.m.Y H:i', strtotime( $row['last_login'] ));
			}
		$query = "SELECT count(*) as BrRecepata FROM korisnik INNER JOIN recept ON (recept.ID_autora=korisnik.ID) WHERE username = '$receptUsername'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$BrRecepata =  $row['BrRecepata'];
			}
	
	$query = "SELECT ROUND(AVG(ocjena.ocjena),2) AS prosjek FROM recept INNER JOIN ocjena ON (ocjena.id_recepta=recept.ID_recepta) WHERE recept.ID_recepta = '$idRecepta'";
	$result = mysql_query($query);
	$receptRating =  mysql_fetch_array($result, MYSQL_ASSOC)['prosjek'];
	
	mysql_free_result($result);
	include("include/profil_modal.php"); 
	$query = "SELECT slika FROM korisnik WHERE username='".$receptUsername."'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$slikaProf=$row['slika'];
		}?>

<div class="box1" style="display: table; margin: 0 auto; width:85%">
	<?php echo "<a href=\"recept.php?id={$idRecepta}\" style='text-decoration: none;'>"; ?>
		<div style="height: 150px; width:100%;background-size:cover; border-radius:4px; background-color:#ccc; 
					background-position: center center; background-image: url('images/<?php echo $receptSlika; ?>');border: solid 2px #888888;"></div>
	<?php						
		echo "<div class='text-center' style=' height:30px; font-weight: bold; font-size: 130%; color:#0059b3'>{$receptIme}</div>";
		echo "<p style='overflow:auto; height:100px; width:auto;color:#585858 ; font-weight: normal; font-family: Georgia, serif; font-style: italic;'>{$receptOpis}</p>";?></a>
	<div style="color: #b3b3b3;vertical-align: top; width:100%; margin: -3px 0px 0px 0px;">				
		<span style="flaot:left"><?php echo "{$receptDatum}"; ?></span> <?php if (!$_SESSION['potrebnaForma']) {?><span style="float:right"><?php echo $receptRating ?></span><?php }?>
		 <br/>
		<span style="color: #ff1a1a; font-family: Georgia, serif; font-style: italic;">
			<div class="search-option" style="position:relative; float:left">						
				<div style="margin-left:10px;margin-right:-15px;margin-top:-11px">
					<svg class="edit-pen-title">
						  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
					</svg>
				</div>
			</div>
		<span style="cursor: pointer;" onclick="profil('<?php echo $receptUsername; ?>','<?php echo $slikaProf; ?>',' &emsp;<?php echo $spol; ?>',' &emsp;<?php echo $receptJoinD; ?>',' &emsp;<?php echo $receptLastL; ?>',' &emsp;<?php echo $BrRecepata; ?>');"><?php echo "<b>{$receptUsername} </b>"; ?></span>
		</span>
	</div>				
</div>	

<script>
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