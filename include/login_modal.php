<div class="login_button_area" style="float:right">                                                      
                									
					<div id="login" class="modal" style="z-index=1; color:black">									
					<form method="POST" action="index.php" class="modal-content animate" style="border-radius:10px;">
						<div class="container" style="width:auto;" >
							<label><b>Korisničko ime</b></label>
							<input style="font-family:LatoLight;" class="text_psw_input" type="text" placeholder="Unesi korisničko ime" name="uname" required>
												
							<label><b>Lozinka</b></label>
							<input style="font-family:LatoLight;" class="text_psw_input" type="password" placeholder="Unesi lozinku" name="psw" required>								
							<div class="span_area" style="margin-bottom:-20px;">
								<span class="psw"><a class="dropdown-meni" href="register.php">Nisi registriran? Pritisni ovdje</a></span>
								<br>
								<!-- <span class="psw"><a class="dropdown-meni" href="#">Zaboravljena lozinka?</a></span> -->
							</div>
						</div>																
						<div class="container" style="background-color:#f1f1f1; color: black; width:auto;border-bottom-left-radius:10px;border-bottom-right-radius:10px;">							
							<div>
							<button type="submit"
								name="login_btn"
								value="Login"
								class="btn btn-success"
								style="width: 140px; border-radius:20px;">Prijavi se</button>
								<button type="button"
										onclick="document.getElementById('login').style.display='none'"
										class="btn btn-danger"
										style="float:right;margin-left:10px; border-radius:20px; color:white; width:100px">Izađi</button>
							</div>
						</div>
					</form>
				</div>
									
				<script>
					// Get the modal
					var modal = document.getElementById('login');
								
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event)
					{
						if (event.target == modal)
						{
							modal.style.display = "none";
						}
					}
				</script>
			</div>		