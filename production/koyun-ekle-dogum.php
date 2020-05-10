<?php

include 'header.php';

$irksorgu = $db->prepare("SELECT * FROM irk_koyun");
$irksorgu->execute();

$padoksorgu = $db->prepare("SELECT * FROM padok");
$padoksorgu->execute();

$anasorgu = $db->prepare("SELECT * FROM koyun WHERE koyun_cinsiyet=0");
$anasorgu->execute();

$babasorgu = $db->prepare("SELECT * FROM koyun WHERE koyun_cinsiyet=1 and koyun_durum=1");
$babasorgu->execute();

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
            <h2>Koyun Ekle<small></small></h2>
            <div class=" text-right">
              <a href="koyunlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
            </div>
            <div class="clearfix"></div>
          </div>

          <?php
          if (isset($_GET['durum'])) {
            if ($_GET['durum'] == 'true') { ?>
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong></strong> İşlem başarıyla kaydedildi..
              </div>
            <?php } elseif ($_GET['durum'] == 'false') { ?>
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
              <input type="hidden" name="koyun_durum" value="1">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Annesi
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <select class="select2_group form-control" name="ana_id">
                    <option value="">Koyun seçin..</option>
                    <?php
                    while ($anacek = $anasorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $anacek['koyun_id']; ?>"><?php echo $anacek['koyun_adi']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Babası
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <select class="select2_group form-control" name="baba_id">
                    <option value="">Koç seçin..</option>
                    <?php
                    while ($babacek = $babasorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $babacek['koyun_id']; ?>"><?php echo $babacek['koyun_adi']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Irk </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <select class="select2_group form-control" required="required" name="koyun_irk">
                    <option value="">Irk seçin..</option>
                    <?php
                    while ($irkcek = $irksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $irkcek['irk_id']; ?>"><?php echo $irkcek['irk_adi']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Doğum Tarihi
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="date" id="first-name" required="required" name="koyun_dogumtarihi" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d') ?>">
                </div>
              </div>
              <hr><!-- ########################################### -->
              <div id="bunuAL">
                <div class="form-group">
                  <?php
                  ?>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Küpe Numarası <span class="required">*</span>
                  </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="first-name" name="koyun_kupeno[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="TR 34 1234567890">
                  </div>
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İşletme Küpe Numarası<span class="required">*</span>
                  </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="first-name" name="koyun_kupeno_isletme[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="43, 571, 1071..">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hayvan Adı
                  </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="first-name" name="koyun_adi[]" class="form-control col-md-7 col-xs-12" placeholder="Nazlı, Şimşek..">
                  </div>
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Cinsiyet </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <select name="koyun_cinsiyet[]" class="select2_group form-control" required="required" >
                      <?php
                      #if($koyuncek['koyun_cinsiyet']=='1') { 
                      ?>
                      <!--<option value="1">Erkek</option>
                                  <option value="0">Dişi</option>-->
                      <?php # } else { 
                      ?>
                      <option value="1">Erkek</option>
                      <option value="0">Dişi</option>
                      <?php #} 
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Not
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea type="text" id="first-name" name="koyun_not[]" class="form-control col-md-7 col-xs-12" placeholder="Doğum ağırlığı, doğum kolaylığı vb."></textarea>
                  </div>
                </div>
                <div class="form-group">

                  <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Canlı Ağırlık 
                         </label>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                           <input type="text" id="first-name" name="koyun_kilo" class="form-control col-md-7 col-xs-12" placeholder="000 kg">
                         </div>-->
                  <!--<label class="control-label col-md-2 col-sm-2 col-xs-12">Bölme </label>
                           <div class="col-md-2 col-sm-2 col-xs-12">
                             <select class="select2_group form-control" name="koyun_padok">
                               <option value="">Bölme seçin..</option>-->
                  <?php
                  #while ($padokcek=$padoksorgu->fetch(PDO::FETCH_ASSOC)) { 
                  ?>
                  <!-- <option value="<?php #echo $padokcek['padok_id']; 
                                      ?>"><?php #echo $padokcek['padok_adi']; 
                                          ?> (<?php #echo $padokcek['padok_aciklama']; 
                                            ?>) </option> -->
                  <?php
                  #} 
                  ?>
                  <!--</select>
                           </div>-->
                </div>
                <hr>
              </div>
              <div id="burayaYapistir"></div>

              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a onclick="ekle()" class="btn btn-round btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eğer kuzu tekiz değilse buradan yeni kuzu kaydı ekleyebilirsiniz."><i class="fa fa-plus" aria-hidden="true"></i> Yeni Kuzu Ekle</a>
                  <button type="submit" name="toplukoyunekle" class="btn btn-round btn-success">Kaydet</button>
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

<script type="text/javascript" language="javascript">
  function ekle() {
    var bunuAL = document.getElementById("bunuAL"); //div
    var burayaYapistir = document.getElementById("burayaYapistir"); //div

    burayaYapistir.appendChild(bunuAL.cloneNode(true));
  }
</script>

<?php include 'footer.php'; ?>