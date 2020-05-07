<?php
include 'header.php';

$koyungrupsorgu = $db->prepare("SELECT * FROM koyun_grup WHERE kullanici_id=:id and koyun_grup_id=:koyun_grup_id");
$koyungrupsorgu->execute(array(
  'id' => $kullanici_id,
  'koyun_grup_id' => $_GET['koyun_grup_id']
));
$koyungrupcek = $koyungrupsorgu->fetch(PDO::FETCH_ASSOC);
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
            <h2>Yeni Grup Düzenle<small></small></h2>
            <div class=" text-right">
              <a href="koyun-gruplari.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
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
              <input type="hidden" name="koyun_grup_id" value="<?php echo $koyungrupcek['koyun_grup_id']; ?>">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grup Adı
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="koyun_grup_adi" class="form-control col-md-7 col-xs-12" value="<?php echo $koyungrupcek['koyun_grup_adi']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Not
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="koyun_grup_not" class="form-control col-md-7 col-xs-12" value="<?php echo $koyungrupcek['koyun_grup_not']; ?>">
                </div>
              </div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="koyungrupguncelle" class="btn btn-round btn-success">Kaydet</button>
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