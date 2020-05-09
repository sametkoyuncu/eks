<?php
include 'header.php';
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
            <h2>Yeni Padok Ekle<small></small></h2>
            <div class=" text-right">
              <a href="koyun-padoklari.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Padok Adı
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="koyun_padok_adi" class="form-control col-md-7 col-xs-12" placeholder="Padok adını giriniz..">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Not
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea type="text" id="first-name" name="koyun_padok_not" class="form-control col-md-7 col-xs-12" placeholder="Besilik kuzuların olduğu padok vb."></textarea>
                </div>
              </div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="koyunpadokekle" class="btn btn-round btn-success">Kaydet</button>
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