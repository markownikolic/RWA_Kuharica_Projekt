<?php
	//header('Cache-Control: no cache'); //no cache
	//session_cache_limiter('private_no_expire'); // works
	session_start();
	require_once("include/connect_to_mysql.php");
	echo "<script>var tmp=0;</script>";
	//Provjera dali je korisnik ulogiran ili odlogiran te postavljanje sessija
	if ( isset($_GET['logout'])) {
		$_SESSION = Array ();
		$potrebnaForma = true;
		$_SESSION['potrebnaForma']=true;
		header('Location: index.php');
	} else if (isset($_SESSION['user'])) {
		$potrebnaForma = false;
		$_SESSION['potrebnaForma']=false;
	} else if (!isset($_POST['uname']) || !isset($_POST['psw'])) {
		$potrebnaForma = true;
		$_SESSION['potrebnaForma']=true;
		}
		else {
			echo "<script>var tmp=1;</script>";
			$user = $_POST['uname'];
			$pass = md5($_POST['psw']);
			$_SESSION['user']=$user;
			$_SESSION['pass']=$pass;
			$_SESSION['potrebnaForma']=false;
			$potrebnaForma = false;
			$query = "UPDATE korisnik SET last_login=NOW() WHERE username='".$user."'";
			mysql_query($query);
			$_SESSION['time']=time();
			//header('Location: index.php');
		}
	
	if (!($_SESSION['potrebnaForma'])) {
	//Registrirani korisnik
	//Dohvacanje recepata sortirano po datumu objave, od najnovijih prema starijima	
	$query = "SELECT ID_recepta FROM recept WHERE flag=1 ORDER BY datum_objave DESC";
	$result = mysql_query($query);
	$receptIDArrayDate = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$receptIDArrayDate[] =  $row['ID_recepta'];
	}
	//Dohvacanje recepata sortirano po ocjeni, od najvece prema najmanjoj
	$query = "SELECT recept.ID_recepta, AVG(ocjena.ocjena) AS prosjek FROM recept LEFT OUTER JOIN ocjena ON (ocjena.id_recepta=recept.ID_recepta) WHERE flag=1 GROUP BY recept.ID_recepta ORDER BY prosjek DESC";
	$result = mysql_query($query);
	$receptIDArrayRating = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$receptIDArrayRating[] =  $row['ID_recepta'];
	}
	}else{
	//Neregistrirani korisnik
	//Dohvacanje recepata sortirano po datumu objave, od najnovijih prema starijima	
	$query = "SELECT ID_recepta FROM recept WHERE flag=1 AND dozvola=2 ORDER BY datum_objave DESC";
	$result = mysql_query($query);
	$receptIDArrayDate = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$receptIDArrayDate[] =  $row['ID_recepta'];
	}
	}
	
	mysql_free_result($result);
	
	if (isset($_GET['log'])){
		if (($_GET['log'])==0){
			echo "<script>var tmp=2;</script>";
		}
	}
		
?>


<html>
<head>
    <meta charset="utf-8">		
    <!--Title-->
    <title>Kuharica</title>   
	<!--Main Style Css-->
	
	<link href="css/style.css" rel="stylesheet">
	<link href="css/grid.css" rel="stylesheet" media="all">
	<link href="css/hover.css" rel="stylesheet" media="all">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">		
	<script src="js/jquery.js"></script>
</head>

<body>
	<!-- Start Header area  -->
	<?php include 'include/header.php'; ?>
	<div class="alert" id="obavijestIndex" style="margin:2px 20px 0 20px;text-align:center; height:20px; opacity:0.9"></div>	
	<!-- End Header area  -->
	<!-- Content -->			
	<!-- Ispis najnovijih recepata -->
		<div style="height:55%"></div>
			<div style="margin-left:2%; cursor:pointer;"><br/><br/><h1 onclick="location.href='recepti.php?search=&type=recepti&sortby=datum&poredak=desc&num=10';" style="float:left;">Novi recepti</h1></div>
			<div class="grid" style="float:left; margin: 10px 10px 10px 10px; min-width:98%">
				<?php  for($i = 0; $i <= 4 AND $i<count($receptIDArrayDate); $i++){
				$idRecepta = $receptIDArrayDate[$i];			?>
				<div class="col-1-5">
					<div class="module">				   
						<?php include("include/content_box.php"); ?>			
					</div>
				</div>
				<?php } ?>	
			</div>
			<div style="float: left; height:40px; width:100%"></div>
			
	<!-- Ispis najbolje ocjenjenih recepata -->	
		<?php if (!$_SESSION['potrebnaForma']) {?>
		<div style="margin-left:2%;cursor:pointer;"><br/><br/><h1 onclick="location.href='recepti.php?search=&type=recepti&sortby=ocjena&poredak=desc&num=10';" style="float:left;">Najbolje ocjenjeno</h1></div>
			<div class="grid" style="float:left; margin: 10px 10px 10px 10px;min-width:98%">
				<?php  for($i = 0; $i <= 4 AND $i<count($receptIDArrayDate); $i++){
				$idRecepta = $receptIDArrayRating[$i];			?>
				<div class="col-1-5">
					<div class="module">				   
						<?php include("include/content_box.php"); ?>			
					</div>
				</div>
			<?php } ?>
			</div>			
		<?php } ?>
		<!-- Footer  -->
		<?php include 'include/footer.php'; ?>	
			<script>
				function obavijestIndex(tmp){
					if (tmp==1){
						document.getElementById('obavijestIndex').className='alert alert-success';
						document.getElementById('obavijestIndex').innerHTML='<strong>Uspješno ste prijavljeni</strong>';
					}
					if (tmp==2){
						document.getElementById('obavijestIndex').className='alert alert-danger';
						document.getElementById('obavijestIndex').innerHTML='<strong>Greška! Korisničko ime i lozinka se ne poklapaju</strong>';
					}
					setTimeout(function(){
						document.getElementById('obavijestIndex').className='alert';
						document.getElementById('obavijestIndex').innerHTML='';						
					}, 2500);
					var tmp=0;
				}
				obavijestIndex(tmp); 
			</script>
</body>
</html>