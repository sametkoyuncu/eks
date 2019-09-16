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

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kurbanlık Hayvan Ekle </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kayıt Ekle<small></small></h2>
                     <div class=" text-right">
                        <a href="kurban.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Küpe Numarası 
                         </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_kupeno" class="form-control col-md-7 col-xs-12" placeholder="Örn: TR340001234567" required>
                         </div>
                       <!-- </div>

                       <div class="form-group"> -->
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hayvan Adı 
                         </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_adi" class="form-control col-md-7 col-xs-12" placeholder="Hayvan adını giriniz.." required>
                         </div>
                       </div>
                       <div class="form-group">
                            <!--
                            ****
                            **** Irkın seçili olarak gelmesini ayarla
                            ****
                             -->
                           <label class="control-label col-md-2 col-sm-2 col-xs-12">Canlı Ağırlık </label>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_kilo" class="form-control col-md-7 col-xs-12" placeholder="Hayvanınız kaç kilo?." required>
                           </div>
                      <!--</div> 
                      <div class="form-group">-->
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Toplam Fiyat 
                          </label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" id="first-name" name="hayvan_satisfiyati" class="form-control col-md-7 col-xs-12" placeholder="12345 ₺" required>
                          </div>  
                        </div>

                      <div class="form-group">
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Durum 
                         </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                            <select id="heard" class="form-control"  name="hayvan_durum" required>
                              <option value="">Seçim yapın..</option>
                              <option value="1">Tek Hisse</option>
                              <option value="0">Hisse</option>
                            </select>
                          </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hisse Adedi 
                          </label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" id="first-name" name="hayvan_hisse_adedi" class="form-control col-md-2 col-xs-12" value="1">
                          </div>
                         </div> 
                        <div class="form-group">
                         <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Alıcı 
                         </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                           <input type="text" id="first-name" name="hayvan_alici" class="form-control" placeholder="Ad Soyad" required>
                         </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                      <!--</div>
                      <div class="form-group">-->
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Telefon 
                          </label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" id="first-name" required="required" name="hayvan_alici_tel" class="form-control col-md-2 col-xs-12" placeholder="05551234567" required>
                          </div>  
                        </div>

                      <div class="form-group">
                        <div align="right" class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                          <button type="submit" name="kurbanlikekle" class="btn btn-round btn-success">Kaydet</button>
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