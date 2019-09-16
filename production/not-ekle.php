<?php 

      include 'header.php'; 
      
?>
<head>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
</head>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Notlar </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yeni Not Ekle<small></small></h2>
                     <div class=" text-right">
                        <a href="notlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form action="../islem.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
                      <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="first-name" required="required" name="not_baslik" class="form-control col-md-8 col-xs-12" placeholder="Bir başlık giriniz..">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Not <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="not_aciklama"></textarea> 
                            <script>
                                CKEDITOR.replace( 'not_aciklama' );
                            </script>
                          </div>
                        </div>
                      
                        <div class="form-group">
                        <div align="right" class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                          <button type="submit" name="notekle" class="btn btn-round btn-success">Kaydet</button>
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