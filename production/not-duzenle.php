<?php 

      include 'header.php'; 
      include '../baglan.php';
      #ayarları veritabanından çekme
      $notsorgu=$db->prepare("SELECT * FROM notlar WHERE kullanici_id=:id and not_id=:not_id");
      $notsorgu->execute(array(
          'id' => $kullanici_id,
          'not_id' => $_GET['notid']
          ));
      $notcek=$notsorgu->fetch(PDO::FETCH_ASSOC);
      $sayac=$notsorgu->rowCount();
?>
<head>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
</head>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Notlar </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Not Düzenle<small></small></h2>
                     <div class=" text-right">
                        <a href="notlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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

                    <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="notid" value="<?php echo $notcek['not_id']; ?>">
                      <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="first-name" required="required" name="not_baslik" class="form-control col-md-8 col-xs-12" value="<?php echo $notcek['not_baslik']; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Not <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="not_aciklama"><?php echo $notcek['not_aciklama']; ?></textarea> 
                            <script>
                                CKEDITOR.replace( 'not_aciklama' );
                            </script>
                          </div>
                        </div>
                      <div class="form-group">
                        <div align="right" class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                          <button type="submit" name="notguncelle" class="btn btn-round btn-success">Kaydet</button>
                        </div>
                      </div>

                      </form>
						
						
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>