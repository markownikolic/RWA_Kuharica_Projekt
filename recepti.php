<?php
	session_start();
	
	require_once("include/connect_to_mysql.php");
	
	if(isset($_GET['search'])){
		$uzorak=$_GET['search'];
		$query = "SELECT * from korisnik WHERE username LIKE '%".$uzorak."%' ORDER BY username ASC";
		$result = mysql_query($query);
		$receptDatumASC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$usernameArray[] =  $row['username'];
		}
				
		$query = "SELECT recept.ID_recepta from recept WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' ORDER BY Ime_recepta ASC";
		$result = mysql_query($query);
		$receptImeASC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptImeASC[] =  $row['ID_recepta'];
		}
		$query = "SELECT recept.ID_recepta from recept WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' ORDER BY Ime_recepta DESC";
		$result = mysql_query($query);
		$receptImeDESC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptImeDESC[] =  $row['ID_recepta'];
		}
		$query = "SELECT recept.ID_recepta from recept WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' ORDER BY datum_objave ASC";
		$result = mysql_query($query);
		$receptDatumASC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptDatumASC[] =  $row['ID_recepta'];
		}
		$query = "SELECT recept.ID_recepta from recept WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' ORDER BY datum_objave DESC";
		$result = mysql_query($query);
		$receptDatumDESC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptDatumDESC[] =  $row['ID_recepta'];
		}
		$query = "SELECT recept.ID_recepta,AVG(ocjena.ocjena) AS prosjek from recept LEFT OUTER JOIN ocjena ON (ocjena.id_recepta=recept.ID_recepta)
				  WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' GROUP BY recept.ID_recepta ORDER BY prosjek ASC";
		$result = mysql_query($query);
		$receptOcjenaASC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptOcjenaASC[] =  $row['ID_recepta'];
		}
		$query = "SELECT recept.ID_recepta,AVG(ocjena.ocjena) AS prosjek from recept LEFT OUTER JOIN ocjena ON (ocjena.id_recepta=recept.ID_recepta)
				  WHERE flag=1 AND Ime_recepta LIKE '%".$uzorak."%' GROUP BY recept.ID_recepta ORDER BY prosjek DESC";
		$result = mysql_query($query);
		$receptOcjenaDESC = Array();	
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptOcjenaDESC[] =  $row['ID_recepta'];
		}
		
		if(isset($_GET['stranica'])) {
			$brojStranice = $_GET['stranica'];
		} else {
			$brojStranice=1;
		}
			
		$receptArray=$receptImeASC;
		$sortby="ime";
		$poredak="asc";
		$num=10;
		if((isset($_GET['sortby']))&&(isset($_GET['poredak']))&&(isset($_GET['num']))){
			if(($_GET['sortby']=='ime')&&($_GET['poredak']=='asc')){$receptArray=$receptImeASC;}
			if(($_GET['sortby']=='ime')&&($_GET['poredak']=='desc')){$receptArray=$receptImeDESC;}
			if(($_GET['sortby']=='ocjena')&&($_GET['poredak']=='asc')){$receptArray=$receptOcjenaASC;}
			if(($_GET['sortby']=='ocjena')&&($_GET['poredak']=='desc')){$receptArray=$receptOcjenaDESC;}
			if(($_GET['sortby']=='datum')&&($_GET['poredak']=='asc')){$receptArray=$receptDatumASC;}
			if(($_GET['sortby']=='datum')&&($_GET['poredak']=='desc')){$receptArray=$receptDatumDESC;}
			$sortby=$_GET['sortby'];
			$poredak=$_GET['poredak'];
			$num=$_GET['num'];
		}
		if(isset($_GET['num'])){$num=$_GET['num'];}
	}
	//mysql_free_result($result);
	
?>

<html>			 
<head>
	<link href="css/hover.css" rel="stylesheet" media="all">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/grid.css" rel="stylesheet" media="all">

</head>

