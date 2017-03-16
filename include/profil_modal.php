
<div class="" style="float:right">                                                                     									
	<div id="profil" class="modal" style="z-index=1; color:black">													
	<div class="modal-content animate" style="border-radius:20px; background-color: f8f8f8; ">
		<div style="float:center; height:30%">
			<div style="float:left;width:38%;height:100%">
			<div id="slikaProf" style="margin: 8% 8% 8% 8%; width:80%; height:80%; background-size:cover; border-radius:999px; background-color:#ccc; 
						background-position: center center; background-image: url('images/profile/default-profile.jpg');border: solid 2px #888888;"></div>
			</div>
			<div style="font-family: Georgia, serif;color:#555555; margin: 10px 10px 10px 10px; float:right; width:58%;height:100%; font-size: 24px">
				<div class="search-option" style="position:relative; float:left;">						
				<div style="margin-left:10px;margin-right:-15px;margin-top:-6px;">
					<svg class="edit-pen-title">
						  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
					</svg>
				</div>
				</div>
				<div style="cursor:pointer;float:right; color:red; font-size: 19px; margin-top:-8px;" onclick='document.getElementById("profil").style.display = "none";'><b>X</b></div>
				<b><span style="color:red;font-style: italic" id="korisnickoime"></span></b>
				<hr style="margin-top:0">
				<table style="font-size:68%">
				<tr><td>Spol:</td><td id="spolProf"></td><tr>
				<tr><td>Korisnik od:</td><td id="JoinDProf"></td><tr>
				<tr><td>Zadnja prijava: </td><td id="LastLProf"></td><tr>
				<tr><td>Objavljeno recepata: </td><td id="BrRProf"></td><tr>
				</table>
				<?php ?>
			</div>
		</div>
	</div>
	</div>							
	<script>
		// Get the modal
		var modal = document.getElementById('profil');
				
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