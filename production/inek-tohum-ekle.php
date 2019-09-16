<?php 

      include 'header.php'; 
      #ayarları veritabanından çekme
      /*$hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id ORDER BY hayvan_kayittarihi ASC");
      $hayvansorgu->execute(array(
        'id' => $kullanici_id
        ));
      $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$hayvansorgu->rowCount();*/

      $irksorgu=$db->prepare("SELECT * FROM irk");
      $irksorgu->execute();
      #$irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);

      $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE hayvan_cinsiyet=0");
      $hayvansorgu->execute();

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>İnek Tohum Kaydı </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kayıt Ekle<small></small></h2>
                     <div class=" text-right">
                        <a href="inek-tohum.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">

                      <div class="form-group">

                           <label class="control-label col-md-3 col-sm-3 col-xs-12">İneğin Adı </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="hayvan_id">
                               <option value="">Hayvan seçin..</option>
                               <?php 
                                 while ($hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $hayvancek['hayvan_id']; ?>"><?php echo $hayvancek['hayvan_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                          </div>

                       <div class="form-group">
                            <!--
                            ****
                            **** Irkın seçili olarak gelmesini ayarla
                            ****
                             -->
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tohum Irk </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="inek_tohum_irk">
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
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tohum Tarihi 
                          </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="date" id="first-name" required="required" name="hayvan_tohumtarihi" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d') ?>">
                          </div>  
                        </div>

                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Açıklama 
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea type="text" id="first-name" name="inek_tohum_not" class="form-control col-md-7 col-xs-12" placeholder="Bu alana açıklama yazabilirsiniz.."></textarea>
                         </div>
                       </div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="inektohumekle" class="btn btn-round btn-success">Kaydet</button>
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