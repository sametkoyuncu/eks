<?php 
    include 'header.php';
    include '../baglan.php';

    $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
    $koyunsorgu->execute(array(
      'id' => $kullanici_id,
      'koyun_id' => $_GET['koyun_id']
      ));
    $koyuncek=$koyunsorgu->fetch(PDO::FETCH_ASSOC);

    $sayac=$koyunsorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");

    $tartimsorgu=$db->prepare("SELECT * FROM tartim_koyun WHERE kullanici_id=:id and hayvan_id=:koyun_id");
    $tartimsorgu->execute(array(
      'id' => $kullanici_id,
      'koyun_id' => $_GET['koyun_id']
      ));

      $annesorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
      $annesorgu->execute(array(
        'id' => $kullanici_id,
        'koyun_id' => $koyuncek['ana_id']
        ));
      $annecek=$annesorgu->fetch(PDO::FETCH_ASSOC);

      $babasorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
      $babasorgu->execute(array(
        'id' => $kullanici_id,
        'koyun_id' => $koyuncek['baba_id']
        ));
      $babacek=$babasorgu->fetch(PDO::FETCH_ASSOC);
  ?>  

      
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>
                  <a href="koyunlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                    <?php echo $koyuncek['koyun_kupeno'] ?> Küpeli Koyun Bilgileri
                  </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                  <div class="input-group">
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- 3333 -->
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kimlik Bilgileri</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div  class="text-center">
                      <img src="../images/koyun/<?php echo $koyuncek['koyun_irk']; ?>.jpg" alt="" style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 3px solid rgba(70,184,218,1);" >
                      <div style="margin-top:15px">
                         <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-info btn-xs">&nbsp;Düzenle&nbsp;</a>
                         <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-success btn-xs">&nbsp;Satıldı&nbsp;</a>
                         <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-danger btn-xs">&nbsp;Öldü&nbsp;</a>
                      </div>
                     </div>
                     <hr>
                    <h3>
                        <?php 
                            echo "<b>İşletme Küpesi:</b> <br>";
                            if(strlen($koyuncek['koyun_kupeno_isletme'])>0){
                              echo $koyuncek['koyun_kupeno_isletme'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      </h3>
                      <hr>
                      <ul class="list-unstyled user_data">
                        <li>
                          <?php echo "<b>Devlet Küpesi:</b> ".$koyuncek['koyun_kupeno']; ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Adı:</b> ";
                            if(strlen($koyuncek['koyun_adi'])>0){
                              echo $koyuncek['koyun_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Doğum Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_dogumtarihi'])>0){
                              echo date("d.m.Y", strtotime($koyuncek['koyun_dogumtarihi']));
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Irk:</b> ";
                            if($koyuncek['koyun_irk']){
                              $irksorgu->execute(array(
                              'id' => $koyuncek['koyun_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Nitelik:</b> ";
                            if($koyuncek['koyun_nitelik']){
                              if($koyuncek['koyun_nitelik']=='1'){
                                echo "Damızlık";
                              }elseif ($koyuncek['koyun_nitelik']=='2') {
                                echo "Adaklık";
                              }elseif ($koyuncek['koyun_nitelik']=='3') {
                                echo "Kurbanlık";
                              }elseif ($koyuncek['koyun_nitelik']=='4') {
                                echo "Kasaplık";
                              }
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Durum:</b> ";
                            if($koyuncek['koyun_durum']){
                              if($koyuncek['koyun_durum']=='1'){
                                echo "Mevcut";
                              }elseif ($koyuncek['koyun_durum']=='2') {
                                echo "Satıldı";
                              }else{
                                echo "Öldü";
                              }
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <hr>
                        <li>
                          <?php 
                            echo "<b>Alış Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_alistarihi'])>0){
                              echo date("d.m.Y", strtotime($koyuncek['koyun_alistarihi']));
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Alış Fiyatı:</b> ";
                            if($koyuncek['koyun_alisfiyati']>0){
                              echo $koyuncek['koyun_alisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Satış Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_satistarihi'])>0){
                              echo $koyuncek['koyun_satistarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Satış Fiyatı:</b> ";
                            if($koyuncek['koyun_satisfiyati']>0){
                              echo $koyuncek['koyun_satisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <hr>
                        <li>
                          <?php 
                            echo "<b>Ölüm Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_olumtarihi'])>0){
                              echo $koyuncek['koyun_olumtarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <!-- 3333 son -->
              <!-- 9999 -->
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Diğer Bilgiler</h2>
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
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-group"></i>&nbsp;<span class="gizlenecek-kisim">Soy Kaydı</span></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><i class="fa fa-heart"></i>&nbsp;<span class="gizlenecek-kisim">Sağlık Takibi</span></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><i class="fa fa-history"></i>&nbsp;<span class="gizlenecek-kisim">İşlem Geçmişi</span></a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <div class="col-md-6 col-xs-12">
                            Anne Bilgileri(<small><a href="#" style="color:hotpink !important;">Profiline Bak</a></small>):
                            <ul>
                              <li>İşletme Küpesi: Düzenlenecek </li>
                              <li>Eş (Kardeş Sayısı) durumu: Düzenlenecek </li>
                              <li>Doğumda Yavru Oranı: Belirtilmemiş </li>
                            </ul>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            Baba Bilgileri(<small><a href="#" style="color:deepskyblue !important;">Profiline Bak</a></small>):
                            <ul>
                              <li>İşletme Küpesi: 9873480 </li>
                              <li>Eş (Kardeş Sayısı) durumu: 9873480 </li>
                              <li>Doğumda Yavru Oranı: 9873480 </li>
                            </ul>
                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 9999 son --->
              <!-- tartım -->
              <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Tartım Geçmişi </h2>
                            <div class=" text-right">
                              <a href="tartim-ekle.php?id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tartım Ekle</a>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="x_content">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="col-md-1 col-sm-1">#</th>
                                  <th class="col-md-3 col-sm-3">Tartım Zamanı</th>
                                  <th class="col-md-1 col-sm-1">Kilo</th>
                                  <th class="">Açıklama</th>
                                  <th ></th>
                                </tr>
                              </thead>


                              <tbody>
                              <?php $siraSayac=1; ?>
                              <?php while ($tartimcek=$tartimsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                  <th scope="row"><?php echo $siraSayac; ?></th>
                                  <td><?php echo date("d.m.Y", strtotime($tartimcek['tartim_tarihi'])); ?></td>
                                  <td><?php echo $tartimcek['tartim_kilo']." kg"; ?></td>
                                  <td><?php echo $tartimcek['tartim_aciklama']; ?></td>
                                  <td class="col-md-1 col-sm-1 text-center">
                                    <a href="../islem.php?tartimsil=true&tartim_id=<?php echo $tartimcek['tartim_id']; ?>&hayvan_id=<?php echo $tartimcek['hayvan_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fas fa-trash" aria-hidden="true"></i> Sil</a>
                                  </td>
                                </tr>
                                <?php $siraSayac=$siraSayac+1; ?>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
              <!-- tartım son -->
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>