<body>
	<?php include 'include/header.php';?>
	<div class="hero-unit-2" style="float: center;height: 30px;margin-left:1px; text-indent: 30px">
		<form action="" method="GET">
			<div style="font-size:120%; font-weight:bold; text-align:left;float:left" <?php if($_SESSION['potrebnaForma']) { echo "hidden"; }?>>Poredaj po: 
			<select id="sortby" name="sortby" onchange="poredakSearch()">
				<option value="ime" <?php if($sortby=='ime') echo "selected='selected'"; ?> >Imenu</option>
				<option value="ocjena" <?php if($sortby=='ocjena') echo "selected='selected'"; ?> >Ocjeni</option>
				<option value="datum" <?php if($sortby=='datum') echo "selected='selected'"; ?> >Datumu objave</option>
			</select>
			<span style="font-size:80%; font-weight:bold;">
			<input type="radio" onclick="poredakSearch();" name="poredak" value="asc" <?php if($poredak=='asc') echo "checked='checked'"; ?>>Uzlazno
			<input type="radio" onclick="poredakSearch();" name="poredak" value="desc"<?php if($poredak=='desc') echo "checked='checked'"; ?>>Silazno
			</span>
			</div>
			<div style="font-size:120%; font-weight:bold; <?php if(!($_SESSION['potrebnaForma'])) { echo 'float:right;'; } else echo 'float:left;'; ?> margin-right:30px">Recepata po stranici:
			<select id="num" name="num" onchange="poredakSearch()">
				<option value="10" <?php if($num==10) echo "selected='selected'"; ?>>10</option>
				<option value="20" <?php if($num==20) echo "selected='selected'"; ?>>20</option>
				<option value="30" <?php if($num==30) echo "selected='selected'"; ?>>30</option>
				<option value="40" <?php if($num==40) echo "selected='selected'"; ?>>40</option>
				<option value="50" <?php if($num==50) echo "selected='selected'"; ?>>50</option>
			</select>
			</div>	
		</form>
	</div>
	
	<div style="min-height:100%;margin-top:20px; margin-left:40px; margin-right:40px;display:block;">
	<?php  for($i=0; $i < ($num/5) AND ($i<ceil((count($receptArray)-(($brojStranice-1)*$num))/5)); $i++){ ?>
		<div class="grid" style="float:left; min-width:98%; margin: 10px 10px 10px 10px;">
			<?php  for($j = ($i*5)+$num*($brojStranice-1); ($j < (($i*5)+$num*($brojStranice-1))+5)AND($j<count($receptArray)); $j++){
			$idRecepta = $receptArray[$j];			?>
			<div class="col-1-5">
								   
					<?php include("include/content_box.php"); ?>			
				
			</div>
			<?php } ?>
		</div>
	<?php } ?>	
	</div>
	
	<?php	
	// Prikaz stranicnih linkova:
	print("<div class='hero-unit-2' style='font-family: Georgia, serif; margin-left:5px;float:left; margin-bottom:-45px;width:97%;text-align:center; height: 20px; margin-top:20px; display:block;'>");
	for($i=1; $i<= ceil(count($receptArray)/$num); $i++){
		if($i==1 AND $brojStranice==1){print("<i>prethodna</i> &nbsp; &nbsp;");}
		if($i==1 AND $brojStranice!=1){print("<a style='color:blue;' href='".str_replace('&stranica='.$brojStranice,'',basename($_SERVER['REQUEST_URI']))."&stranica=".($brojStranice-1)."'><i>prethodna</i></a> &nbsp; &nbsp;");}
		print("<b>");
		if ($i != $brojStranice){
			print("<a style='font-size:110%; color:blue' href='".str_replace('&stranica='.$brojStranice,'',basename($_SERVER['REQUEST_URI']))."&stranica=". $i . "'>" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print("<span style='font-style: italic;' >".$i . "&nbsp; &nbsp;</span>");
		}
		print("</b>");
		if($i==ceil(count($receptArray)/$num) AND $brojStranice==ceil(count($receptArray)/$num)){print("<i> sljedeca</i> ");}
		if($i==ceil(count($receptArray)/$num) AND $brojStranice!=ceil(count($receptArray)/$num)){print("<a style='color:blue' href='".str_replace('&stranica='.$brojStranice,'',basename($_SERVER['REQUEST_URI']))."&stranica=".($brojStranice+1)."'><i>sljedeca</i></a>");}
	}
	print("</div>"); 
	?>
	
	<script>
			function poredakSearch(){
				var sortby=document.getElementById("sortby").options[document.getElementById("sortby").selectedIndex].value;
				if(document.getElementsByName("poredak")[0].checked){var poredak="asc";}else{var poredak="desc";}
				var num=document.getElementById("num").options[document.getElementById("num").selectedIndex].value;
				location.href="recepti.php?search=<?php echo $_GET['search'];?>&sortby="+sortby+"&poredak="+poredak+"&num="+num;
			}
	</script>
	
	<?php include 'include/footer.php'; ?>
</body>
</html>