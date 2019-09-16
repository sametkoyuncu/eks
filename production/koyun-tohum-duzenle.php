<?php 

      include 'header.php'; 
      #ayarları veritabanından çekme
      $inektohumsorgu=$db->prepare("SELECT * FROM inek_tohum WHERE kullanici_id=:id and inek_tohum_id=:inek_tohum_id");
      $inektohumsorgu->execute(array(
        'id' => $kullanici_id,
        'inek_tohum_id' => $_GET['inek_tohum_id']
        ));
      $inektohumcek=$inektohumsorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$inektohumsorgu->rowCount();

      $irksorgu=$db->prepare("SELECT * FROM irk");
      $irksorgu->execute();
      #$irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);

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
                    <h2>Düzenle<small></small></h2>
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
                      <input type="hidden" name="inek_tohum_id" value="<?php echo $inektohumcek['inek_tohum_id']; ?>">
                      <input type="hidden" name="hayvan_id" value="<?php echo $inektohumcek['hayvan_id']; ?>">
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
                            <?php $tohum_tarihi = $inektohumcek['hayvan_tohumtarihi']; ?>
                            <input type="date" id="first-name" required="required" name="hayvan_tohumtarihi" class="form-control col-md-3 col-xs-12" value="<?php echo date('d-m-Y',strtotime($tohum_tarihi)); ?>">
                          </div>  
                        </div>

                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Açıklama 
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea type="text" id="first-name" name="inek_tohum_not" class="form-control col-md-7 col-xs-12"><?php echo $inektohumcek['inek_tohum_not']; ?></textarea>
                         </div>
                       </div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="inektohumguncelle" class="btn btn-round btn-success">Kaydet</button>
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