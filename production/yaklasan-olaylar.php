<?php include 'header.php'; 

  $hatirlaticisorgu=$db->prepare("SELECT * FROM hatirlatici WHERE kullanici_id=:id ORDER BY hatirlatici_tarih");
  $hatirlaticisorgu->execute(array(
        'id' => $kullanici_id
  ));  
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Yaklaşan Olaylar</h3>
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
                <!-- Yaklaşan Olaylar -->
                <div class="col">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Yaklaşan Olaylar</h2>
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
                                  }
                                  if($gun_farki>0){ #elseif //ğer sadece gün veya saat gibi yazılacaksa elseif, hepsi beraber olacaksa if kullanılmalı
                                    $kalan_zaman.=$gun_farki.' gün ';
                                  }
                                  if($saat_farki>0){ #elseif
                                    $kalan_zaman.=$saat_farki.' saat';
                                  #}elseif($dakika_farki>0){
                                  #  $kalan_zaman.=$dakika_farki.' dakika';
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
            </div>
            </div>
          </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>