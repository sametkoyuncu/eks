<!-- menu profile quick info -->
<br>
<div class="profile clearfix">
  <div class="profile_pic text-center" style="margin-top: 25px; ">
    <a href="profil.php"><img src="<?php echo $kullanicicek['kullanici_gorsel']; ?>" alt="" style="width: 50px; height: 50px; max-width: 50px; max-height: 50px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);"></a>
    <!--<img src="<?php echo $kullanicicek['kullanici_gorsel']; ?>" alt="" class="profile_img" style="width: 64px; height: 64px; margin: auto;">-->
  </div>
  <div class="profile_info">
    <span>Hoş geldin,</span>
    <a href="profil.php">
      <h2><?php echo $_SESSION['kullanici_adi'] ?></h2>
    </a>
  </div>
  <div class="clearfix"></div>
</div>
<!-- /menu profile quick info -->

<br />
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <!-- <h3>MENÜ</h3> -->
    <ul class="nav side-menu">
      <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a>
      </li>
      <li><a><i class="fa fa-paw"></i> Büyükbaş <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="hayvanlar.php">Tüm Hayvanlar</a></li>
          <li><a href="inek-tohum.php">İnek Tohum Kayıtları</a></li>
          <li><a href="buzagi-dogum.php">Buzağı Doğum Kayıtları</a></li> <!-- eksta hayvanlar -->
          <li><a href="kurban.php">Kurban İşlemleri</a></li>
          <li><a href="hayvan-arsiv.php">Arşiv</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-paw"></i> Küçükbaş <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="koyunlar.php">Tüm Koyunlar</a></li>
          <li><a href="koyun-tohum.php">Koyun Aşım Kayıtları</a></li>
          <li><a href="koyun-gruplari.php">Gruplar</a></li>
          <li><a href="koyun-padoklari.php">Padoklar</a></li>
          <li><a href="koyun-arsiv.php">Arşiv</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-archive"></i> Depo <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="yem-kayit.php">Yem Stoğu</a></li>
          <!--<li><a href="#">İlaç ve Takviyeler</a></li>
          <li><a href="#">Ekipmanlar</a></li>-->
        </ul>
      </li>
      <li><a href="rasyonlar.php"><i class="fa fa-coffee"></i> Rasyonlar </a>
      </li>
      <li><a><i class="fa fa-folder-open-o"></i> Ajanda <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="notlar.php"> Notlar </a></li>
          <li><a href="yapilacaklar.php"> Yapılacaklar </a></li>
          <li><a href="yaklasan-olaylar.php"> Yaklaşan Olaylar </a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-cogs"></i> Ayarlar <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="yemler.php">Yem Çeşitleri</a></li>
          <li><a href="irklar.php">Irklar</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-folder-open"></i> Site <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="mesajlar.php">Mesajlar</a></li>
          <li><a href="aboneler.php">Aboneler</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
<!-- /menu footer buttons -->
</div>
</div>