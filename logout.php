<?php

	if (isset($_SESSION['user'])) {
		header("Location: index.php?logout=1");
	} else {
		header("Location: index.php?logout=1");
	}
	
?>