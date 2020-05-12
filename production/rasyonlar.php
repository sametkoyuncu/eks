 <?php
  include 'header.php';
  include '../baglan.php';

  ?>
 <!-- page content -->
 <div class="right_col" role="main">
   <div class="">
     <div class="clearfix"></div>

     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
           <div class="x_title">
             <h2>Oluşturulan Rasyonlar</h2>
             <div class=" text-right">
               <a href="koyun-grup-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
             <!--***********************************-->
             <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="x_panel tile fixed_height_320 overflow_hidden">
                 <div class="x_title">
                   <h2>Rasyon Bilgisi</h2>
                   <div class=" text-right">
                     <a href="koyun-grup-duzenle.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-info btn-sm"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
                     <a href="../islem.php?koyungrupsil=true&koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
                   </div>
                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">
                   <table class="" style="width:100%">
                     <tbody>
                       <tr>
                         <th style="width:37%;">
                           <p>Rasyon</p>
                         </th>
                         <th>
                           <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                             <p class="">Yemler</p>
                           </div>
                           <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                             <p class="">Oran</p>
                           </div>
                         </th>
                       </tr>
                       <tr>
                         <td>
                           <iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                           <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0px; width: 140px; height: 140px;"></canvas>
                         </td>
                         <td>
                           <table class="tile_info">
                             <tbody>
                               <tr>
                                 <td>
                                   <p><i class="fa fa-square blue"></i>Arpa </p>
                                 </td>
                                 <td>30%</td>
                               </tr>
                               <tr>
                                 <td>
                                   <p><i class="fa fa-square green"></i>Buğday </p>
                                 </td>
                                 <td>10%</td>
                               </tr>
                               <tr>
                                 <td>
                                   <p><i class="fa fa-square purple"></i>Mısır Silajı </p>
                                 </td>
                                 <td>20%</td>
                               </tr>
                               <tr>
                                 <td>
                                   <p><i class="fa fa-square aero"></i>Vit-Min </p>
                                 </td>
                                 <td>15%</td>
                               </tr>
                               <tr>
                                 <td>
                                   <p><i class="fa fa-square red"></i>Tuz </p>
                                 </td>
                                 <td>30%</td>
                               </tr>
                             </tbody>
                           </table>
                         </td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
             <!--**************************************-->

             <!--********************************************-->
           </div>
         </div>
       </div>
     </div>

   </div>
 </div>
 <!-- /page content -->

 <!-- Chart.js -->
 <script src="../vendors/Chart.js/dist/Chart.min.js"></script>

 <!-- Flot -->
 <!--  <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>-->
 <!-- Flot plugins -->
 <!--<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>-->
 <!-- Chart.js -->
 <script src="../vendors/chart-script.js"></script>

 <?php include 'footer.php'; ?>