<?php 
    include 'header.php'; 

    $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_durum=1 ORDER BY hayvan_kayittarihi ASC");
    $hayvansorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$hayvansorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");
    
    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:k_id and hayvan_id=:h_id ORDER BY tartim_tarihi DESC");

    $sosyal_medya_id=NULL;

    $erkeksorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_durum=1 and hayvan_cinsiyet=1");
    $erkeksorgu->execute(array(
      'id' => $kullanici_id
      ));
    $sayacErkek=$erkeksorgu->rowCount();

    date_default_timezone_set('Europe/Istanbul');
    
    $buzagisorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_durum=1");
    $buzagisorgu->execute(array(
        'id' => $kullanici_id
        ));
    $buzagisayac = 0;
    $dogum_tarihi = 0;
    $bugun = 0;
    $fark = 0;
    while ($buzagicek=$buzagisorgu->fetch(PDO::FETCH_ASSOC)) { 
         $dogum_tarihi = strtotime($buzagicek['hayvan_dogumtarihi']);
         $bugun = time();
         $fark = $bugun - $dogum_tarihi;
         $fark = $fark / (24*60*60);
         $fark = floor($fark);
         #$fark = $fark - 180;
        if($fark < 180){
            $buzagisayac++;
        }
        #echo $kuzucek['koyun_dogumtarihi'];
        
    }

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- widgets start -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <!--<div class="x_panel">-->
                  <div class="row top_tiles">
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/tosun-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $sayacErkek ?></div>
                        <h3>Erkek</h3>
                        <p>Tosunlar.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/inek-yuvarlak-ikon2.png" alt=""></div>
                        <div class="count"><?php echo $sayac-$sayacErkek ?></div>
                        <h3>Dişi</h3>
                        <p>Düve ve İnekler.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/buzagi-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $buzagisayac ?></div>
                        <h3>Buzağı</h3>
                        <p>6 aylık ve altı tümü.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/sigir-tumu-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $sayac ?></div>
                        <h3>Toplam</h3>
                        <p>Tüm sürü.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                  </div><!-- row top_tiles -->
                  <!--</div>--><!-- -- x_panel -->  
              </div><!-- col-md-12 col-sm-12 col-xs-12 -->
              <!-- widgets end -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hayvanlar</h2>
                    <div class="text-right">
                      <a href="hayvan-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <?php
                  if(isset($_GET['durum'])){
                    if ($_GET['durum']=='true') { ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong></strong> İşlem başarıyla kaydedildi..
                      </div>
                    <?php } elseif ($_GET['durum']=='false') { ?>
                      <div class="alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> İşlem kaydedilemedi, lütfen tekrar deneyiniz. Sorunun devam etmesi halinde site yöneticisi ile irtibata geçin..
                      </div>
                    <?php }
                    } ?>

                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Hayvan Adı</th>
                          <th class="col-md-1 col-sm-1">Irk</th>
                          <th class="col-md-1 col-sm-1">Cinsiyet</th>
                          <th >Canlı Ağırlık</th>
                          <th class="">Alış Fiyatı</th>
                          <th class="">Satış Fiyatı</th>
                          <th class="">Durum</th>
                          <th ></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $hayvancek['hayvan_adi']; ?></td>
                          <td>
                          <?php 
                            $irksorgu->execute(array(
                              'id' => $hayvancek['hayvan_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                          ?>
                          </td>
                          <td>
                          <?php 
                            if($hayvancek['hayvan_cinsiyet']=='1'){
                              echo "Erkek";
                            }else{
                              echo "Dişi";
                            }
                          ?>
                          </td>
                          <td>
                            <?php
                                  $tartimsorgu->execute(array(
                                    'k_id' => $kullanici_id,
                                    'h_id' => $hayvancek['hayvan_id']
                                    ));
                                  $tartimcek=$tartimsorgu->fetch(PDO::FETCH_ASSOC);
                                  echo $tartimcek['tartim_kilo']." kg"; 
                            ?>
                          </td>
                          <td class="red"><?php echo $hayvancek['hayvan_alisfiyati']." ₺"; ?></td>
                          <td class="green">
                            <?php 
                              if ($hayvancek['hayvan_satisfiyati']>0) {
                                echo $hayvancek['hayvan_satisfiyati']." ₺";
                              } else {
                                echo "Yok";
                              }
                            ?>
                          </td>
                          <td>
                            <?php 
                              if($hayvancek['hayvan_durum']=='1'){
                                echo "Mevcut";
                              }elseif($hayvancek['hayvan_durum']=='2'){
                                echo "Satıldı";
                              }else{
                                echo "Öldü";
                              }
                            ?>
                          </td>
                          <td class="text-center">
                            <a href="hayvan-profil.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a>
                            <a href="hayvan-duzenle.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?hayvansil=true&hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</a>
                          </td>
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>