<?php 

      include 'header.php'; 
      #ayarları veritabanından çekme
      $hayvansorgu=$db->prepare("SELECT * FROM hisse WHERE kullanici_id=:id and hisse_id=:hisse_id");
      $hayvansorgu->execute(array(
        'id' => $kullanici_id,
        'hisse_id' => $_GET['hisse_id']
        ));
      $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$hayvansorgu->rowCount();

      $irksorgu=$db->prepare("SELECT * FROM irk");
      $irksorgu->execute();
      #$irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Hissedar Düzenle </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Düzenle<small></small></h2>
                     <div class=" text-right">
                        <a href="hisse.php?hayvan_id=<?php echo $hayvancek['hayvan_id'] ?>" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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

                      <form action="../../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
                      <input type="hidden" name="hisse_id" value="<?php echo $hayvancek['hisse_id']; ?>">
                        
                      <div class="form-group">
                         <label class="control-label col-md-2" for="first-name">Alıcı 
                         </label>
                         <div class="col-md-9">
                           <input type="text" id="first-name" name="hisse_alici" class="form-control" value="<?php echo $hayvancek['hisse_alici'] ?>" required>
                         </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-2" for="first-name">Telefon 
                          </label>
                          <div class="col-md-9">
                            <input type="text" id="first-name" required="required" name="hisse_alici_tel" class="form-control col-md-2 col-xs-12" value="<?php echo $hayvancek['hisse_alici_tel'] ?>" required>
                          </div>  
                        </div>

                       <div class="form-group">
                          <label class="control-label col-md-2" for="first-name">Ödenen 
                          </label>
                          <div class="col-md-9">
                            <input type="text" id="first-name" required="required" name="hisse_odenen" class="form-control col-md-2 col-xs-12" value="<?php echo $hayvancek['hisse_odenen'] ?>" required>
                          </div>  
                        </div> 

                        <div class="form-group">
                        <div align="right" class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" name="hissedarguncelle" class="btn btn-round btn-success">Kaydet</button>
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