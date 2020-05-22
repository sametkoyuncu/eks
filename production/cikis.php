<?php
session_start();
$_SESSION['kullanici_adi'] = 0;
$_SESSION['kullanici_yetki'] = NULL;
session_destroy();

header("Location:hesap.php?durum=exit");
