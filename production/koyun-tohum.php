<?php 
    include 'header.php'; 

    $koyuntohumsorgu=$db->prepare("SELECT * FROM koyun_tohum WHERE kullanici_id=:id ORDER BY koyun_kayittarihi ASC");
    $koyuntohumsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$koyuntohumsorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");

    $koyunbilgisi=$db->prepare("SELECT * FROM koyun WHERE koyun_id=:id");

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
                    <h2>Koyun Aşım Kaydı</h2>
                    <div class=" text-right">
                      <a href="koyun-tohum-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                          <th class="">Aşım Tarihi</th>
                          <th class="">Aşım Yapan Koç</th>
                          <th class="">Açıklama</th>
                          <th class="">Ayarlar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($koyuntohumcek=$koyuntohumsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                            <?php 
                                $koyunbilgisi->execute(array(
                                  'id' => $koyuntohumcek['koyun_id']
                                  ));
                                $koyunbilgisicek=$koyunbilgisi->fetch(PDO::FETCH_ASSOC);
                                echo $koyunbilgisicek['koyun_kupeno'];
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                            <?php
                                $koyunbilgisi->execute(array(
                                  'id' => $koyuntohumcek['koyun_id']
                                  ));
                                $koyunbilgisicek=$koyunbilgisi->fetch(PDO::FETCH_ASSOC);
                                echo $koyunbilgisicek['koyun_adi'];
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2">
                            <?php 
                                echo date("d.m.Y", strtotime($koyuntohumcek["koyun_tohumtarihi"]));
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
                            $koyunbilgisi->execute(array(
                              'id' => $koyuntohumcek['koyun_asim_koc']
                              ));
                              $koyunbilgisicek=$koyunbilgisi->fetch(PDO::FETCH_ASSOC);
                            echo $koyunbilgisicek['koyun_adi'];
                          ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                            <?php 
                                echo $koyuntohumcek['koyun_tohum_not'];
                            ?>
                          </td>
                          
                          <td class="text-center">
                            <!-- <a href="hayvan-profil.php?hayvan_id=<?php echo $koyuntohumcek['koyun_tohum_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a> -->
                            <a href="koyun-tohum-duzenle.php?koyun_tohum_id=<?php echo $koyuntohumcek['koyun_tohum_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?koyuntohumsil=true&koyun_tohum_id=<?php echo $koyuntohumcek['koyun_tohum_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i> Sil</a>
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