		<?php 
			//Nakon 20 minuta inaktivnosti korisnik se automatski odjavljuje
			if(time()- $_SESSION['time']>1200){
				$_SESSION = Array ();
				$potrebnaForma = true;
				$_SESSION['potrebnaForma']=true;
			}else{
				$_SESSION['time']=time();
			}
			$query = "SELECT permission FROM korisnik WHERE username = '".$_SESSION['user']."'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$permission =  $row['permission'];}
		?>
			
	<div class="header_top_area" style="max-width:100%; height: 80px; margin-left: 0;margin-right: 0; background-color:#333333; ">
			<div class="login_button_area" style="float:left; margin-top:8px; margin-left:10px;" >                                                      
                <button id="naslovnica"
						type="button" 
						onclick="location.href = 'index.php';"
						style="width:auto; border-radius:20px;background-color:#333333;" 
						class="loginbtn hvr-glow">NASLOVNICA</button>
			</div>

			<?php if(!($_SESSION['potrebnaForma'])) { ?>
			<div class="dropdown" style="float:left;  margin: 8px 10px 8px 10px;  z-index: 1; ">
			<button class="dropbtn  hvr-glow" style="width:auto;border-radius:20px;background-color:#333333;">Recepti</button>
				<div class="dropdown-content" style="border-radius:20px;left:0; z-index: 2;">
					<a class="dropdown-meni" style="border-top-left-radius:20px;border-top-right-radius:20px;" href="mojirecepti.php"> Moji recepti </a>
					<a class="dropdown-meni" href="spremljeno.php"> Spremljeno </a>
					<a class="dropdown-meni" style="border-bottom-left-radius:20px;border-bottom-right-radius:20px;" href="dodaj_recept.php"> Dodaj recept </a>
				</div>
			</div>

			<?php } ?>
			<?php 	if($_SESSION['potrebnaForma']) {include("include/login_modal.php");}
					else include("include/user.php"); ?>
						<?php if(($_SESSION['potrebnaForma'])) { ?>
							<div class="login_button_area" style="margin: 8px 0px 8px 0px; float:right;">
							<button type="button" 
									onclick="document.getElementById('login').style.display='block';" 
									style="width:auto;border-radius:20px;background-color:#333333;margin-left:10px;margin-right:10px" 
									class="loginbtn hvr-glow">Prijavi se</button>
							</div>
							<div class="login_button_area" style="margin: 8px 0px 8px 0px; float:right;">                                                      
							<button type="button" 
									onclick="location.href = 'register.php';"
									style="width:auto;border-radius:20px;background-color:#333333;" 
									class="loginbtn hvr-glow">REGISTRIRAJ SE</button>
							</div>
						<?php } else { ?>
							<div class="login_button_area" style="float:right">	
							<button type="submit"
									onclick="location.href='logout.php'"
									style="width:auto;margin: 8px 10px 8px 10px; border-radius:20px;background-color:#333333;" 
									class="loginbtn hvr-glow">Odjavi se</button>	
							</div>
							<?php if ($permission=='admin'){?>
								<div class="login_button_area" style="float:right; margin: 8px 10px 8px 10px" >                                                      
									<div type="button" 
											onclick="location.href = 'admin.php?no=2&page=1';"
											style="color:yellow;width:auto;border-radius:20px;background-color:#333333;" 
											class="loginbtn hvr-glow">ADMIN</div>
								</div>
						<?php } else { ?>
										<div class="login_button_area" style="float:right; margin: 8px 10px 8px 10px" >                                                      
											<div type="button" 
													onclick="location.href = 'profil.php';"
													style="color:yellow;width:auto;border-radius:20px;background-color:#333333;"
													class="loginbtn hvr-glow"><?php echo $_SESSION['user']?></div>
										</div>
						<?php }} ?>
				  
				  <form action="recepti.php" method="GET" class="search-form">
					  <input type="search" name="search" placeholder="Pretraži recepte" class="search-input" id="search-form">
					  <button type="submit" class="search-button">
						<svg class="submit-button">
						  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use>
						</svg>
					  </button>
				</form>		
		</div>
		
		
		<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
		  <symbol id="search" viewBox="0 0 32 32">
			<path d="M 19.5 3 C 14.26514 3 10 7.2651394 10 12.5 C 10 14.749977 10.810825 16.807458 12.125 18.4375 L 3.28125 27.28125 L 4.71875 28.71875 L 13.5625 19.875 C 15.192542 21.189175 17.250023 22 19.5 22 C 24.73486 22 29 17.73486 29 12.5 C 29 7.2651394 24.73486 3 19.5 3 z M 19.5 5 C 23.65398 5 27 8.3460198 27 12.5 C 27 16.65398 23.65398 20 19.5 20 C 15.34602 20 12 16.65398 12 12.5 C 12 8.3460198 15.34602 5 19.5 5 z" />
		  </symbol>
		  <symbol id="user" viewBox="0 0 32 32">
			<path d="M 16 4 C 12.145852 4 9 7.1458513 9 11 C 9 13.393064 10.220383 15.517805 12.0625 16.78125 C 8.485554 18.302923 6 21.859881 6 26 L 8 26 C 8 21.533333 11.533333 18 16 18 C 20.466667 18 24 21.533333 24 26 L 26 26 C 26 21.859881 23.514446 18.302923 19.9375 16.78125 C 21.779617 15.517805 23 13.393064 23 11 C 23 7.1458513 19.854148 4 16 4 z M 16 6 C 18.773268 6 21 8.2267317 21 11 C 21 13.773268 18.773268 16 16 16 C 13.226732 16 11 13.773268 11 11 C 11 8.2267317 13.226732 6 16 6 z" /></symbol>
		  <symbol id="images" viewbox="0 0 32 32">
			<path d="M 2 5 L 2 6 L 2 26 L 2 27 L 3 27 L 29 27 L 30 27 L 30 26 L 30 6 L 30 5 L 29 5 L 3 5 L 2 5 z M 4 7 L 28 7 L 28 20.90625 L 22.71875 15.59375 L 22 14.875 L 21.28125 15.59375 L 17.46875 19.40625 L 11.71875 13.59375 L 11 12.875 L 10.28125 13.59375 L 4 19.875 L 4 7 z M 24 9 C 22.895431 9 22 9.8954305 22 11 C 22 12.104569 22.895431 13 24 13 C 25.104569 13 26 12.104569 26 11 C 26 9.8954305 25.104569 9 24 9 z M 11 15.71875 L 20.1875 25 L 4 25 L 4 22.71875 L 11 15.71875 z M 22 17.71875 L 28 23.71875 L 28 25 L 23.03125 25 L 18.875 20.8125 L 22 17.71875 z" />
		  </symbol>
		  <symbol id="post" viewbox="0 0 32 32">
			<path d="M 3 5 L 3 6 L 3 23 C 3 25.209804 4.7901961 27 7 27 L 25 27 C 27.209804 27 29 25.209804 29 23 L 29 13 L 29 12 L 28 12 L 23 12 L 23 6 L 23 5 L 22 5 L 4 5 L 3 5 z M 5 7 L 21 7 L 21 12 L 21 13 L 21 23 C 21 23.73015 21.221057 24.41091 21.5625 25 L 7 25 C 5.8098039 25 5 24.190196 5 23 L 5 7 z M 7 9 L 7 10 L 7 13 L 7 14 L 8 14 L 18 14 L 19 14 L 19 13 L 19 10 L 19 9 L 18 9 L 8 9 L 7 9 z M 9 11 L 17 11 L 17 12 L 9 12 L 9 11 z M 23 14 L 27 14 L 27 23 C 27 24.190196 26.190196 25 25 25 C 23.809804 25 23 24.190196 23 23 L 23 14 z M 7 15 L 7 17 L 12 17 L 12 15 L 7 15 z M 14 15 L 14 17 L 19 17 L 19 15 L 14 15 z M 7 18 L 7 20 L 12 20 L 12 18 L 7 18 z M 14 18 L 14 20 L 19 20 L 19 18 L 14 18 z M 7 21 L 7 23 L 12 23 L 12 21 L 7 21 z M 14 21 L 14 23 L 19 23 L 19 21 L 14 21 z" />
		  </symbol>
		</svg>
