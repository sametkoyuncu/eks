<?php

include 'header.php';

$yemsorgu = $db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yem_tipi=:tip");
$yemsorgu->execute(array(
  'id' => $kullanici_id,
  'tip' => 1
));


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yeni Satın Alım Ekle<small></small></h2>
            <div class=" text-right">
              <a href="yem-kayit.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
            <label class="control-label col-md-12 col-sm-12 col-xs-12 text-center" for="first-name">Eklenecek yem listede yok ise <a class="btn btn-round btn-dark btn-xs" href="yemler.php"><i class="fa fa-plus" aria-hidden="true"></i> Buradan yeni yem ekleyebilirsiniz..</a>
            </label>
            <br>
            <hr>

            <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
              <div id="tekrarEdecekKisim">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Yemin Adı </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <select class="select2_group form-control" required="required" name="yemkayit_adi[]">
                      <option value="">Yem seçin..</option>
                      <?php
                      while ($yemcek = $yemsorgu->fetch(PDO::FETCH_ASSOC)) {?>
                        <option value="<?php echo $yemcek['yem_id']; ?>"><?php echo $yemcek['yem_adi']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Miktar (kilogram)
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="first-name" min="0" name="yemkayit_miktari[]" class="form-control" required="required" placeholder="125 kg">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Birim Fiyat
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" step="0.01"  min="0" id="first-name" name="yemkayit_birimfiyati[]" class="form-control"  required="required" placeholder="12,50 ₺">
                  </div>
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Açıklama
                  </label>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="first-name" name="yemkayit_aciklama[]" class="form-control" placeholder="Not yazabilirsiniz..">
                  </div>
                </div>
                <hr>
              </div>
              <div id="burayaYapistir"></div>
              <div class="form-group">
                <div align="right" class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                <a onclick="ekle()" class="btn btn-round btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Çoklu alım yaptıysanız, yeni alım ekleyebilirsiniz."><i class="fa fa-plus" aria-hidden="true"></i> Yeni Alım Ekle</a>
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

<script type="text/javascript" language="javascript">
  function ekle() {
    var bunuAL = document.getElementById("tekrarEdecekKisim"); //div
    var burayaYapistir = document.getElementById("burayaYapistir"); //div

    burayaYapistir.appendChild(bunuAL.cloneNode(true));
  }
</script>

<?php include 'footer.php'; ?>