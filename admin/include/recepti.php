<?php
  	session_start();
	require_once("connect_to_mysql.php");
	$query = "SELECT * FROM recept INNER JOIN korisnik ON (korisnik.ID=recept.ID_autora) WHERE flag=0 ORDER BY Ime_recepta";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$receptid[]=$row['ID_recepta'];
			$receptIme[]=$row['Ime_recepta'];
			$korisnik[]=$row['username'];
			$receptDatum[] = date('d.m.Y', strtotime( $row['datum_objave'] ));			
		}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">    
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Čekaju odobrenje</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
           
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        
                        <th>Naziv recepta</th>
                        <th>Objavio</th>
						<th>Datum</th>
						<th><em class="fa fa-cog"></em></th>
                    </tr> 
                  </thead>
                  <tbody>
                          <?php for($i=0+($_GET['page']-1)*50; $i<50+($_GET['page']-1)*50 AND $i<count($receptid);$i++) {?>
						  <tr>
                            <?php echo "<td>".$receptIme[$i]."</td>"?>
                            <?php echo "<td>".$korisnik[$i]."</td>"?>
							<?php echo "<td>".$receptDatum[$i]."</td>"?>
							  <td align="center">
							   <form action="admin/include/dozvola.php" method="GET" style="display:inline">
							   <input type="text" style="display:none;" name="dozvoli" value="<?php echo $receptid[$i];?>">
							   <input type="submit" class="btn btn-success" value="Dozvoli">
							   </form>
							   <form action="admin/include/dozvola.php" method="GET" style="display:inline">
							   <input type="text" style="display:none;" name="delete" value="<?php echo $receptid[$i];?>">
							   <input type="submit" class="btn btn-danger" value="Obrisi">
							   </form>
							   <form action="/Projekt/recept.php" method="GET" style="display:inline">
							   <input type="text" style="display:none;" name="id" value="<?php echo $receptid[$i];?>">
							   <input type="submit" class="btn btn-info" value="Pogledaj">
							   </form>
							   <form action="/Projekt/uredi_recept.php" method="POST" style="display:inline">
							   <input type="text" style="display:none;" name="uredi" value="<?php echo $receptid[$i];?>">
							   <input type="submit" class="btn btn-warning" value="Uredi">
							   </form>
                            </td>
                          </tr>
						  <?php }?>
                        </tbody>
                </table>
            
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col col-xs-4">
                  </div>
                  <div class="col col-xs-8">
                    <ul class="pagination hidden-xs pull-right">
                      <?php for($i=0;$i<ceil(count($receptid)/50);$i++) {?>
					  <li><a href="?no=1&page=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>
                      <?php }?>
                    </ul>
                    <ul class="pagination visible-xs pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

</div></div></div>
	
     