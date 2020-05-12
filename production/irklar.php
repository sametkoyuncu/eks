<?php 
    include 'header.php'; 

    $buyukbasirksorgu=$db->prepare("SELECT * FROM irk");
    $buyukbasirksorgu->execute();

    $kucukbasirksorgu=$db->prepare("SELECT * FROM irk_koyun");
    $kucukbasirksorgu->execute();

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
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sığır Irkları</h2>
                    <div class=" text-right">
                      <a href="irk-ekle-sigir.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <?php
                  if(isset($_GET['durum_sigir'])){
                    if ($_GET['durum_sigir']=='true') { ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong></strong> İşlem başarıyla kaydedildi..
                      </div>
                    <?php } elseif ($_GET['durum_sigir']=='false') { ?>
                      <div class="alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> İşlem kaydedilemedi, lütfen tekrar deneyiniz. Sorunun devam etmesi halinde site yöneticisi ile irtibata geçin..
                      </div>
                    <?php }
                    } ?>

                  <div class="x_content">
                    <table id="" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-1 col-sm-1">Id</th>
                          <th class="col-md-2 col-sm-2">Adı</th>
                          <th class="">Özellikleri</th>
                          <th class="col-md-1 col-sm-1 col-xs-12"></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($buyukbasirkcek=$buyukbasirksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $buyukbasirkcek['irk_id']; ?></td>
                          <td><?php echo $buyukbasirkcek['irk_adi']; ?></td>
                          <td><?php echo $buyukbasirkcek['irk_ozellikleri']; ?></td>
                          <td class="text-center">
                            <!--<a href="birim-duzenle.php?birim_id=<?php echo $buyukbasirkcek['irk_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>-->
                            <a href="../islem.php?irksilsigir=true&irk_id=<?php echo $buyukbasirkcek['irk_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
                          </td>
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Koyun Irkları</h2>
                    <div class=" text-right">
                      <a href="irk-ekle-koyun.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                    <table id="" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-1 col-sm-1">Id</th>
                          <th class="col-md-2 col-sm-2">Adı</th>
                          <th class="">Özellikleri</th>
                          <th class="col-md-1 col-sm-1 col-xs-12"></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($kucukbasirkcek=$kucukbasirksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $kucukbasirkcek['irk_id']; ?></td>
                          <td><?php echo $kucukbasirkcek['irk_adi']; ?></td>
                          <td><?php echo $kucukbasirkcek['irk_ozellikleri']; ?></td>
                          <td class="text-center">
                            <!--<a href="birim-duzenle.php?birim_id=<?php echo $kucukbasirkcek['irk_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>-->
                            <a href="../islem.php?irksilkoyun=true&irk_id=<?php echo $kucukbasirkcek['irk_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
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