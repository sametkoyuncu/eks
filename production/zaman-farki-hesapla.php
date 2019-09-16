<?php
    ob_start();
    session_start();
  
    if (empty($_SESSION['kullanici_adi'])) {
        header("Location:hesap.php");
    }
   if ($_SESSION['kullanici_yetki'] != '2') {
        header("Location:hesap.php");
    }
  
    include '../functions.php';
    date_default_timezone_set('Europe/Istanbul');
  
    include '../baglan.php';
  
    $kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici");
    $kullanicisorgu->execute(array(
          'kullanici' => $_SESSION['kullanici_adi']
        ));
    $kullanicicek=$kullanicisorgu->fetch(PDO::FETCH_ASSOC);
    $kullanici_id=$kullanicicek['kullanici_id'];


    #zaman farkı hesaplamaya kolaylık olsun için :)
    
    #veritabanı işlemleri
    $hatirlaticisorgu=$db->prepare("SELECT * FROM hatirlatici WHERE kullanici_id=:id LIMIT 1");
    $hatirlaticisorgu->execute(array(
            'id' => $kullanici_id
    ));
    $hatirlaticicek=$hatirlaticisorgu->fetch(PDO::FETCH_ASSOC);

    $hatirlatma_zamani = strtotime($hatirlaticicek['hatirlatici_tarih']);
    
    #zaman dilimi
    date_default_timezone_set('Europe/Istanbul');
    
    
    #şimdiki zamanın unix zaman damgası değeri alınıyor
    $simdiki_zaman = time();

    #kalan zamanı bulacağımız için şimdiki zaman daha küçük olmalı
    #if($hatirlatma_zamani > $şimdiki_zaman){
        $fark = $hatirlatma_zamani - $simdiki_zaman;

        $dakika = $fark / 60;
        $saniye_farki = floor($fark - (floor($dakika) * 60));
        
        $saat = $dakika / 60;
        $dakika_farki = floor($dakika - (floor($saat) * 60));
        
        $gun = $saat / 24;
        $saat_farki = floor($saat - (floor($gun) * 24));
        
        $yil = floor($gun/365);
        $gun_farki = floor($gun - (floor($yil) * 365));
        
        echo $yil . ' yıl    ';
        echo $gun_farki . ' gün    ';
        echo $saat_farki . ' saat    ';
        echo $dakika_farki . ' dakika   ';
        echo $saniye_farki . ' saniye';


    #}
    

?>