<?php
	$dns="mysql:host=localhost;dbname=eks";
	$kullanici_adi='root';
	$parola='';
    try {
        $db= new PDO($dns,$kullanici_adi,$parola);
        #Türçe karakter
        $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    #hata yakalama
    catch (PDOExpception $e) {
        echo $e->getMessage();
    }
?>