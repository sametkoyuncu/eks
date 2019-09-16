<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Giriş Yap </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/dayininciftligi.png">
    <link rel="apple-touch-icon" href="images/dayininciftligi.png">

    <!-- Aynı kullanıcı adı kontrolü -->
    <!--<script type="text/javascript">
      $(function(){
        $("input[name='kullanici_adi2']").keyup(function(){
          var kullanici_adi = $(this).val();
          $.ajax({  
              type: 'POST',  
              url: 'kullanici-sorgu.php', 
              data: { kullanici: kullanici_adi },
              success:function(sonuc){
                if (sonuc==1) {
                  alert("Bu kullanıcı adı kullanımda, lütfen başka bir kullanıcı adı giriniz.");
                } else {

                }
              }
          });

        });
      });
    </script>-->

     <!-- Aynı eposta adı kontrolü -->
    <script type="text/javascript">
      $(function(){
        $("input[name='kullanici_eposta2']").keyup(function(){
          var kullanici_eposta = $(this).val();
          $.ajax({  
              type: 'POST',  
              url: 'kullanici-sorgu.php', 
              data: { eposta: kullanici_eposta },
              success:function(sonuc){
                if (sonuc==1) {
                  alert("Bu eposta kullanımda, lütfen başka bir eposta giriniz.");
                } else {

                }
              }
          });

        });
      });
    </script>

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">

          <section class="login_content">
              <img src="images/dayininciftligi.png" style="width: 150px; height: auto;">
              <br>
              <br>
            <form action="../islem.php" method="POST">
              <h1>Kullanıcı Girişi</h1>
              <div>
                <input type="text" name="kullanici_adi" class="form-control" placeholder="Kullanıcı Adı" required="" class="input" style="border-radius: 50px;" />
              </div>
              <div>
                <input type="password" name="kullanici_sifre" class="form-control" placeholder="Şifre" required="" style="border-radius: 50px;"/>
              </div>
              <div>
                <button type="submit" name="kullanicigiris" class="btn btn-round btn-default" style="width: 100%;">Giriş</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              <!-- giriş çıkış bildirimleri -->
                <p style="color: #ff4040;"><?php 
                  if (isset($_GET['durum'])) {
                    if($_GET['durum']=='false') {
                      ?> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <br> <?php
                      echo "Giriş yapılamadı.." ?> 
                      <br> 
                      <?php echo "Lütfen bilgilerinizi kontrol edip tekrar deneyiniz."; ?>
                      <br>
                      <?php
                    } ?></p><p style="color: #33CC33;"> <?php if ($_GET['durum']=='exit') { ?>
                        <i class="fa fa-check" aria-hidden="true"></i><br>
                        <?php
                        echo "Başarı ile çıkış yapınız..";
                    }
                  }
                ?></p>
                <!-- Kayıt bildirimleri -->
                <p style="color: #33CC33;"><?php 
                  if (isset($_GET['kayit'])) {
                    if($_GET['kayit']=='true') {
                      ?> <i class="fa fa-check" aria-hidden="true"></i>
                      <br> 
                      <?php echo "Hesap oluşturuldu, giriş yapınız.." ?> 
                      <br> <?php
                    }
                  }
                ?></p>

                <!-- <p class="change_link"> 
                  <a class="" href="#">Şifremi unuttum</a> 
                  |&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="#signup" class="to_register"> Hesap Oluştur </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <!--<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>-->
                  2018 - <a href="http://www.ciftligimtakip.com">Koyuncu E.K.S.</a>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
          <img src="images/logo-yatay.svg" style="width: 150px; height: auto;">
              <br>
              <br>
            <form action="../islem.php" method="POST">
              <h1>Hesap Oluştur</h1>
              <div>
                <input type="text" class="form-control" name="kullanici_adi2" placeholder="Kullanıcı Adı" required="" style="border-radius: 50px;"  />
              </div>
              <div id="uyari">
                
              </div>
              <div>
                <input type="email" class="form-control" name="kullanici_eposta2" placeholder="E-posta" required="" style="border-radius: 50px;"  />
              </div>
              <div>
                <input type="password" class="form-control" name="kullanici_sifre" placeholder="Şifre" required="" style="border-radius: 50px;"  />
              </div>
              <div>
                <button type="submit" name="kayit" class="btn btn-round btn-default" style="width: 100%;">Kayıt</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <p class="change_link">Zaten üye misiniz?
                  <a href="#signin" class="to_register"> Giriş Yapın </a>
                </p>
                <div class="clearfix"></div>
                <br />

                <div>
                  <!--<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>-->
                  2017 - <a href="http://www.ciftligimtakip.com">Çiftliğim Takip</a>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>