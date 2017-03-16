<?php
		session_start();
		require("include/connect_to_mysql.php");

		$query = "SELECT * FROM spremljenirecepti INNER JOIN korisnik ON (id_korisnika=korisnik.ID) INNER JOIN slika ON (spremljenirecepti.ID_recepta=slika.ID_recepta) INNER JOIN recept ON (spremljenirecepti.id_recepta=recept.ID_recepta) WHERE flag=1 AND username = '".$_SESSION['user']."' ORDER BY Ime_recepta";
			$result = mysql_query($query);
			$receptIDArrayRating = Array();
			$receptSlika = Array();
			$receptIme = Array();
			$receptDatum=Array();
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$receptIDArrayRating[] =  $row['ID_recepta'];
				$receptSlika[] =  $row['Ime_slike'];
				$receptIme[] = $row['Ime_recepta'];
				$receptDatum[]= date('d.m.Y', strtotime( $row['datum_objave'] ));
				$idkorisnika= $row['ID'];
			}

			if (isset($_POST['ukloni'])){
				$query = "DELETE FROM spremljenirecepti WHERE id_korisnika='$idkorisnika' AND id_recepta=".$_POST['ukloni'];
				$result = mysql_query($query);
			}
?>


<html>
	<head>
	
		<meta charset="utf-8">
		
        <title>Kuharica | Moji recepti </title>
		
        <link href="css/style.css" rel="stylesheet">
		<link href="css/grid.css" rel="stylesheet" media="all">
		<link href="css/hover.css" rel="stylesheet" media="all">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">		
		<script src="js/jquery.js"></script>
		
	</head>
	
	<body>
		
		<?php
		include 'include/header.php';
		if (!$_SESSION['potrebnaForma']) {		
		?>
			<div style="height:90%;">
			<div class="alert" style="margin:2px 20px 0 20px;text-align:center; height:20px; opacity:0.9"></div>	
			<?php  for($i=0; $i < ceil(count($receptIDArrayRating)/8); $i++){ ?>
			<div class="grid" style="float:left; margin: 10px 10px 10px 10px; min-width: 98%">
				<?php  for($j = $i*8; $j <= (($i*8)+7) AND $j<count($receptIDArrayRating); $j++){?>
				<div class="col-1-8">
					<div class="module">
						<div class="box1" style="display: table; margin: 0 auto; width:85%">
							<?php echo "<a href='recept.php?id=".$receptIDArrayRating[$j]. "' style='text-decoration: none;'>"; ?>
								<div style="height: 120px; width:100%;background-size:cover; border-radius:4px; background-color:#ccc; 
											background-position: center center; background-image: url('images/<?php echo $receptSlika[$j]; ?>');border: solid 2px #888888;"></div>
								<?php						
								echo "<div class='text-center' style=' height:30px; font-weight: bold; font-size: 115%; color:#0059b3'>{$receptIme[$j]}</div>";
								?></a>
								<div style="margin-top:25px;">

								<button id="btnfollow" style="width:100%" class="btn btn-danger" onclick="spremirecept(<?php echo $receptIDArrayRating[$j];?>);" 
								rel="6">Ukloni</button>
				
								</div>
						</div>
					</div>
				</div>
			<?php } ?>		
			</div>
			<?php } ?>
			</div>
		<?php }else{
					exit();}
		include 'include/footer.php'; ?>
			<script>
				function spremirecept(tmp){
					$.ajax({
								type: "POST",
								url: 'spremljeno.php',
								data: {ukloni: tmp},
								success: function(data){
									location.href="spremljeno.php";
								}
						});
				}
			</script>
	</body>
</html>