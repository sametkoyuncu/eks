<?php

include 'header.php';
// include '../../baglan.php';

$birimsorgu = $db->prepare("SELECT * FROM birim");
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
              <a href="yemler.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="yem_adi" class="form-control col-md-7 col-xs-12" placeholder="Yemin adını giriniz..">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Birimi </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <select class="select2_group form-control" required="required" name="yem_birimi">
                    <option value="">Birim seçiniz..</option>
                    <?php
                    while ($birimcek = $birimsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $birimcek['birim_id']; ?>"><?php echo $birimcek['birim_adi']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <a class="btn btn-round btn-default btn-xs" href="birim-ekle.php"><i class="fa fa-plus" aria-hidden="true"></i> Listede yok mu? Yeni ekle..</a>
              </div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="yemekle" class="btn btn-round btn-success">Kaydet</button>
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