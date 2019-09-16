<?php 
  #ob_start();
  session_start();

  if (empty($_SESSION['kullanici_adi'])) {
      header("Location:hesap.php");
  }
 if ($_SESSION['kullanici_yetki'] != '2') {
      header("Location:hesap.php");
  }

  include '../functions.php';
  date_default_timezone_set('Europe/Istanbul');
  setlocale(LC_TIME,"Turkish");

  include '../baglan.php';

  $kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici");
  $kullanicisorgu->execute(array(
        'kullanici' => $_SESSION['kullanici_adi']
      ));
  $kullanicicek=$kullanicisorgu->fetch(PDO::FETCH_ASSOC);
  $kullanici_id=$kullanicicek['kullanici_id'];
 ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Koyuncu Ev Kayıt Sistemi </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    <!-- Print css -->
    <link rel="stylesheet" href="css/style-print.css" media="print" type="text/css">




    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="../build/css/main.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/dayininciftligi.png">
    <link rel="apple-touch-icon" href="images/dayininciftligi.png">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
           <!-- <div class="navbar nav_title" style="border: 0;">
              <br>
               <a href="index.php" class="site_title"><img src="../images/logo-kare.svg" style="width: 45px; height:auto;"><span> Koyuncu E.K.S.</span></a>
              <a href="index.php" class="site_title text-center"><img src="images/logo.png" style="height:25px"></a>
            </div>-->
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa"><img src="../images/eks-genel/eks-logo-ikon.png" width="40px" height="auto" alt=""></i> <span><img src="images/logo.png" style="margin-left:20px"alt=""></span></a>
            </div>
            <div class="clearfix"></div>

            

            <?php include 'sidebar.php'; ?>

            

        <!-- top navigation -->
        <div class="top_nav"  id="yazdirma">
          <div class="nav_menu">
            <nav class="">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $kullanicicek['kullanici_gorsel']; ?>" alt=""><?php echo $_SESSION['kullanici_adi'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profil.php"> Profili Görüntüle</a></li>
                    <li><a href="profil-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"> Profili Düzenle</a></li>
                    <li><a href="">Yardım</a></li>
                    <li><a href="cikis.php"><i class="fa fa-sign-out-alt pull-right"></i> Çıkış Yap</a></li>
                  </ul>
                </li>

                <!--<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>-->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->