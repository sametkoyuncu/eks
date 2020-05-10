<?php 
	ob_start();
	session_start();
	include 'baglan.php'; 

	#
	# Giriş yap
	#

	if (isset($_POST['admingiris'])) {
		$kullanici_adi=$_POST['kullanici_adi'];
		$kullanici_sifre=md5($_POST['kullanici_sifre']);
		$kullanici_yetki= '1';

		if ($kullanici_adi && $kullanici_sifre) {
			$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici and kullanici_sifre=:sifre and kullanici_yetki=:yetki");
	      	$kullanicisorgu->execute(array(
	        'kullanici' => $kullanici_adi,
	        'sifre' => $kullanici_sifre,
	        'yetki' => $kullanici_yetki
	        ));

	        $say=$kullanicisorgu->rowCount();
	        echo $say;

	        if ($say>0) {
	        	$_SESSION['kullanici_adi']=$kullanici_adi;
	        	$_SESSION['kullanici_yetki']=$kullanici_yetki;
	        	header("Location:production/index.php");
	        } else {
	        	header("Location:production/hesap.php?durum=false");
	        }
		}
	}

	#
	# kullanıcı girişi Giriş yap
	#

	if (isset($_POST['kullanicigiris'])) {
		$kullanici_adi=$_POST['kullanici_adi'];
		$kullanici_sifre=md5($_POST['kullanici_sifre']);
		$kullanici_yetki= '2';

		if ($kullanici_adi && $kullanici_sifre) {
			$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici and kullanici_sifre=:sifre and kullanici_yetki=:yetki");
	      	$kullanicisorgu->execute(array(
	        'kullanici' => $kullanici_adi,
	        'sifre' => $kullanici_sifre,
	        'yetki' => $kullanici_yetki
	        ));

	        $say=$kullanicisorgu->rowCount();
	        echo $say;

	        if ($say>0) {
	        	$_SESSION['kullanici_adi']=$kullanici_adi;
	        	$_SESSION['kullanici_yetki']=$kullanici_yetki;
	        	header("Location:production/index.php");
	        } else {
	        	header("Location:production/hesap.php?durum=false");
	        }
		}
	}

