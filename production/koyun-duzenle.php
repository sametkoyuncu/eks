<?php 

      include 'header.php'; 
      include '../baglan.php';
      #ayarları veritabanından çekme
      $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
      $koyunsorgu->execute(array(
        'id' => $kullanici_id,
        'koyun_id' => $_GET['koyun_id']
        ));
      $koyuncek=$koyunsorgu->fetch(PDO::FETCH_ASSOC);

      $sayac=$koyunsorgu->rowCount();

      $irksorgu=$db->prepare("SELECT * FROM irk_koyun");
      $irksorgu->execute();

      $irkadisorgu=$db->prepare("SELECT * FROM irk_koyun WHERE irk_id=:id");
      $irkadisorgu->execute(array(
        'id' => $koyuncek['koyun_irk']
        ));
      $irkadicek=$irkadisorgu->fetch(PDO::FETCH_ASSOC);
      #koyunun ait olduğu gruğ bilgisi
      $koyungrupsorgu=$db->prepare("SELECT * FROM koyun_grup WHERE koyun_grup_id=:id");
      $koyungrupsorgu->execute(array(
        'id' => $koyuncek['koyun_grup_id']
        ));
      $koyungrupcek=$koyungrupsorgu->fetch(PDO::FETCH_ASSOC);
      #liste için tüm gruplar
      $grupsorgu=$db->prepare("SELECT * FROM koyun_grup");
      $grupsorgu->execute();

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Koyunlar </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Koyun Düzenle<small></small></h2>
                     <div class=" text-right">
                        <a href="koyunlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id; ?>">
                      <input type="hidden" name="koyun_id" value="<?php echo $koyuncek['koyun_id']; ?>">
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Devlet Küpe Numarası <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="first-name" name="koyun_kupeno" class="form-control col-md-7 col-xs-12" value="<?php echo $koyuncek['koyun_kupeno']; ?>">
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İşletme Küpe Numarası <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="first-name" name="koyun_kupeno_isletme" class="form-control col-md-7 col-xs-12" value="<?php echo $koyuncek['koyun_kupeno_isletme']; ?>">
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Koyun Adı 
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="first-name" name="koyun_adi" class="form-control col-md-7 col-xs-12" value="<?php echo $koyuncek['koyun_adi']; ?>" placeholder="Belirtilmemiş..">
                         </div>
                       </div>
                       <div class="form-group">
                            <!--
                            ****
                            **** Irkın seçili olarak gelmesini ayarla
                            ****
                             -->
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Irk* </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" required="required" name="koyun_irk">
                               <option value="<?php echo $koyuncek['koyun_irk']; ?>"><?php echo $irkadicek['irk_adi']; ?></option>
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
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Cinsiyet* </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <select class="select2_group form-control" required="required" name="koyun_cinsiyet">
                              <?php 
                                if($koyuncek['koyun_cinsiyet']=='1') { ?>
                                  <option value="1">Erkek</option>
                                  <option value="0">Dişi</option>
                                <?php } else { ?> 
                                  <option value="0">Dişi</option>
                                  <option value="1">Erkek</option>
                                <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <div>
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alış Fiyatı 
                         </label>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                           <input type="text" id="first-name" name="koyun_alisfiyati" class="form-control" value="<?php echo $koyuncek['koyun_alisfiyati']; ?>">
                         </div>
                         <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>
                        </div>
                        <div>
                          <label class="control-label col-md-1 col-sm-1 col-xs-12">Durum* </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <select class="select2_group form-control" required="required" name="koyun_durum">
                              <?php 
                                if($koyuncek['koyun_durum']=='1') { ?>
                                  <option value="1">Mevcut</option>
                                  <option value="2">Satıldı</option>
                                  <option value="3">Öldü</option>
                                <?php } elseif($koyuncek['koyun_durum']=='2') { ?>
                                  <option value="2">Satıldı</option> 
                                  <option value="1">Mevcut</option>
                                  <option value="3">Öldü</option>
                                <?php } else { ?>
                                  <option value="3">Öldü</option> 
                                  <option value="1">Mevcut</option>
                                  <option value="2">Satıldı</option>
                                <?php  } ?>
                            </select>
                          </div>
                       </div>
                      </div>
                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satış Fiyatı 
                         </label>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                           <input type="text" id="first-name" name="koyun_satisfiyati" class="form-control" value="<?php echo $koyuncek['koyun_satisfiyati']; ?>">
                         </div>
                         <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>
                         <label class="control-label col-md-1 col-sm-1 col-xs-12">Nitelik* </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <select class="select2_group form-control" required="required" name="koyun_nitelik">
                              <?php 
                                if($koyuncek['koyun_nitelik']=='1') { ?>
                                  <option value="1">Damızlık</option>
                                  <option value="2">Adaklık</option>
                                  <option value="3">Kurbanlık</option>
                                  <option value="4">Kasaplık</option>
                                <?php } elseif($koyuncek['koyun_nitelik']=='2') { ?>
                                  <option value="2">Adaklık</option>
                                  <option value="1">Damızlık</option>
                                  <option value="3">Kurbanlık</option>
                                  <option value="4">Kasaplık</option>
                                <?php } elseif($koyuncek['koyun_nitelik']=='3') { ?>
                                  <option value="3">Kurbanlık</option>
                                  <option value="1">Damızlık</option>
                                  <option value="2">Adaklık</option>
                                  <option value="4">Kasaplık</option>
                                <?php  } elseif($koyuncek['koyun_nitelik']=='4') { ?>
                                  <option value="4">Kasaplık</option>
                                  <option value="1">Damızlık</option>
                                  <option value="2">Adaklık</option>
                                  <option value="3">Kurbanlık</option>
                                <?php } else { ?>
                                  <option value="">Bir nitelik seçiniz..</option>
                                  <option value="1">Damızlık</option>
                                  <option value="2">Adaklık</option>
                                  <option value="3">Kurbanlık</option>
                                  <option value="4">Kasaplık</option>
                                <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                            <!--
                            ****
                            **** Grubun seçili olarak gelmesini ayarla
                            ****
                             -->
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Grup </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control"  name="koyun_grup_id">
                               <option value="<?php echo $koyuncek['koyun_grup_id']; ?>"><?php echo $koyungrupcek['koyun_grup_adi']; ?></option>
                               <?php 
                                 while ($grupcek=$grupsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                     <option value="<?php echo $grupcek['koyun_grup_id']; ?>"><?php echo $grupcek['koyun_grup_adi']; ?></option>
                                <?php
                                 } 
                                ?>
                             </select>
                           </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Not 
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="first-name" name="koyun_not" class="form-control col-md-7 col-xs-12" value="<?php echo $koyuncek['koyun_not']; ?>" placeholder="Belirtilmemiş..">
                         </div>
                       </div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="koyunguncelle" class="btn btn-round btn-success">Kaydet</button>
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