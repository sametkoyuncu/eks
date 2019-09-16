 <?php 
    include 'header.php';

    /*$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici");
    $kullanicisorgu->execute(array(
        'kullanici' => $_SESSION['kullanici_adi']
      ));
    $kullanicicek=$kullanicisorgu->fetch(PDO::FETCH_ASSOC);*/
    #$sayac=$iceriksorgu->rowCount();
  ?>  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Arama yap..">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ara!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profil Bilgileri </h2>
                    <div class=" text-right">
                      <a href="profil-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>" class="btn btn-round btn-info btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Profili Düzenle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
						        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <img src="<?php echo $kullanicicek['kullanici_gorsel']; ?>" alt="" style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 5px solid rgba(255,255,255,0.5);" >
                      <br>
                      <?php echo $kullanicicek['kullanici_adsoyad']; ?>
                      <br>
                      @<?php echo $kullanicicek['kullanici_adi']; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hareketler Dökümü </h2>

                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>