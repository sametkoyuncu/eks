<?php 

      include 'header.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>İçerik Bölümü Ayarları </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Şifre Değiştir<small></small></h2>
                     <div class=" text-right">
                        <a href="profil-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                      </div>
                    <div class="clearfix"></div>
                  </div>

                  <?php
                  if(isset($_GET['durum'])){
                    if ($_GET['durum']=='true') { ?>
                      <div class="text-center alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong></strong> İşlem başarıyla kaydedildi..
                      </div>
                    <?php } elseif ($_GET['durum']=='false' && empty($_GET['hata_id'])) { ?>
                      <div class="text-center alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> İşlem kaydedilemedi, lütfen tekrar deneyiniz. Sorunun devam etmesi halinde site yöneticisi ile irtibata geçin..
                      </div>
                    <?php }
                    elseif ($_GET['durum']=='false' && $_GET['hata_id']=='1') { ?>
                      <div class="text-center alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> Girdiğiniz şifreler aynı değil..
                      </div>
                    <?php }
                    elseif ($_GET['durum']=='false' && $_GET['hata_id']=='2') { ?>
                      <div class="text-center alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> Şifreniz hatalı..
                      </div>
                    <?php }
                    } ?>

                  <div class="x_content">

                    <form action="../islem.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Eski Şifreniz <span class="required">*</span>
                          </label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="password" id="first-name" required="required" name="kullanici_eskisifre" class="form-control col-md-7 col-xs-12" placeholder="Eski şifrenizi giriniz.." ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifreniz <span class="required">*</span>
                          </label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="password" id="first-name" required="required" name="kullanici_sifre" class="form-control col-md-7 col-xs-12" placeholder="Yeni şifrenizi giriniz.." ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifreniz (Tekrar) <span class="required">*</span>
                          </label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="password" id="first-name" required="required" name="kullanici_sifretekrar" class="form-control col-md-7 col-xs-12" placeholder="Yeni şifrenizi giriniz.." ">
                          </div>
                        </div>

                      <div class="form-group">
                        <div align="right" class="col-md-7 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="sifreguncelle" class="btn btn-round btn-success">Kaydet</button>
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