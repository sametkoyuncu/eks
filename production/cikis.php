<?php 
	session_start();
	session_destroy();

	header("Location:hesap.php?durum=exit");
 ?>