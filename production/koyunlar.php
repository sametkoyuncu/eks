<?php 
    include 'header.php'; 

    $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 ORDER BY koyun_kayittarihi ASC");
    $koyunsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$koyunsorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk_koyun WHERE irk_id=:id");
    
    $tartimsorgu=$db->prepare("SELECT * FROM tartim_koyun WHERE kullanici_id=:k_id and hayvan_id=:h_id ORDER BY tartim_tarihi DESC");
    
    $erkeksorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 and koyun_cinsiyet=1");
    $erkeksorgu->execute(array(
      'id' => $kullanici_id
      ));
    $sayacErkek=$erkeksorgu->rowCount();
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h2 class="modal-title" id="exampleModalLongTitle">Kayıt Şeklini Seçiniz
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </h2>
      </div>
      <div class="modal-body text-center">
        <a href="koyun-ekle-satinal.php"><img class="" src="../images/koyun-ekle-modal/koyun.png" alt=""></a>
        <a href="koyun-ekle-dogum.php"><img class="" src="../images/koyun-ekle-modal/kuzu.png" alt=""></a>
      </div><!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
<!-- modal son -->

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
                <!--<div class="x_panel">-->
                  <div class="row top_tiles">
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/koc-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $sayacErkek ?></div>
                        <h3>Erkek</h3>
                        <p>Toklu ve Koçlar.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/koyun2-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $sayac-$sayacErkek ?></div>
                        <h3>Dişi</h3>
                        <p>Toklu, Şişek ve Koyunlar.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/kuzu2-yuvarlak-ikon.png" alt=""></div>
                        <div class="count">00</div>
                        <h3>Kuzu</h3>
                        <p>6 aylık ve altı tümü.<p>
                      </div>
                    </div>
                    <!-- widget son -->
                    <!-- widget başlangıç -->
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats">
                        <div class="icon"><img src="../images/eks-genel/tumu-yuvarlak-ikon.png" alt=""></div>
                        <div class="count"><?php echo $sayac ?></div>
                        <h3>Toplam</h3>
                        <p>Tüm sürü.</p>
                      </div>
                    </div>
                    <!-- widget son -->
                  </div><!-- row top_tiles -->
                  <!--</div>--><!-- -- x_panel -->  
              </div><!-- col-md-12 col-sm-12 col-xs-12 -->

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Koyunlar</h2>
                    <div class=" text-right">
                      <a href="" class="btn btn-round btn-success btn-sm"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                        <th>İşletme K.</th>
                          <th>Devlet Küpesi</th>
                          <th>Koyun Adı</th>
                          <th class="col-md-1 col-sm-1">Irk</th>
                          <th class="col-md-1 col-sm-1">Cinsiyet</th>
                          <th class="">Nitelik</th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($koyuncek=$koyunsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $koyuncek['koyun_kupeno_isletme']; ?></td>
                          <td><?php echo $koyuncek['koyun_kupeno']; ?></td>
                          <td><?php echo $koyuncek['koyun_adi']; ?></td>
                          <td>
                          <?php 
                            $irksorgu->execute(array(
                              'id' => $koyuncek['koyun_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                          ?>
                          </td>
                          <td>
                          <?php 
                            if($koyuncek['koyun_cinsiyet']=='1'){
                              echo "Erkek";
                            }else{
                              echo "Dişi";
                            }
                          ?>
                          </td>
                          <td>
                            <?php 
                              if($koyuncek['koyun_nitelik']=='1'){
                                echo "Damızlık";
                              }elseif($koyuncek['koyun_nitelik']=='2'){
                                echo "Adaklık";
                              }elseif($koyuncek['koyun_nitelik']=='3'){
                                echo "Kurbanlık";
                              }elseif($koyuncek['koyun_nitelik']=='4'){
                                echo "Kasaplık";
                              }
                            ?>
                          </td>
                          <td class="text-center">
                            <a href="koyun-profil.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a>
                            <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?koyunsil=true&koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
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