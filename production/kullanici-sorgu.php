<?php
	include '../baglan.php';

	if (isset($_POST['kullanici'])) {
		$kullanici_adi=$_POST['kullanici'];

		$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici");
		$kullanicisorgu->execute(array(
			'kullanici' => $kullanici_adi
	                ));
		$sayac=$kullanicisorgu->rowCount();
		echo $sayac;
	}

	if (isset($_POST['eposta'])) {
		$kullanici_eposta=$_POST['eposta'];

		$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_eposta=:eposta");
		$kullanicisorgu->execute(array(
			'eposta' => $kullanici_eposta
	                ));
		$sayac=$kullanicisorgu->rowCount();
		echo $sayac;
	}
?>