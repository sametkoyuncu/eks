<?php include 'header.php'; 

$muhasebesorgu=$db->prepare("SELECT * FROM muhasebe WHERE kullanici_id=:id");
$muhasebesorgu->execute(array(
    'id' => $kullanici_id
    ));

    #
    #
    #gelir sütununun toplanması
    $gelirsorgu=$db->prepare("SELECT sum(muhasebe_gelir) AS gelir FROM muhasebe WHERE kullanici_id=:id");
    $gelirsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $gelircek=$gelirsorgu->fetch(PDO::FETCH_ASSOC);
    #
    #gider sütununun toplanması
    $gidersorgu=$db->prepare("SELECT sum(muhasebe_gider) AS gider FROM muhasebe WHERE kullanici_id=:id");
    $gidersorgu->execute(array(
        'id' => $kullanici_id
        ));
    $gidercek=$gidersorgu->fetch(PDO::FETCH_ASSOC);
    #
    // setlocale(LC_TIME, 'tr_TR');
    setlocale(LC_TIME, 'tr_TR.UTF-8');
    $gun=date('d');
    $ay=date('m');
    $yil=date('Y');

    $aylar = array(
      'Ocak',
      'Şubat',
      'Mart',
      'Nisan',
      'Mayıs',
      'Haziran',
      'Temmuz',
      'Ağustos',
      'Eylül',
      'Ekim',
      'Kasım',
      'Aralık'
  );

  $notsorgu=$db->prepare("SELECT * FROM notlar WHERE kullanici_id=:id ORDER BY not_kayittarihi DESC LIMIT 5");
    $notsorgu->execute(array(
        'id' => $kullanici_id
        ));
  $issorgu=$db->prepare("SELECT * FROM isler WHERE kullanici_id=:id and isler_durum=1 ORDER BY isler_tarih DESC LIMIT 7");
  $issorgu->execute(array(
        'id' => $kullanici_id
        ));
  $hatirlaticisorgu=$db->prepare("SELECT * FROM hatirlatici WHERE kullanici_id=:id ORDER BY hatirlatici_tarih");
  $hatirlaticisorgu->execute(array(
        'id' => $kullanici_id
  ));  
  $sayacErkek=1;

  $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 ORDER BY koyun_kayittarihi ASC");
  $koyunsorgu->execute(array(
      'id' => $kullanici_id
      ));
  $koyunSayac=$koyunsorgu->rowCount();
  
  $ineksorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_durum=1 ORDER BY hayvan_kayittarihi ASC");
  $ineksorgu->execute(array(
      'id' => $kullanici_id
      ));
  $inekSayac=$ineksorgu->rowCount();
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Yönetim Paneli</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Arama yap..">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ara!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12"> <!-- hava durumu başlangıç -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hava Durumu <small><a href="https://forecast7.com/tr/41d1029d65/sile/" target="_blank">Detaylar için tıklayınız</a></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown-burayisil" role="button" aria-expanded="false" ><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>


                  <div class="x_content">
                    <div class="hava-durumu">
                      <a class="weatherwidget-io" href="https://forecast7.com/tr/41d1529d65/cayirbasi-koyu/" data-label_1="ÇAYIRBAŞI" data-label_2="ŞİLE" data-theme="original" >İSTANBUL Şile</a>
                      <script>
                      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                      </script>
                    </div>
                    
                    </div>
            
                  </div>
                  
                </div> <!-- col havadurumu son-->
              
              </div> <!-- row -->

              <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">


                  <!--Hayvanlar Genel Bakış -->
                  <div class="col">
                    
                    <div class="x_panel">
                        <div class="x_title">
                          <h2>Hayvanlar Genel Bakış</h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <!-- widget başlangıç -->
                          <div class="animated flipInY col-md-6 col-xs-12">
                            <div class="tile-stats">
                              <div class="icon"><img src="../images/eks-genel/inek-yuvarlak-ikon.png" alt=""></div>
                              <div class="count"><?php echo $inekSayac ?></div>
                                <h3>Büyükbaş</h3>
                                <p>Tüm büyükbaş sayısı.</p>
                            </div>
                          </div>
                          <!-- widget son -->
                          <!-- widget başlangıç -->
                          <div class="animated flipInY col-md-6 col-xs-12">
                            <div class="tile-stats">
                              <!--<div class="icon"><i class="fas fa-file" style="color:lightskyblue"></i></div>-->
                              <div class="icon"><img src="../images/eks-genel/tumu-yuvarlak-ikon.png" alt=""></div>
                              <div class="count"><?php echo $koyunSayac ?></div>
                                <h3>Küçükbaş</h3>
                                <p>Tüm küçükbaş sayısı.</p>
                            </div>
                          </div>
                          <!-- widget son -->
                        </div>
                    </div>
                  </div>
                  <!-- -->
                </div>        
              <div class="col-md-4 col-sm-4 col-xs-12"> <!-- sağ şerit -->
                <!-- Yaklaşan Olaylar -->
                <div class="col">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Yaklaşan Olaylar<small><a href="#">Detaylar</a></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">

                        <div class="">
                          <ul class="to_do">
                            <?php while ($hatirlaticicek=$hatirlaticisorgu->fetch(PDO::FETCH_ASSOC)) { 
                              $kalan_zaman=NULL; 
                                  $hatirlatma_zamani = strtotime($hatirlaticicek['hatirlatici_tarih']);
                                  $simdiki_zaman = time();
                                  $fark = $hatirlatma_zamani - $simdiki_zaman;
                                  
                                  if($fark>0){ #allta bitişi var
                                    ?>
                              <li>
                                <?php
                                        $dakika = $fark / 60;
                                        $saniye_farki = floor($fark - (floor($dakika) * 60));
                                        
                                        $saat = $dakika / 60;
                                        $dakika_farki = floor($dakika - (floor($saat) * 60));
                                        
                                        $gun = $saat / 24;
                                        $saat_farki = floor($saat - (floor($gun) * 24));
                                        
                                        $yil = floor($gun/365);
                                        $gun_farki = floor($gun - (floor($yil) * 365));
                                if($fark>0){
                                  if($yil>0){
                                    $kalan_zaman=$yil.' yıl ';
                                  }elseif($gun_farki>0){ #elseif //ğer sadece gün veya saat gibi yazılacaksa elseif, hepsi beraber olacaksa if kullanılmalı
                                    $kalan_zaman.=$gun_farki.' gün ';
                                  }elseif($saat_farki>0){ #elseif
                                    $kalan_zaman.=$saat_farki.' saat';
                                  }elseif($dakika_farki>0){
                                    $kalan_zaman.=$dakika_farki.' dakika';
                                  }
                                }

                                $renk='danger';
                                if($gun_farki>=1 && $gun_farki<8) {
                                  $renk='warning';
                                }elseif($gun_farki>=8){
                                  $renk='success';
                                }

                                ?>
                                <p> <?php echo $hatirlaticicek['hatirlatici_aciklama']; ?> <span class="label label-<?php echo $renk ?>"><?php echo $kalan_zaman ?> sonra</span></p>
                              </li>
                            <?php } #if fark>0 ın bitişi 
                          } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div><!-- yaklaşan olaylar son -->

                <!-- yapılacaklar listesi -->
                <div class="col">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Yapılacaklar <small><a href="#">Bütün Yapılacaklar</a></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">

                        <div class="">
                          <ul class="to_do">
                          <?php while ($iscek=$issorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                            <li>
                              <p> <?php echo $iscek['isler_aciklama']; ?></p>
                            </li>
                          <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div><!-- yapılacaklar listesi son -->
                <!-- Son notlar -->
                <div class="col">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Son Notlar <small><a href="notlar.php">Bütün Notlar</a></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="dashboard-widget-content">

                          <ul class="list-unstyled timeline widget">
                          <?php while ($notcek=$notsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                            <li>
                              <div class="block">
                                <div class="block_content">
                                  <h2 class="title">
                                    <a href="notlar.php"><?php echo $notcek['not_baslik']; ?></a>
                                  </h2>
                                  <p class="excerpt"><?php echo $notcek['not_aciklama']; ?>
                                  </p>
                                </div>
                              </div>
                            </li>
                          <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div><!-- Son notlar son --> 
              </div> <!-- sağ şerit son -->
            </div>
            </div>
          </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>

        <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>