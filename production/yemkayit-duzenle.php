<?php 

      include 'header.php'; 
      include '../../baglan.php';
      #ayarları veritabanından çekme
      /*$hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id ORDER BY hayvan_kayittarihi ASC");
      $hayvansorgu->execute(array(
        'id' => $kullanici_id
        ));
      $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$hayvansorgu->rowCount();*/

      $yemsorgu=$db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yemkayit_id=:yem_id");
      $yemsorgu->execute(array(
        'id' => $kullanici_id,
        'yem_id' => $_GET['id']
        ));

      $birimsorgu=$db->prepare("SELECT * FROM birim");
      $birimsorgu->execute();
      #$irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Yem Kayıtları </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yeni Kayıt Ekle<small></small></h2>
                     <div class=" text-right">
                        <a href="" class="btn btn-round btn-warning btn-sm" onClick="history.go(-1)"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
                      <div class="form-group">
                           <label class="control-label col-md-2 col-sm-2 col-xs-12">Yem </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="yemkayit_adi">
                               <option value="">Yemi seçiniz..</option>
                               <?php 
                                 while ($yemcek=$yemsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $yemcek['yem_id']; ?>"><?php echo $yemcek['yem_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                           <label class="control-label col-md-2 col-sm-2 col-xs-12"><a href="">Yeni yem ekle..</a></label>
                      <!--</div>
                      <div class="form-group">-->
                           <label class="control-label col-md-1 col-sm-1 col-xs-12">Birimi </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="yemkayit_birimi">
                               <option value="">Birim seçiniz..</option>
                               <?php 
                                 while ($birimcek=$birimsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $birimcek['birim_id']; ?>"><?php echo $birimcek['birim_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                           <label class="control-label col-md-2 col-sm-2 col-xs-12"><a href="">Yeni birim ekle..</a></label>
                      </div>
                     
                      <div class="form-group">
                        <div>
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Miktarı 
                         </label>
                         <div class="col-md-1 col-sm-1 col-xs-12">
                           <input type="text" id="first-name" name="yemkayit_miktari" class="form-control" required="required" placeholder="0000">
                         </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                        </div>
                        <div>
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Birim Fiyatı 
                         </label>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                           <input type="text" id="first-name" name="yemkayit_birimfiyati" class="form-control" placeholder="0000 ₺" ">
                         </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                       </div>
                      <!--</div>
                      <div class="form-group">-->
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Alış Tarihi 
                          </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="date" id="first-name" required="required" name="yemkayit_alistarihi" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d') ?>">
                          </div>  
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2  col-xs-12" for="first-name">Açıklama
                           </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="yemkayit_aciklama" class="col-md-12 col-sm-12 col-xs-12" placeholder="İsterseniz buraya açıklama girebilirsiniz.."></textarea>
                          </div>  
                        </div>
                        <div class="form-group">
                        <div align="right" class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                          <button type="submit" name="yemkayitekle" class="btn btn-round btn-success">Kaydet</button>
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