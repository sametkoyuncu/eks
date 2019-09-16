<?php 
    include 'header.php'; 

    $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_durum!=1 ORDER BY hayvan_kayittarihi ASC");
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
                    <h2>Hayvanlar Arşiv</h2>
                    <div class=" text-right">
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
                          <th>Küpe Numarası</th>
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
                          <td><?php echo $hayvancek['hayvan_kupeno']; ?></td>
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