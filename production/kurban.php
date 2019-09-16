<?php 
    include 'header.php'; 

    $hayvansorgu=$db->prepare("SELECT * FROM kurbanlik_hayvanlar WHERE kullanici_id=:id ORDER BY hayvan_kayittarihi ASC");
    $hayvansorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$hayvansorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");
    
    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:k_id and hayvan_id=:h_id ORDER BY tartim_tarihi DESC");


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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="">Kurbanlık Hayvanlar</h2>
                    <div class=" text-right"  id="yazdirma">
                      <button class="btn btn-round btn-default" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
                      <button href="" class="btn btn-round btn-primary btn-sm"><i class="fa fa-th-list" aria-hidden="true" disabled></i> Tüm Hisseler</button>
                      <a href="kurbanlik-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                          <th class="">Küpe No</th>
                          <th class="">Adı</th>
                          <th class="">Canlı Ağırlık</th>
                          <th class="">Fiyat</th>
                          <th class="">Durum</th>
                          <th class="">Alıcı</th>
                          <th class="">Telefon</th>
                          <th class=""  id="yazdirma">Ayarlar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td class="">
                            <?php 
                                echo $hayvancek['hayvan_kupeno'];
                            ?>
                          </td>
                          <td class="">
                            <?php
                                echo $hayvancek['hayvan_adi'];
                            ?>
                          </td>
                          <td class="">
                            <?php
                              echo $hayvancek['hayvan_kilo']." kg";
                            ?>
                          </td>
                          <td class="">
                            <?php
                              echo $hayvancek['hayvan_satisfiyati']." ₺";
                            ?>
                          </td>
                          <td class="">
                          <?php 
                            if($hayvancek['hayvan_durum']=='1'){
                              echo "Tek Hisse";
                            }else{
                              echo $hayvancek['hayvan_hisse_adedi']." Hisse";
                            }
                          ?>
                          </td>
                          <td class="">
                          <?php 
                            echo $hayvancek['hayvan_alici'];
                          ?>
                          </td>
                          <td class="">
                          <?php 
                            echo $hayvancek['hayvan_alici_tel'];
                          ?>
                          </td>
                          
                          
                          <td class="col-md-3 text-center" id="yazdirma">
                            <a href="hisse.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Hisseler</a>
                            <a href="kurbanlik-duzenle.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?kurbanliksil=true&hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i> Sil</a>
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