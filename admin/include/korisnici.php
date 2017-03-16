<?php
  	session_start();
	require_once("connect_to_mysql.php");
	$query = "SELECT * FROM korisnik ORDER BY username";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$korisnikid[]=$row['id'];
			$korisnikuser[]=$row['username'];
			$korisnikemail[]=$row['email'];
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
                    <h3 class="panel-title">Korisnici</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
           
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th>Korisničko ime</th>
                        <th>E-mail</th>
                    </tr> 
                  </thead>
                  <tbody>
                          <?php for($i=0+($_GET['page']-1)*50; $i<50+($_GET['page']-1)*50 AND $i<count($korisnikid);$i++) {?>
						  <tr>
                            <td align="center">
                              <a href="admin/include/deletekorisnik.php?username=<?php echo $korisnikuser[$i]?>" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                            </td>
                            <?php echo "<td>".$korisnikuser[$i]."</td>"?>
                            <?php echo "<td>".$korisnikemail[$i]."</td>"?>
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
                      <?php for($i=0;$i<ceil(count($korisnikid)/50);$i++) {?>
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
	
     