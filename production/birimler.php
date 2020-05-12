<?php 
    include 'header.php'; 

    $birimsorgu=$db->prepare("SELECT * FROM birim");
    $birimsorgu->execute();

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
                    <h2>Birimler</h2>
                    <div class=" text-right">
                      <a href="birim-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                          <th class="col-md-1 col-sm-1">Id</th>
                          <th class="col-md-2 col-sm-2">Ad</th>
                          <th class="">Açıklama</th>
                          <th class="col-md-1 col-sm-1 col-xs-12"></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($birimcek=$birimsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $birimcek['birim_id']; ?></td>
                          <td><?php echo $birimcek['birim_adi']; ?></td>
                          <td><?php echo $birimcek['birim_aciklama']; ?></td>
                          <td class="text-center">
                            <!--<a href="birim-duzenle.php?birim_id=<?php echo $birimcek['birim_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>-->
                            <a href="../islem.php?birimsil=true&birim_id=<?php echo $birimcek['birim_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
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