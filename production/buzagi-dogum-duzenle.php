<?php 

      include 'header.php'; 
      #ayarları veritabanından çekme
      $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
      $hayvansorgu->execute(array(
        'id' => $kullanici_id,
        'hayvan_id' => $_GET['hayvan_id']
        ));
      $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$hayvansorgu->rowCount();

      $irksorgu=$db->prepare("SELECT * FROM irk");
      $irksorgu->execute();
      #$irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
      
      $anasorgu=$db->prepare("SELECT * FROM hayvan WHERE hayvan_cinsiyet=0");
      $anasorgu->execute();
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Hayvanlar </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hayvan Düzenle<small></small></h2>
                     <div class=" text-right">
                        <a href="buzagi-dogum.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
                      <input type="hidden" name="hayvan_id" value="<?php echo $kullanici_id; ?>">
                      <input type="hidden" name="hayvan_id" value="<?php echo $hayvancek['hayvan_id']; ?>">
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Küpe Numarası <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_kupeno" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $hayvancek['hayvan_kupeno']; ?>">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hayvan Adı 
                         </label>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_adi" class="form-control col-md-7 col-xs-12" value="<?php echo $hayvancek['hayvan_adi']; ?>">
                         </div>

                       </div>
                       <div class="form-group">
                            <!--
                            ****
                            **** Irkın seçili olarak gelmesini ayarla
                            ****
                             -->
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Irk </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="hayvan_irk">
                               <option value="">Irk seçin..</option>
                               <?php 
                                 while ($irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $irkcek['irk_id']; ?>"><?php echo $irkcek['irk_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                      <!--</div> 
                      <div class="form-group">-->
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Cinsiyet </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <select class="select2_group form-control" required="required" name="hayvan_cinsiyet">
                              <?php 
                                if($hayvancek['hayvan_cinsiyet']=='1') { ?>
                                  <option value="1">Erkek</option>
                                  <option value="0">Dişi</option>
                                <?php } else { ?> 
                                  <option value="1">Erkek</option>
                                  <option value="0">Dişi</option>
                                <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <div>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Annesi </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="ana_id">
                               <option value="">Hayvanın annesini seçin..</option>
                               <?php 
                                 while ($anacek=$anasorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $anacek['hayvan_id']; ?>"><?php echo $anacek['hayvan_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="buzagiguncelle" class="btn btn-round btn-success">Kaydet</button>
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