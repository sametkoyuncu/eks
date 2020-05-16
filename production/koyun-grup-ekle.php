<?php
include 'header.php';

$padoksorgu = $db->prepare("SELECT * FROM koyun_padok WHERE kullanici_id=:id");
$padoksorgu->execute(array(
  'id' => $kullanici_id
));

$rasyonsorgu = $db->prepare("SELECT * FROM rasyon WHERE kullanici_id=:id");
$rasyonsorgu->execute(array(
  'id' => $kullanici_id
));
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
            <h2>Yeni Grup Ekle<small></small></h2>
            <div class=" text-right">
              <a href="koyun-gruplari.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grup Adı
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="koyun_grup_adi" class="form-control col-md-7 col-xs-12" placeholder="Grup adını giriniz..">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Padok </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="select2_group form-control" name="koyun_padok_id">
                    <option value="">Padok yok..</option>
                    <?php
                    while ($padokcek = $padoksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $padokcek['koyun_padok_id']; ?>"><?php echo $padokcek['koyun_padok_adi'] . " - " . substr($padokcek['koyun_padok_not'], 0, 50) . ".."; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Rasyon </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="select2_group form-control" name="koyun_rasyon_id">
                    <option value="">Rasyon yok..</option>
                    <?php
                    while ($rasyoncek = $rasyonsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $rasyoncek['rasyon_id']; ?>"><?php echo $rasyoncek['rasyon_adi'] . " - " . substr($rasyoncek['rasyon_aciklama'], 0, 50) . ".."; ?></option>
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
                  <textarea type="text" id="first-name" name="koyun_grup_not" class="form-control col-md-7 col-xs-12" placeholder="Besilik kuzuların olduğu grup vb."></textarea>
                </div>
              </div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="koyungrupekle" class="btn btn-round btn-success">Kaydet</button>
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