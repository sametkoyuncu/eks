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

               <div class="col-md-5 col-sm-5 col-xs-12"> <!-- hava durumu başlangıç -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yaklaşan Olaylar <small><a href="">Detaylar için tıklayınız</a></small></h2>
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

                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Açıklama</th>
                          <th>Kalan Zaman</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Ceylan dikiş kontrol.</td>
                          <td>16 Saat</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Aşı günü doluyor.</td>
                          <td>2 Gün</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Buzağı kontrol zamanı.</td>
                          <td>3 Hafta</td>
                        </tr>
                        <tr>
                          <th scope="row">4</th>
                          <td>Yem gelecek.</td>
                          <td>1 Ay</td>
                        </tr>
                        <tr>
                          <th scope="row">5</th>
                          <td>Cingöz sütten kesilecek.</td>
                          <td>2 Ay</td>
                        </tr>
                      </tbody>
                    </table>

                    </div>
            
                  </div>
                  
                </div> <!-- col son-->

              

              <div class="col-md-5 col-sm-5 col-xs-12"> <!-- hava durumu başlangıç -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hava Durumu <small><a href="https://forecast7.com/tr/41d1029d65/sile/">Detaylar için tıklayınız</a></small></h2>
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

                <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Muhasebe Özet <!-- <small><a href="muhasebe.php">Detaylar için tıklayınız</a></small> --></h2>
                    <!-- <ul class="nav navbar-right panel_toolbox">
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
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>


                  <div class="x_content">
                    
                    <div class="">
                      <h3>Gelir</h3>
                      <p class="green"><?php echo $gelircek['gelir']." ₺"; ?></p>
                    </div>
                    <div class="">
                      <h3>Gider</h3>
                      <p class="red"><?php echo $gidercek['gider']." ₺"; ?></p>
                    </div>
                    <div class="">
                      <h3>Toplam</h3>
                      <p><?php echo $gelircek['gelir']-$gidercek['gider']." ₺"; ?></p>
                    </div>
                  </div>
            
                  </div>
                  
                </div> <!-- col muhasebe son -->

              </div> <!-- row -->

            </div>
          </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>