####################################################################################
############					   profil ayarı							############
####################################################################################


	#
	#kullanici ayarı - kullanici güncelle
	#
	if (isset($_POST['profilguncelle'])) {


		if ($_FILES['kullanici_gorsel']["size"] > 0) {
			
			$yukleme_dizini = 'images/kullanici';
			@$tmp_name = $_FILES['kullanici_gorsel']["tmp_name"];
			@$name = $_FILES['kullanici_gorsel']["name"];
			$rastgelesayi1=rand(20000, 32000);
			$rastgelesayi2=rand(20000, 32000);
			$rastgelesayi3=rand(20000, 32000);
			$rastgelesayi4=rand(20000, 32000);
			$rastgelead=$rastgelesayi1.$rastgelesayi2.$rastgelesayi3.$rastgelesayi4;
			$refgorselyolu=substr($yukleme_dizini, 0)."/".$rastgelead.$name;
			@move_uploaded_file($tmp_name, "$yukleme_dizini/$rastgelead$name");

			$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
				kullanici_gorsel=:gorsel,
				kullanici_adi=:ad,
				kullanici_adsoyad=:adsoyad,
				kullanici_eposta=:eposta
				WHERE kullanici_id=:id");
			$guncelle=$kullaniciguncelle->execute(array(
				'gorsel' => $refgorselyolu,
				'ad' => $_POST['kullanici_adi'],
				'adsoyad' => $_POST['kullanici_adsoyad'],
				'eposta' => $_POST['kullanici_eposta'],
				'id' => $_POST['kullanici_id']
				));
			$kullanici_id=$_POST['kullanici_id'];
			if ($guncelle) {

				$gorselsil_adres=$_POST["kullanici_gorsel"];
				unlink("$gorselsil_adres");

				header("Location:production/profil-duzenle.php?durum=true&kullanici_id=$kullanici_id");
			} else {
				header("Location:production/profil-duzenle.php?durum=false&kullanici_id=$kullanici_id");
			}

		} else {

			$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
				kullanici_adi=:ad,
				kullanici_adsoyad=:adsoyad,
				kullanici_eposta=:eposta
				WHERE kullanici_id=:id");
			$guncelle=$kullaniciguncelle->execute(array(
				'ad' => $_POST['kullanici_adi'],
				'adsoyad' => $_POST['kullanici_adsoyad'],
				'eposta' => $_POST['kullanici_eposta'],
				'id' => $_POST['kullanici_id']
				));
			$kullanici_id=$_POST['kullanici_id'];
			if ($guncelle) {
				header("Location:production/profil-duzenle.php?durum=true&kullanici_id=$kullanici_id");
			} else {
				header("Location:production/profil-duzenle.php?durum=false&kullanici_id=$kullanici_id");
			}
		}	
	}

	#
	#şifre ayarı - şifre güncelle
	#

	if (isset($_POST['sifreguncelle'])) {
		$kullanici_eskisifre=md5($_POST['kullanici_eskisifre']);
		$kullanici_sifre=$_POST['kullanici_sifre'];
		$kullanici_sifretekrar=$_POST['kullanici_sifretekrar'];
		$kullanici_sifremd5=md5($_POST['kullanici_sifre']);
		$kullanici_id=$_POST['kullanici_id'];

		$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
	    $kullanicisorgu->execute(array(
	    'id' => $kullanici_id
	    ));
	    $kullanicicek=$kullanicisorgu->fetch(PDO::FETCH_ASSOC);

	    if ($kullanici_eskisifre == $kullanicicek['kullanici_sifre'] ) {
	        	
	        if ($kullanici_sifre == $kullanici_sifretekrar) {

	        	$sifreguncelle=$db->prepare("UPDATE kullanici SET
					kullanici_sifre=:sifre
					WHERE kullanici_id=:id");
				$guncelle=$sifreguncelle->execute(array(
					'sifre' => $kullanici_sifremd5,
					'id' => $kullanici_id
					));
				if ($guncelle) {
					header("Location:production/profil-duzenle.php?durum=true");
				} else {
					header("Location:production/sifre-degistir.php?durum=false");
				}
	        	
	        } else {
	        	header("Location:production/sifre-degistir.php?durum=false&hata_id=1");
	        }

	    } else { #şifre hatalı ise geri dön
	       	header("Location:production/sifre-degistir.php?durum=false&hata_id=2");
	    }
	}

	#
	#kullanici ayarı - nkullanici ekle
	#
	if (isset($_POST['kayit'])) {
		$tarih=date('Y-m-d')." ".date('H:i:s');
		$nedenekle=$db->prepare("INSERT INTO kullanici SET
			kullanici_adi=:ad,
			kullanici_eposta=:eposta,
			kullanici_sifre=:sifre,
			kullanici_kayittarihi=:tarih");
		$ekle=$nedenekle->execute(array(
			'ad' => $_POST['kullanici_adi2'],
			'eposta' => $_POST['kullanici_eposta2'],
			'sifre' => md5($_POST['kullanici_sifre']),
			'tarih' => $tarih
			));
		if ($ekle) {
			header("Location:production/hesap.php?kayit=true");
		} else {
			header("Location:production/hesap.php?kayit=false");
		}
	}

####################################################################################
############					   hayvan ayarı							############
####################################################################################
	#
	#hayvan ayarı - hayvan ekle
	#
	if (isset($_POST['hayvanekle'])) {

		$hayvanekle=$db->prepare("INSERT INTO hayvan SET
			kullanici_id=:id,
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			hayvan_alisfiyati=:alisfiyati,
			hayvan_alistarihi=:alistarihi,
			hayvan_dogumtarihi=:dogumtarihi,
			hayvan_durum=:durum");
		$ekle=$hayvanekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'alisfiyati' => $_POST['hayvan_alisfiyati'],
			'alistarihi' => $_POST['hayvan_alistarihi'],
			'dogumtarihi' => $_POST['hayvan_dogumtarihi'],
			'durum' => $_POST['hayvan_durum']
			));
		$hayvan_id=$db->lastInsertId();
		$muhasebe_aciklama=strtoupper($_POST['hayvan_kupeno'])." küpeli hayvan işlemleri.";

		$muhasebeekle=$db->prepare("INSERT INTO muhasebe SET
			kullanici_id=:id,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama");
		$ekle2=$muhasebeekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'gider' => $_POST['hayvan_alisfiyati'],
			'aciklama' => $muhasebe_aciklama
			));

		$tartimekle=$db->prepare("INSERT INTO tartim SET
			kullanici_id=:k_id,
			hayvan_id=:h_id,
			tartim_kilo=:kilo");
		$ekle3=$tartimekle->execute(array(
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $hayvan_id,
			'kilo' => $_POST['hayvan_kilo']
			));

		if ($ekle && $ekle2 && $ekle3) {
			header("Location:production/hayvanlar.php?durum=true");
		} else {
			header("Location:production/hayvanlar.php?durum=false");
		}
	}

	#
	#hayvan ayarı - hayvan güncelle
	#
	if (isset($_POST['hayvanguncelle'])) {

		$hayvanguncelle=$db->prepare("UPDATE hayvan SET
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			hayvan_alisfiyati=:alisfiyati,
			hayvan_satisfiyati=:satisfiyati,
			hayvan_durum=:durum
			WHERE hayvan_id=:id");
		$guncelle=$hayvanguncelle->execute(array(
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'alisfiyati' => $_POST['hayvan_alisfiyati'],
			'satisfiyati' => $_POST['hayvan_satisfiyati'],
			'durum' => $_POST['hayvan_durum'],
			'id' => $_POST['hayvan_id']
			));
		$hayvan_id=$_POST['hayvan_id'];


		$kupeno=strtoupper($_POST['hayvan_kupeno']);
		$muhasebe_aciklama=strtoupper($_POST['hayvan_kupeno'])." küpeli hayvan işlemleri.";

		$muhasebesorgu=$db->prepare("SELECT * FROM muhasebe WHERE muhasebe_aciklama LIKE '%$kupeno%'");
        $muhasebesorgu->execute();
        $muhasebecek=$muhasebesorgu->fetch(PDO::FETCH_ASSOC);

        $muhasebe_id=$muhasebecek['muhasebe_id'];

        $muhasebeguncelle=$db->prepare("UPDATE muhasebe SET
			muhasebe_gelir=:gelir,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama
			WHERE muhasebe_id=:id");
		$guncelle2=$muhasebeguncelle->execute(array(
			'gelir' => $_POST['hayvan_satisfiyati'],
			'gider' => $_POST['hayvan_alisfiyati'],
			'aciklama' => $muhasebe_aciklama,
			'id' => $muhasebe_id
			));


		if ($guncelle && $guncelle2) {
			header("Location:production/hayvan-duzenle.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/hayvan-duzenle.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#hayvan ayarı - hayvan sil
	#
	if(isset($_GET['hayvansil'])) {
		if ($_GET['hayvansil']=="true") {
			$hayvansil=$db->prepare("DELETE FROM hayvan WHERE hayvan_id=:id");
			$sil=$hayvansil->execute(array(
				'id' => $_GET['hayvan_id']
				));
			if ($sil) {

				header("Location:production/hayvanlar.php?durum=true");
			} else {
				header("Location:production/hayvanlar.php?durum=false");
			}
		}	
	}

####################################################################################
############					   buzağı dogum kaydı ayarı							############
####################################################################################
	#
	#buzagi ayarı - buzagi ekle
	#
	if (isset($_POST['buzagiekle'])) {

		$buzagiekle=$db->prepare("INSERT INTO hayvan SET
			kullanici_id=:id,
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			hayvan_dogumtarihi=:dogumtarihi,
			ana_id=:ana_id,
			buzagi_goster=:buzagi_goster");
		$ekle=$buzagiekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'dogumtarihi' => $_POST['hayvan_dogumtarihi'],
			'ana_id' => $_POST['ana_id'],
			'buzagi_goster' => $_POST['buzagi_goster']
			));
		$hayvan_id=$db->lastInsertId();
		#muhasebe silindi

		$tartimekle=$db->prepare("INSERT INTO tartim SET
			kullanici_id=:k_id,
			hayvan_id=:h_id,
			tartim_kilo=:kilo");
		$ekle3=$tartimekle->execute(array(
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $hayvan_id,
			'kilo' => $_POST['hayvan_kilo']
			));

		if ($ekle && $ekle3) {
			header("Location:production/buzagi-dogum.php?durum=true");
		} else {
			header("Location:production/buzagi-dogum.php?durum=false");
		}
	}

	#
	#buzagi ayarı - buzagi güncelle
	#
	if (isset($_POST['buzagiguncelle'])) {

		$buzagiguncelle=$db->prepare("UPDATE hayvan SET
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			ana_id=:ana_id
			WHERE hayvan_id=:id");
		$guncelle=$buzagiguncelle->execute(array(
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'ana_id' => $_POST['ana_id'],
			'id' => $_POST['hayvan_id']
			));
		$hayvan_id=$_POST['hayvan_id'];

/*
		$kupeno=strtoupper($_POST['hayvan_kupeno']);
		$muhasebe_aciklama=strtoupper($_POST['hayvan_kupeno'])." küpeli hayvan işlemleri.";

		$muhasebesorgu=$db->prepare("SELECT * FROM muhasebe WHERE muhasebe_aciklama LIKE '%$kupeno%'");
        $muhasebesorgu->execute();
        $muhasebecek=$muhasebesorgu->fetch(PDO::FETCH_ASSOC);

        $muhasebe_id=$muhasebecek['muhasebe_id'];

        $muhasebeguncelle=$db->prepare("UPDATE muhasebe SET
			muhasebe_gelir=:gelir,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama
			WHERE muhasebe_id=:id");
		$guncelle2=$muhasebeguncelle->execute(array(
			'gelir' => $_POST['hayvan_satisfiyati'],
			'gider' => $_POST['hayvan_alisfiyati'],
			'aciklama' => $muhasebe_aciklama,
			'id' => $muhasebe_id
			));

*/
		if ($guncelle) {
			header("Location:production/buzagi-dogum-duzenle.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/buzagi-dogum-duzenle.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#buzagi ayarı - buzagi sil
	#
	if(isset($_GET['buzagisil'])) {
		if ($_GET['buzagisil']=="true") {
			$buzagisil=$db->prepare("DELETE FROM hayvan WHERE hayvan_id=:id");
			$sil=$buzagisil->execute(array(
				'id' => $_GET['hayvan_id']
				));
			if ($sil) {

				header("Location:production/buzagi-dogum.php?durum=true");
			} else {
				header("Location:production/buzagi-dogum.php?durum=false");
			}
		}	
	}

####################################################################################
############					   inek tohum ayarı							############
####################################################################################
	#
	#inek tohum ayarı - inek tohum ekle
	#
	if (isset($_POST['inektohumekle'])) {

		$kayit_tarihi = strtotime($_POST['hayvan_tohumtarihi']);
		$dogum_tarihi_unix = 24451200+$kayit_tarihi;
		$dogum_tarihi = date('Y.m.d H:i:s', $dogum_tarihi_unix);

		$hayvanekle=$db->prepare("INSERT INTO inek_tohum SET
			kullanici_id=:k_id,
			hayvan_id=:h_id,
			inek_tohum_irk=:irk,
			hayvan_tohumtarihi=:tohumtarihi,
			hayvan_dogumtarihi=:dogumtarihi,
			inek_tohum_not=:aciklama");
		$ekle=$hayvanekle->execute(array(
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $_POST['hayvan_id'],
			'irk' => $_POST['inek_tohum_irk'],
			'tohumtarihi' => $_POST['hayvan_tohumtarihi'],
			'dogumtarihi' => $dogum_tarihi,
			'aciklama' => $_POST['inek_tohum_not']
			));
		$inek_tohum_id=$db->lastInsertId();
		$referans="inek_tohum_id_".$inek_tohum_id;

		$hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
		$hayvansorgu->execute(array(
			'id' => $_POST['kullanici_id'],
			'hayvan_id' => $_POST['hayvan_id']
			));
		$hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);
		$hayvan_adi=$hayvancek['hayvan_adi'];
	  
		$aciklama=$hayvan_adi." - Doğum (Hata payı 5 gün)";	

		

		$hatirlaticiekle=$db->prepare("INSERT INTO hatirlatici SET
			kullanici_id=:id,
			hatirlatici_referans=:referans,
			hatirlatici_aciklama=:aciklama,
			hatirlatici_tarih=:tarih");
		$ekle2=$hatirlaticiekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'referans' => $referans,
			'aciklama' => $aciklama,
			'tarih' => $dogum_tarihi
			));

		if ($ekle && $ekle2) {
			header("Location:production/inek-tohum.php?durum=true");
		} else {
			header("Location:production/inek-tohum.php?durum=false");
		}
	}

	#
	#inek tohum ayarı - inek tohum güncelle
	#
	if (isset($_POST['inektohumguncelle'])) {

		$inektohumguncelle=$db->prepare("UPDATE inek_tohum SET
			inek_tohum_irk=:irk,
			hayvan_tohumtarihi=:tohumtarihi,
			inek_tohum_not=:aciklama
			WHERE inek_tohum_id=:id");
		$guncelle=$inektohumguncelle->execute(array(
			'irk' => $_POST['inek_tohum_irk'],
			'tohumtarihi' => $_POST['hayvan_tohumtarihi'],
			'aciklama' => $_POST['inek_tohum_not'],
			'id' => $_POST['inek_tohum_id']
			));

		$inek_tohum_id=$_POST['inek_tohum_id'];
		$referans="inek_tohum_id_".$inek_tohum_id;

		$hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
		$hayvansorgu->execute(array(
			'id' => $_POST['kullanici_id'],
			'hayvan_id' => $_POST['hayvan_id']
			));
		$hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);
		$hayvan_adi=$hayvancek['hayvan_adi'];
	  
		$aciklama=$hayvan_adi." - Doğum (Hata payı 5 gün)";	

		$kayit_tarihi = strtotime($_POST['hayvan_tohumtarihi']);
		$dogum_tarihi_unix = 24624000+$kayit_tarihi;
		$dogum_tarihi = date('Y.m.d H:i:s', $dogum_tarihi_unix);

		$hatirlaticiguncelle=$db->prepare("UPDATE hatirlatici SET
			hatirlatici_aciklama=:aciklama,
			hatirlatici_tarih=:tarih
			WHERE hatirlatici_referans=:id");
		$guncelle2=$hatirlaticiguncelle->execute(array(
			'aciklama' => $aciklama,
			'tarih' => $dogum_tarihi,
			'id' => $referans
			));


		if ($guncelle && $guncelle2) {
			header("Location:production/inek-tohum-duzenle.php?durum=true&inek_tohum_id=$inek_tohum_id");
		} else {
			header("Location:production/inek-tohum-duzenle.php?durum=false&inek_tohum_id=$inek_tohum_id");
		}
	}

	#
	#inek tohum ayarı - inek tohum sil
	#
	if(isset($_GET['inektohumsil'])) {
		if ($_GET['inektohumsil']=="true") {
			$hayvansil=$db->prepare("DELETE FROM inek_tohum WHERE inek_tohum_id=:id");
			$sil=$hayvansil->execute(array(
				'id' => $_GET['inek_tohum_id']
				));
			
			$referans_sil="inek_tohum_id_".$_GET['inek_tohum_id'];

			$hatirlaticisil=$db->prepare("DELETE FROM hatirlatici WHERE hatirlatici_referans=:ref");
				$sil2=$hatirlaticisil->execute(array(
					'ref' => $referans_sil
					));
			if ($sil) {
				header("Location:production/inek-tohum.php?durum=true");
			} else {
				header("Location:production/inek-tohum.php?durum=false");
			}
		}	
	}	

####################################################################################
############					   kurbanlık ayarı						############
####################################################################################
	#
	#kurbanlık ayarı - kurbanlık ekle
	#
	if (isset($_POST['kurbanlikekle'])) {

		$hayvanekle=$db->prepare("INSERT INTO kurbanlik_hayvanlar SET
			kullanici_id=:id,
			hayvan_kupeno=:kupe_no,
			hayvan_adi=:adi,
			hayvan_kilo=:kilo,
			hayvan_satisfiyati=:satisfiyati,
			hayvan_durum=:durum,
			hayvan_hisse_adedi=:hisse_adedi,
			hayvan_alici=:alici,
			hayvan_alici_tel=:alici_tel");
		$ekle=$hayvanekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'kupe_no' => $_POST['hayvan_kupeno'],
			'adi' => $_POST['hayvan_adi'],
			'kilo' => $_POST['hayvan_kilo'],
			'satisfiyati' => $_POST['hayvan_satisfiyati'],
			'durum' => $_POST['hayvan_durum'],
			'hisse_adedi' => $_POST['hayvan_hisse_adedi'],
			'alici' => $_POST['hayvan_alici'],
			'alici_tel' => $_POST['hayvan_alici_tel']
			));
		$hayvan_id=$db->lastInsertId();
		$hisse_fiyati = $_POST['hayvan_satisfiyati']/$_POST['hayvan_hisse_adedi'];
		$x=0;
		while($x < $_POST['hayvan_hisse_adedi']) {
		    $hisseekle=$db->prepare("INSERT INTO hisse SET
				kullanici_id=:id,
				hayvan_id=:h_id,
				hisse_toplam=:toplam");
			$ekle=$hisseekle->execute(array(
				'id' => $_POST['kullanici_id'],
				'h_id' => $hayvan_id,
				'toplam' => $hisse_fiyati
				));
		    $x++;
		} 

		if ($ekle) {
			header("Location:production/kurban.php?durum=true");
		} else {
			header("Location:production/kurban.php?durum=false");
		}
	}

	#
	#kurbanlık ayarı - kurbanlık güncelle
	#
	if (isset($_POST['kurbanlikguncelle'])) {

		$hayvanguncelle=$db->prepare("UPDATE kurbanlik_hayvanlar SET
			hayvan_kupeno=:kupe_no,
			hayvan_adi=:adi,
			hayvan_kilo=:kilo,
			hayvan_satisfiyati=:satisfiyati,
			hayvan_durum=:durum,
			hayvan_hisse_adedi=:hisse_adedi,
			hayvan_alici=:alici,
			hayvan_alici_tel=:alici_tel
			WHERE hayvan_id=:id");
		$guncelle=$hayvanguncelle->execute(array(
			'kupe_no' => $_POST['hayvan_kupeno'],
			'adi' => $_POST['hayvan_adi'],
			'kilo' => $_POST['hayvan_kilo'],
			'satisfiyati' => $_POST['hayvan_satisfiyati'],
			'durum' => $_POST['hayvan_durum'],
			'hisse_adedi' => $_POST['hayvan_hisse_adedi'],
			'alici' => $_POST['hayvan_alici'],
			'alici_tel' => $_POST['hayvan_alici_tel'],
			'id' => $_POST['hayvan_id']
			));
		$hayvan_id=$_POST['hayvan_id'];
		if ($guncelle) {
			header("Location:production/kurbanlik-duzenle.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/kurbanlik-duzenle.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#kurbanlık ayarı - kurbanlık sil
	#
	if(isset($_GET['kurbanliksil'])) {
		if ($_GET['kurbanliksil']=="true") {
			// $hayvansil=$db->prepare("DELETE FROM kurbanlik_hayvanlar AND hisse WHERE hayvan_id=:id");
			//çoklu silme işlemi
			$hayvansil=$db->prepare("
				DELETE h, k FROM kurbanlik_hayvanlar AS k
				LEFT JOIN hisse AS h ON h.hayvan_id = k.hayvan_id
				WHERE k.hayvan_id=:id
				");
			$sil=$hayvansil->execute(array(
				'id' => $_GET['hayvan_id']
				));
			if ($sil) {

				header("Location:production/kurban.php?durum=true");
			} else {
				header("Location:production/kurban.php?durum=false");
			}
		}	
	}	

####################################################################################
############					   hissedar ayarı					    ############
####################################################################################

#
	#hissedar ayarı - hissedar güncelle
	#
	if (isset($_POST['hissedarguncelle'])) {

		$hissedarguncelle=$db->prepare("UPDATE hisse SET
			hisse_alici=:alici,
			hisse_alici_tel=:alici_tel,
			hisse_odenen=:odenen
			WHERE hisse_id=:id");
		$guncelle=$hissedarguncelle->execute(array(
			'alici' => $_POST['hisse_alici'],
			'alici_tel' => $_POST['hisse_alici_tel'],
			'odenen' => $_POST['hisse_odenen'],
			'id' => $_POST['hisse_id']
			));
		$hisse_id=$_POST['hisse_id'];
		if ($guncelle) {
			header("Location:eks/production/hissedar-duzenle.php?durum=true&hisse_id=$hisse_id");
		} else {
			header("Location:eks/production/hissedar-duzenle.php?durum=false&hisse_id=$hisse_id");
		}
	}

####################################################################################
############					    yemkayit ayarı						############
####################################################################################
	#
	#yemkayit ayarı - yemkayit ekle
	#
	if (isset($_POST['yemkayitekle'])) {
		$yemsorgu=$db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yem_id=:yem_id");
      	$yemsorgu->execute(array(
        'id' => $_POST['kullanici_id'],
        'yem_id' => $_POST['yemkayit_adi']
        ));
        $yemcek=$yemsorgu->fetch(PDO::FETCH_ASSOC);

        $birim=$yemcek['yem_birimi'];

        $miktar=$yemcek['yem_miktari'];
		$miktar=$miktar+$_POST['yemkayit_miktari'];

		$yemkayitekle=$db->prepare("INSERT INTO yemkayit SET
			kullanici_id=:id,
			yemkayit_adi=:adi,
			yemkayit_birimi=:birimi,
			yemkayit_miktari=:miktari,
			yemkayit_birimfiyati=:birimfiyati,
			yemkayit_alistarihi=:alistarihi,
			yemkayit_aciklama=:aciklama
			");
		$ekle=$yemkayitekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'adi' => $_POST['yemkayit_adi'],
			'birimi' => $birim,
			'miktari' => $_POST['yemkayit_miktari'],
			'birimfiyati' => $_POST['yemkayit_birimfiyati'],
			'alistarihi' => $_POST['yemkayit_alistarihi'],
			'aciklama' => $_POST['yemkayit_aciklama']
			));
		#yem miktarını depoya (yem tablosuna) ekleme
		$yemguncelle=$db->prepare("UPDATE yem SET
			yem_miktari=:miktar
			WHERE yem_id=:yem_id
			and kullanici_id=:id");
		$guncelle=$yemguncelle->execute(array(
			'miktar' => $miktar,
			'yem_id' => $_POST['yemkayit_adi'],
			'id' => $_POST['kullanici_id']
			));

		#muhasebeye kayıt ekleme
		$muhasebe_aciklama=$yemcek['yem_adi']." alımı.";

		$muhasebeekle=$db->prepare("INSERT INTO muhasebe SET
			kullanici_id=:id,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama");
		$ekle2=$muhasebeekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'gider' => $_POST['yemkayit_miktari']*$_POST['yemkayit_birimfiyati'],
			'aciklama' => $muhasebe_aciklama
			));

		if ($ekle && $guncelle) {
			header("Location:production/yem.php?durum=true");
		} else {
			header("Location:production/yem.php?durum=false");
		}
	}

	#
	#yemkayit ayarı - yemkayit güncelle
	#
	if (isset($_POST['yemkayitguncelle'])) {

		$yemkayitguncelle=$db->prepare("UPDATE yemkayit SET
			yemkayit_kupeno=:kupeno,
			yemkayit_adi=:adi,
			yemkayit_irk=:irk,
			yemkayit_cinsiyet=:cinsiyet,
			yemkayit_alisfiyati=:alisfiyati,
			yemkayit_satisfiyati=:satisfiyati,
			yemkayit_kilo=:kilo,
			yemkayit_durum=:durum
			WHERE yemkayit_id=:id");
		$guncelle=$yemkayitguncelle->execute(array(
			'kupeno' => strtoupper($_POST['yemkayit_kupeno']),
			'adi' => $_POST['yemkayit_adi'],
			'irk' => $_POST['yemkayit_irk'],
			'cinsiyet' => $_POST['yemkayit_cinsiyet'],
			'alisfiyati' => $_POST['hayvan_alisfiyati'],
			'satisfiyati' => $_POST['yemkayit_satisfiyati'],
			'kilo' => $_POST['yemkayit_kilo'],
			'durum' => $_POST['yemkayit_durum'],
			'id' => $_POST['yemkayit_id']
			));
		$yemkayit_id=$_POST['yemkayit_id'];
		if ($guncelle) {
			header("Location:production/yemkayit-duzenle.php?durum=true&yemkayit_id=$yemkayit_id");
		} else {
			header("Location:production/yemkayit-duzenle.php?durum=false&yemkayit_id=$yemkayit_id");
		}
	}

	#
	#yemkayit ayarı - yemkayit sil
	#
	if(isset($_GET['yemkayitsil'])) {
		if ($_GET['yemkayitsil']=="true") {
			$yemkayitsil=$db->prepare("DELETE FROM yemkayit WHERE yemkayit_id=:id");
			$sil=$yemkayitsil->execute(array(
				'id' => $_GET['yemkayit_id']
				));
			if ($sil) {

				header("Location:production/yem.php?durum=true");
			} else {
				header("Location:production/yem.php?durum=false");
			}
		}	
	}

####################################################################################
############					   yem ayarı							############
####################################################################################
	#
	#yem ayarı - yem ekle
	#
	if (isset($_POST['yemekle'])) {

		$hayvanekle=$db->prepare("INSERT INTO yem SET
			kullanici_id=:id,
			yem_adi=:adi,
			yem_birimi=:birimi");
		$ekle=$hayvanekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'adi' => $_POST['yem_adi'],
			'birimi' => $_POST['yem_birimi'],
			));
		if ($ekle) {
			header("Location:production/yemler.php?durum=true");
		} else {
			header("Location:production/yemler.php?durum=false");
		}
	}

	#
	#hayvan ayarı - hayvan güncelle
	#
	if (isset($_POST['yemguncelle'])) {

		$hayvanguncelle=$db->prepare("UPDATE hayvan SET
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			hayvan_alisfiyati=:alisfiyati,
			hayvan_satisfiyati=:satisfiyati,
			hayvan_kilo=:kilo,
			hayvan_durum=:durum
			WHERE hayvan_id=:id");
		$guncelle=$hayvanguncelle->execute(array(
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'alisfiyati' => $_POST['hayvan_alisfiyati'],
			'satisfiyati' => $_POST['hayvan_satisfiyati'],
			'kilo' => $_POST['hayvan_kilo'],
			'durum' => $_POST['hayvan_durum'],
			'id' => $_POST['hayvan_id']
			));
		$hayvan_id=$_POST['hayvan_id'];
		if ($guncelle) {
			header("Location:production/hayvan-duzenle.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/hayvan-duzenle.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#hayvan ayarı - hayvan sil
	#
	if(isset($_GET['yemsil'])) {
		if ($_GET['yemsil']=="true") {
			$hayvansil=$db->prepare("DELETE FROM yem WHERE yem_id=:id");
			$sil=$hayvansil->execute(array(
				'id' => $_GET['yem_id']
				));
			if ($sil) {

				header("Location:production/yemler.php?durum=true");
			} else {
				header("Location:production/yemler.php?durum=false");
			}
		}	
	}

####################################################################################
############					   birim ayarı							############
####################################################################################
	#
	#birim ayarı - birim ekle
	#
	if (isset($_POST['birimekle'])) {

		$birimkle=$db->prepare("INSERT INTO birim SET
			birim_adi=:adi,
			birim_aciklama=:aciklama");
		$ekle=$birimekle->execute(array(
			'adi' => $_POST['birim_adi'],
			'aciklama' => $_POST['birim_aciklama'],
			));
		if ($ekle) {
			header("Location:production/birimler.php?durum=true");
		} else {
			header("Location:production/birimler.php?durum=false");
		}
	}

	#
	#birim ayarı - birim güncelle
	#
	if (isset($_POST['birimguncelle'])) {

		$hayvanguncelle=$db->prepare("UPDATE hayvan SET
			hayvan_kupeno=:kupeno,
			hayvan_adi=:adi,
			hayvan_irk=:irk,
			hayvan_cinsiyet=:cinsiyet,
			hayvan_alisfiyati=:alisfiyati,
			hayvan_satisfiyati=:satisfiyati,
			hayvan_kilo=:kilo,
			hayvan_durum=:durum
			WHERE hayvan_id=:id");
		$guncelle=$hayvanguncelle->execute(array(
			'kupeno' => strtoupper($_POST['hayvan_kupeno']),
			'adi' => $_POST['hayvan_adi'],
			'irk' => $_POST['hayvan_irk'],
			'cinsiyet' => $_POST['hayvan_cinsiyet'],
			'alisfiyati' => $_POST['hayvan_alisfiyati'],
			'satisfiyati' => $_POST['hayvan_satisfiyati'],
			'kilo' => $_POST['hayvan_kilo'],
			'durum' => $_POST['hayvan_durum'],
			'id' => $_POST['hayvan_id']
			));
		$hayvan_id=$_POST['hayvan_id'];
		if ($guncelle) {
			header("Location:production/hayvan-duzenle.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/hayvan-duzenle.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#birim ayarı - birim sil
	#
	if(isset($_GET['birimsil'])) {
		if ($_GET['birimsil']=="true") {
			$hayvansil=$db->prepare("DELETE FROM birim WHERE birim_id=:id");
			$sil=$hayvansil->execute(array(
				'id' => $_GET['birim_id']
				));
			if ($sil) {

				header("Location:production/birimler.php?durum=true");
			} else {
				header("Location:production/birimler.php?durum=false");
			}
		}	
	}

####################################################################################
############					   tartim ayarı							############
####################################################################################
	#
	#tartim ayarı - tartim ekle
	#
	if (isset($_POST['tartimekle'])) {

		$tartimekle=$db->prepare("INSERT INTO tartim SET
			kullanici_id=:k_id,
			hayvan_id=:h_id,
			tartim_kilo=:kilo,
			tartim_aciklama=:aciklama");
		$ekle=$tartimekle->execute(array(
			'kilo' => $_POST['tartim_kilo'],
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $_POST['hayvan_id'],
			'aciklama' => $_POST['tartim_aciklama']
			));
		$hayvan_id=$_POST['hayvan_id'];
		if ($ekle) {
			header("Location:production/hayvan-profil.php?durum=true&hayvan_id=$hayvan_id");
		} else {
			header("Location:production/hayvan-profil.php?durum=false&hayvan_id=$hayvan_id");
		}
	}

	#
	#tartim ayarı - tartim sil
	#
	if(isset($_GET['tartimsil'])) {
		if ($_GET['tartimsil']=="true") {
			$tartimsil=$db->prepare("DELETE FROM tartim WHERE tartim_id=:id");
			$sil=$tartimsil->execute(array(
				'id' => $_GET['tartim_id']
				));
			$hayvan_id=$_GET['hayvan_id'];
			if ($sil) {

				header("Location:production/hayvan-profil.php?durum=true&hayvan_id=$hayvan_id");
			} else {
				header("Location:production/hayvan-profil.php?durum=false&hayvan_id=$hayvan_id");
			}
		}	
	}

####################################################################################
############					   not  ayarı							############
####################################################################################
	#
	#not ayarı - not ekle
	#
	if (isset($_POST['notekle'])) {

		$notekle=$db->prepare("INSERT INTO notlar SET
			kullanici_id=:id,
			not_baslik=:baslik,
			not_aciklama=:aciklama");
		$ekle=$notekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'baslik' => $_POST['not_baslik'],
			'aciklama' => $_POST['not_aciklama']
			));

		if ($ekle) {
			header("Location:production/notlar.php?durum=true");
		} else {
			header("Location:production/notlar.php?durum=false");
		}
	}

	#
	#not ayarı - not güncelle
	#
	if (isset($_POST['notguncelle'])) {

		$notguncelle=$db->prepare("UPDATE notlar SET
			not_baslik = :baslik,
			not_aciklama = :aciklama
			WHERE not_id=:id");
		$guncelle=$notguncelle->execute(array(
			'baslik' => $_POST['not_baslik'],
			'aciklama' => $_POST['not_aciklama'],
			'id' => $_POST['notid']
			));
		$notid=$_POST['notid'];


		if ($guncelle) {
			header("Location:production/not-duzenle.php?durum=true&notid=$notid");
		} else {
			header("Location:production/not-duzenle.php?durum=false&notid=$notid");
		}
	}

	#
	#not ayarı - not sil
	#
	if(isset($_GET['notsil'])) {
		if ($_GET['notsil']=="true") {
			$notsil=$db->prepare("DELETE FROM notlar WHERE not_id=:id");
			$sil=$notsil->execute(array(
				'id' => $_GET['notid']
				));
			if ($sil) {
				header("Location:production/notlar.php?durum=true");
			} else {
				header("Location:production/notlar.php?durum=false");
			}
		}	
	}

	####################################################################################
	############					   yapılacaklar  ayarı					############
	####################################################################################
	#
	#yapılacaklar ayarı - yapılacaklar ekle
	#
	if (isset($_POST['isekle'])) {

		$isekle=$db->prepare("INSERT INTO isler SET
			kullanici_id=:id,
			isler_tarih=:tarih,
			isler_aciklama=:aciklama");
		$ekle=$isekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'tarih' => $_POST['isler_tarih'],
			'aciklama' => $_POST['isler_aciklama']
			));

		$isler_id=$db->lastInsertId();
		$referans="isler_id_".$isler_id;

		$hatirlaticiekle=$db->prepare("INSERT INTO hatirlatici SET
			kullanici_id=:id,
			hatirlatici_referans=:referans,
			hatirlatici_aciklama=:aciklama,
			hatirlatici_tarih=:tarih");
		$ekle2=$hatirlaticiekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'referans' => $referans,
			'aciklama' => $_POST['isler_aciklama'],
			'tarih' => $_POST['isler_tarih']
			));

		if ($ekle && $ekle2) {
			header("Location:production/yapilacaklar.php?durum=true");
		} else {
			header("Location:production/yapilacaklar.php?durum=false");
		}

	}

	#
	#yapılacaklar ayarı - yapılacaklar güncelle
	#
	if (isset($_POST['istamamla'])) {

		$istamamla=$db->prepare("UPDATE isler SET
			isler_durum = :durum
			WHERE isler_id=:id");
		$guncelle=$istamamla->execute(array(
			'durum' => $_POST['isler_durum'],
			'id' => $_POST['isler_id']
			));

		$referans_sil="isler_id_".$_POST['isler_id'];

		$hatirlaticisil=$db->prepare("DELETE FROM hatirlatici WHERE hatirlatici_referans=:ref");
			$sil=$hatirlaticisil->execute(array(
				'ref' => $referans_sil
				));

		if ($guncelle && $sil) {
			header("Location:production/yapilacaklar.php?durum=true");
		} else {
			header("Location:production/not-duzenle.php?durum=false");
		}
	}

	#
	#yapılacaklar ayarı - yapılacaklar sil
	#
	if(isset($_GET['issil'])) {
		if ($_GET['issil']=="true") {
			$issil=$db->prepare("DELETE FROM isler WHERE isler_id=:id");
			$sil=$issil->execute(array(
				'id' => $_GET['isler_id']
				));
			
			$referans_sil="isler_id_".$_GET['isler_id'];

			$hatirlaticisil=$db->prepare("DELETE FROM hatirlatici WHERE hatirlatici_referans=:ref");
			$sil2=$hatirlaticisil->execute(array(
				'ref' => $referans_sil
				));

			if ($sil && $sil2) {
				header("Location:production/yapilacaklar.php?durum=true");
			} else {
				header("Location:production/yapilacaklar.php?durum=false");
			}
		}	
	}
###  ###   #########   ###   ###   ###   ###   ###     ###
### ###    ###   ###   ###   ###   ###   ###   #####   ###
######     ###   ###   #########   ###   ###   ### ### ###
### ###    ###   ###         ###   #### ####   ###   #####
###  ###   #########   #########   #########   ###     ###

####################################################################################
############					   koyun ayarı							############
####################################################################################
	#
	#koyun ayarı - koyun ekle
	#
	if (isset($_POST['koyunekle'])) {

		$koyunekle=$db->prepare("INSERT INTO koyun SET
			kullanici_id=:id,
			koyun_kupeno=:kupeno,
			koyun_kupeno_isletme=:kupeno_isletme,
			koyun_adi=:adi,
			koyun_irk=:irk,
			koyun_cinsiyet=:cinsiyet,
			koyun_alisfiyati=:alisfiyati,
			koyun_alistarihi=:alistarihi,
			koyun_dogumtarihi=:dogumtarihi,
			koyun_durum=:durum,
			ana_id=:ana,
			baba_id=:baba,
			koyun_nitelik=:nitelik,
			koyun_padok=:padok,
			koyun_kardesdurumu=:kardesdurumu,
			koyun_not=:nott");
		$ekle=$koyunekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'kupeno' => strtoupper($_POST['koyun_kupeno']),
			'kupeno_isletme' => strtoupper($_POST['koyun_kupeno_isletme']),
			'adi' => $_POST['koyun_adi'],
			'irk' => $_POST['koyun_irk'],
			'cinsiyet' => $_POST['koyun_cinsiyet'],
			'alisfiyati' => $_POST['koyun_alisfiyati'],
			'alistarihi' => $_POST['koyun_alistarihi'],
			'dogumtarihi' => $_POST['koyun_dogumtarihi'],
			'durum' => $_POST['koyun_durum'],
			'ana' => $_POST['ana_id'],
			'baba' => $_POST['baba_id'],
			'nitelik' => $_POST['koyun_nitelik'],
			'padok' => $_POST['koyun_padok'],
			'kardesdurumu' => $_POST['koyun_kardesdurumu'],
			'nott' => $_POST['koyun_not']
			));
		$koyun_id=$db->lastInsertId();
		$muhasebe_aciklama=strtoupper($_POST['koyun_kupeno_isletme'])." işletme küpeli koyun işlemleri.";

		$muhasebeekle=$db->prepare("INSERT INTO muhasebe SET
			kullanici_id=:id,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama");
		$ekle2=$muhasebeekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'gider' => $_POST['koyun_alisfiyati'],
			'aciklama' => $muhasebe_aciklama
			));

		$tartimekle=$db->prepare("INSERT INTO tartim SET
			kullanici_id=:k_id,
			hayvan_id=:h_id,
			tartim_kilo=:kilo");
		$ekle3=$tartimekle->execute(array(
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $koyun_id,
			'kilo' => $_POST['koyun_kilo']
			));

		if ($ekle && $ekle2 && $ekle3) {
			header("Location:production/koyunlar.php?durum=true");
		} else {
			header("Location:production/koyunlar.php?durum=false");
		}
	}

	#
	#koyun ayarı - koyun güncelle
	#
	if (isset($_POST['koyunguncelle'])) {

		$koyunguncelle=$db->prepare("UPDATE koyun SET
			koyun_kupeno=:kupeno,
			koyun_adi=:adi,
			koyun_irk=:irk,
			koyun_cinsiyet=:cinsiyet,
			koyun_alisfiyati=:alisfiyati,
			koyun_satisfiyati=:satisfiyati,
			koyun_grup_id=:grup,
			koyun_durum=:durum,
			koyun_nitelik=:nitelik,
			ana_id=:ana,
			baba_id=:baba,
			koyun_not=:nott
			WHERE koyun_id=:id");
		$guncelle=$koyunguncelle->execute(array(
			'kupeno' => strtoupper($_POST['koyun_kupeno']),
			'adi' => $_POST['koyun_adi'],
			'irk' => $_POST['koyun_irk'],
			'cinsiyet' => $_POST['koyun_cinsiyet'],
			'alisfiyati' => $_POST['koyun_alisfiyati'],
			'satisfiyati' => $_POST['koyun_satisfiyati'],
			'grup' => $_POST['koyun_grup_id'],
			'durum' => $_POST['koyun_durum'],
			'nitelik' => $_POST['koyun_nitelik'],
			'ana' => $_POST['ana_id'],
			'baba' => $_POST['baba_id'],
			'nott' => $_POST['koyun_not'],
			'id' => $_POST['koyun_id']
			));
		$koyun_id=$_POST['koyun_id'];


		$kupeno=strtoupper($_POST['koyun_kupeno']);
		$muhasebe_aciklama=strtoupper($_POST['koyun_kupeno'])." küpeli koyun işlemleri.";

		$muhasebesorgu=$db->prepare("SELECT * FROM muhasebe WHERE muhasebe_aciklama LIKE '%$kupeno%'");
        $muhasebesorgu->execute();
        $muhasebecek=$muhasebesorgu->fetch(PDO::FETCH_ASSOC);

        $muhasebe_id=$muhasebecek['muhasebe_id'];

        $muhasebeguncelle=$db->prepare("UPDATE muhasebe SET
			muhasebe_gelir=:gelir,
			muhasebe_gider=:gider,
			muhasebe_aciklama=:aciklama
			WHERE muhasebe_id=:id");
		$guncelle2=$muhasebeguncelle->execute(array(
			'gelir' => $_POST['koyun_satisfiyati'],
			'gider' => $_POST['koyun_alisfiyati'],
			'aciklama' => $muhasebe_aciklama,
			'id' => $muhasebe_id
			));


		if ($guncelle && $guncelle2) {
			header("Location:production/koyun-duzenle.php?durum=true&koyun_id=$koyun_id");
		} else {
			header("Location:production/koyun-duzenle.php?durum=false&koyun_id=$koyun_id");
		}
	}

	#
	#koyun ayarı - koyun sil
	#
	if(isset($_GET['koyunsil'])) {
		if ($_GET['koyunsil']=="true") {
			$koyunsil=$db->prepare("DELETE FROM koyun WHERE koyun_id=:id");
			$sil=$koyunsil->execute(array(
				'id' => $_GET['koyun_id']
				));
			if ($sil) {

				header("Location:production/koyunlar.php?durum=true");
			} else {
				header("Location:production/koyunlar.php?durum=false");
			}
		}	
	}

####################################################################################
############					   koyun tohum ayarı					############
####################################################################################
	#
	#koyun tohum ayarı - koyun tohum ekle
	#
	if (isset($_POST['koyuntohumekle'])) {

		$kayit_tarihi = strtotime($_POST['koyun_tohumtarihi']);
		$dogum_tarihi_unix = 12960000+$kayit_tarihi;
		$dogum_tarihi = date('Y.m.d H:i:s', $dogum_tarihi_unix);

		$koyuntohumekle=$db->prepare("INSERT INTO koyun_tohum SET
			kullanici_id=:k_id,
			koyun_id=:h_id,
			koyun_asim_koc=:koc,
			koyun_tohumtarihi=:tohumtarihi,
			koyun_dogumtarihi=:dogumtarihi,
			koyun_tohum_not=:aciklama");
		$ekle=$koyuntohumekle->execute(array(
			'k_id' => $_POST['kullanici_id'],
			'h_id' => $_POST['koyun_id'],
			'koc' => $_POST['koyun_asim_koc'],
			'tohumtarihi' => $_POST['koyun_tohumtarihi'],
			'dogumtarihi' => $dogum_tarihi,
			'aciklama' => $_POST['koyun_tohum_not']
			));
		$koyun_tohum_id=$db->lastInsertId();
		$referans="koyun_tohum_id_".$koyun_tohum_id;

		$koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
		$koyunsorgu->execute(array(
			'id' => $_POST['kullanici_id'],
			'koyun_id' => $_POST['koyun_id']
			));
		$koyuncek=$koyunsorgu->fetch(PDO::FETCH_ASSOC);
		$koyun_adi=$koyuncek['koyun_adi'];
	  
		$aciklama=$koyun_adi." - Doğum (Hata payı 5 gün)";	

		$kayit_tarihi = strtotime($_POST['koyun_tohumtarihi']);
		$dogum_tarihi_unix = 12960000+$kayit_tarihi;
		#12960000
		$dogum_tarihi = date('Y.m.d H:i:s', $dogum_tarihi_unix);

		$hatirlaticiekle=$db->prepare("INSERT INTO hatirlatici SET
			kullanici_id=:id,
			hatirlatici_referans=:referans,
			hatirlatici_aciklama=:aciklama,
			hatirlatici_tarih=:tarih");
		$ekle2=$hatirlaticiekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'referans' => $referans,
			'aciklama' => $aciklama,
			'tarih' => $dogum_tarihi
			));

		if ($ekle && $ekle2) {
			header("Location:production/koyun-tohum.php?durum=true");
		} else {
			header("Location:production/koyun-tohum.php?durum=false");
		}
	}

	#
	#koyu tohum ayarı - koyun tohum güncelle
	#
	#
	# EKSİK 
	#
	if (isset($_POST['koyuntohumguncelle'])) {

		$koyuntohumguncelle=$db->prepare("UPDATE koyun_tohum SET
			koyun_asim_koc=:koc,
			koyun_tohumtarihi=:tohumtarihi,
			koyun_tohum_not=:aciklama
			WHERE koyun_tohum_id=:id");
		$guncelle=$koyuntohumguncelle->execute(array(
			'koc' => $_POST['koyun_asim_koc'],
			'tohumtarihi' => $_POST['koyun_tohumtarihi'],
			'aciklama' => $_POST['koyun_tohum_not'],
			'id' => $_POST['koyun_tohum_id']
			));

		$inek_tohum_id=$_POST['inek_tohum_id'];
		$referans="inek_tohum_id_".$inek_tohum_id;

		$hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
		$hayvansorgu->execute(array(
			'id' => $_POST['kullanici_id'],
			'hayvan_id' => $_POST['hayvan_id']
			));
		$hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);
		$hayvan_adi=$hayvancek['hayvan_adi'];
	  
		$aciklama=$hayvan_adi." - Doğum (Hata payı 5 gün)";	

		$kayit_tarihi = strtotime($_POST['hayvan_tohumtarihi']);
		$dogum_tarihi_unix = 24624000+$kayit_tarihi;
		$dogum_tarihi = date('Y.m.d H:i:s', $dogum_tarihi_unix);

		$hatirlaticiguncelle=$db->prepare("UPDATE hatirlatici SET
			hatirlatici_aciklama=:aciklama,
			hatirlatici_tarih=:tarih
			WHERE hatirlatici_referans=:id");
		$guncelle2=$hatirlaticiguncelle->execute(array(
			'aciklama' => $aciklama,
			'tarih' => $dogum_tarihi,
			'id' => $referans
			));


		if ($guncelle && $guncelle2) {
			header("Location:production/inek-tohum-duzenle.php?durum=true&inek_tohum_id=$inek_tohum_id");
		} else {
			header("Location:production/inek-tohum-duzenle.php?durum=false&inek_tohum_id=$inek_tohum_id");
		}
	}

	#
	#koyun tohum ayarı - koyun tohum sil
	#
	if(isset($_GET['koyuntohumsil'])) {
		if ($_GET['koyuntohumsil']=="true") {
			$koyuntohumsil=$db->prepare("DELETE FROM koyun_tohum WHERE koyun_tohum_id=:id");
			$sil=$koyuntohumsil->execute(array(
				'id' => $_GET['koyun_tohum_id']
				));
			
			$referans_sil="koyun_tohum_id_".$_GET['koyun_tohum_id_'];

			$hatirlaticisil=$db->prepare("DELETE FROM hatirlatici WHERE hatirlatici_referans=:ref");
				$sil2=$hatirlaticisil->execute(array(
					'ref' => $referans_sil
					));
			if ($sil) {

				header("Location:production/koyun-tohum.php?durum=true");
			} else {
				header("Location:production/koyun-tohum.php?durum=false");
			}
		}	
	}	


####################################################################################
############					   koyun grup ayarı						############
####################################################################################
	#
	#koyun grup ayarı - koyun grup ekle
	#
	if (isset($_POST['koyungrupekle'])) {

		$koyungrupekle=$db->prepare("INSERT INTO koyun_grup SET
			kullanici_id=:id,
			koyun_grup_adi=:grup_adi,
			koyun_grup_padokid=:padok_id,
			koyun_grup_not=:nott");
		$ekle=$koyungrupekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'grup_adi' => $_POST['koyun_grup_adi'],
			'padok_id' => $_POST['koyun_padok_id'],
			'nott' => $_POST['koyun_grup_not']
			));
	

		if ($ekle) {
			header("Location:production/koyun-gruplari.php?durum=true");
		} else {
			header("Location:production/koyun-gruplari.php?durum=false");
		}
	}

	#
	#koyun grup ayarı - koyun grup güncelle
	#
	if (isset($_POST['koyungrupguncelle'])) {
		$koyun_grup_id = $_POST['koyun_grup_id'];
		$koyungrupguncelle=$db->prepare("UPDATE koyun_grup SET
			koyun_grup_adi=:grup_adi,
			koyun_grup_padokid=:padok_id,
			koyun_grup_not=:nott
			WHERE koyun_grup_id=:id");
		$guncelle=$koyungrupguncelle->execute(array(
			'grup_adi' => $_POST['koyun_grup_adi'],
			'padok_id' => $_POST['koyun_padok_id'],
			'nott' => $_POST['koyun_grup_not'],
			'id' => $koyun_grup_id
			));

		if ($guncelle) {
			header("Location:production/koyun-grup-duzenle.php?durum=true&koyun_grup_id=$koyun_grup_id");
		} else {
			header("Location:production/koyun-grup-duzenle.php?durum=false&koyun_grup_id=$koyun_grup_id");
		}
	}

	#
	#koyun grup ayarı - koyun grup sil
	#
	if(isset($_GET['koyungrupsil'])) {
		if ($_GET['koyungrupsil']=="true") {
			$koyungrupsil=$db->prepare("DELETE FROM koyun_grup WHERE koyun_grup_id=:id");
			$sil=$koyungrupsil->execute(array(
				'id' => $_GET['koyun_grup_id']
				));
			if ($sil) {
				header("Location:production/koyun-gruplari.php?durum=true");
			} else {
				header("Location:production/koyun-gruplari.php?durum=false");
			}
		}	
	}
####################################################################################
############					   koyun padok ayarı					############
####################################################################################
	#
	#koyun padok ayarı - koyun padok ekle
	#
	if (isset($_POST['koyunpadokekle'])) {

		$koyunpadokekle=$db->prepare("INSERT INTO koyun_padok SET
			kullanici_id=:id,
			koyun_padok_adi=:padok_adi,
			koyun_padok_not=:nott");
		$ekle=$koyunpadokekle->execute(array(
			'id' => $_POST['kullanici_id'],
			'padok_adi' => $_POST['koyun_padok_adi'],
			'nott' => $_POST['koyun_padok_not']
			));
	

		if ($ekle) {
			header("Location:production/koyun-padoklari.php?durum=true");
		} else {
			header("Location:production/koyun-padoklari.php?durum=false");
		}
	}

	#
	#koyun padok ayarı - koyun padok güncelle
	#
	if (isset($_POST['koyunpadokguncelle'])) {
		$koyun_padok_id = $_POST['koyun_padok_id'];
		$koyunpadokguncelle=$db->prepare("UPDATE koyun_padok SET
			koyun_padok_adi=:padok_adi,
			koyun_padok_not=:nott
			WHERE koyun_padok_id=:id");
		$guncelle=$koyunpadokguncelle->execute(array(
			'padok_adi' => $_POST['koyun_padok_adi'],
			'nott' => $_POST['koyun_padok_not'],
			'id' => $koyun_padok_id
			));

		if ($guncelle) {
			header("Location:production/koyun-padok-duzenle.php?durum=true&koyun_padok_id=$koyun_padok_id");
		} else {
			header("Location:production/koyun-padok-duzenle.php?durum=false&koyun_padok_id=$koyun_padok_id");
		}
	}

	#
	#koyun padok ayarı - koyun padok sil
	#
	if(isset($_GET['koyunpadoksil'])) {
		if ($_GET['koyunpadoksil']=="true") {
			$koyunpadoksil=$db->prepare("DELETE FROM koyun_padok WHERE koyun_padok_id=:id");
			$sil=$koyunpadoksil->execute(array(
				'id' => $_GET['koyun_padok_id']
				));
			if ($sil) {
				header("Location:production/koyun-padoklari.php?durum=true");
			} else {
				header("Location:production/koyun-padoklari.php?durum=false");
			}
		}	
	}

####################################################################################
############					   koyun ayarı							############
####################################################################################
	#
	#koyun ayarı - toplu koyun ekle
	#
	if (isset($_POST['toplukoyunekle'])) {
		$resmi_kupe = $_POST["koyun_kupeno"];
		$isletme_kupe = $_POST["koyun_kupeno_isletme"];
		$adi = $_POST["koyun_adi"];
		$cinsiyet = $_POST["koyun_cinsiyet"];
		$nott = $_POST["koyun_bott"];
		foreach( $resmi_kupe as $key => $resmiKupe ){
			$koyunekle=$db->prepare("INSERT INTO koyun SET
				kullanici_id=:id,
				koyun_kupeno=:kupeno,
				koyun_kupeno_isletme=:kupeno_isletme,
				koyun_adi=:adi,
				koyun_irk=:irk,
				koyun_cinsiyet=:cinsiyet,
				koyun_alisfiyati=:alisfiyati,
				koyun_alistarihi=:alistarihi,
				koyun_dogumtarihi=:dogumtarihi,
				koyun_durum=:durum,
				ana_id=:ana,
				baba_id=:baba,
				koyun_nitelik=:nitelik,
				koyun_padok=:padok,
				koyun_kardesdurumu=:kardesdurumu,
				koyun_not=:nott");
			$ekle=$koyunekle->execute(array(
				'id' => $_POST['kullanici_id'],
				'kupeno' => strtoupper($resmiKupe),
				'kupeno_isletme' => strtoupper($isletme_kupe[$key]),
				'adi' => $adi[$key],
				'irk' => $_POST['koyun_irk'],
				'cinsiyet' => $cinsiyet[$key],
				'alisfiyati' => $_POST['koyun_alisfiyati'],
				'alistarihi' => $_POST['koyun_alistarihi'],
				'dogumtarihi' => $_POST['koyun_dogumtarihi'],
				'durum' => $_POST['koyun_durum'],
				'ana' => $_POST['ana_id'],
				'baba' => $_POST['baba_id'],
				'nitelik' => $_POST['koyun_nitelik'],
				'padok' => $_POST['koyun_padok'],
				'kardesdurumu' => $_POST['koyun_kardesdurumu'],
				'nott' => $nott[$key]
				));
			
			if ($ekle) {
				header("Location:production/koyunlar.php?durum=true");
			} else {
				header("Location:production/koyunlar.php?durum=false");
			}
		}
	}
