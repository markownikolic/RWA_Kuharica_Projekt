<?php
	//header('Cache-Control: no cache'); //no cache
	//session_cache_limiter('private_no_expire'); // works
	session_start();
	require_once("include/connect_to_mysql.php");
	
		if(time()- $_SESSION['time']>1200){
				$_SESSION = Array ();
				$potrebnaForma = true;
				$_SESSION['potrebnaForma']=true;
			}else{
				$_SESSION['time']=time();
			}
		$query = "SELECT count(*) as brdozvola FROM recept INNER JOIN korisnik ON (korisnik.ID=recept.ID_autora) WHERE flag=0";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$brdozvola=$row['brdozvola'];		
		}
		$query = "SELECT count(*) as brkorisnika FROM korisnik";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$brkorisnika=$row['brkorisnika'];
		}
		?>


<html>
<head>
    <meta charset="utf-8">		
    <!--Title-->
    <title>Kuharica</title>   
	<!--Main Style Css-->
	
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/grid.css" rel="stylesheet" media="all">
	<link href="css/hover.css" rel="stylesheet" media="all">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">		
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap-min.js"></script>
	
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-weight:bold" href="index.php">Povratak</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id="navkorisnici"><a href="admin.php?no=1&page=1" onclick="document.getElementById('navkorisnici').className='active';">Korisnici <span class="badge"><?php echo $brkorisnika; ?></span></a></li>
		<li id="navobavjesti" ><a href="admin.php?no=2&page=1" onclick="document.getElementById('navobavjesti').className='active'">Recepti za pregled <span class="badge"><?php echo $brdozvola; ?></span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?logout=1">Odjavi se</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
 if(isset($_GET['no'])){
	if ($_GET['no']==1) {
		include("admin/include/korisnici.php");
		}
	if ($_GET['no']==2) {
		include("admin/include/recepti.php");
		}
 }
?>
<script>
	
</script>
</body>
</html>