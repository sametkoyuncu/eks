<?php 
    include 'header.php';
    #
    $muhasebesorgu=$db->prepare("SELECT * FROM muhasebe WHERE kullanici_id=:id");
    $muhasebesorgu->execute(array(
        'id' => $kullanici_id
        ));
    #
    #
    #
    #gelir sütununun toplanması
    $gelirsorgu=$db->prepare("SELECT sum(muhasebe_gelir) AS gelir FROM muhasebe WHERE kullanici_id=:id");
    $gelirsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $gelircek=$gelirsorgu->fetch(PDO::FETCH_ASSOC);
    #
    #gider sütununun toplanması
    $gidersorgu=$db->prepare("SELECT sum(muhasebe_gider) AS gider FROM muhasebe WHERE kullanici_id=:id");
    $gidersorgu->execute(array(
        'id' => $kullanici_id
        ));
    $gidercek=$gidersorgu->fetch(PDO::FETCH_ASSOC);
    #
?>

        <!-- page content -->
        <div class="right_col" role="main">

          <!-- top tiles -->
          <div class="row tile_count text-right">

              <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><!--<i class="fa fa-user">--></i>Gelir</span>
                <div class="count"><?php echo $gelircek['gelir']; ?></div>
                <span class="count_bottom"><i class="green"></i>₺</span>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><!--<i class="fa fa-user">--></i>Gider</span>
                <div class="count"><?php echo $gidercek['gider']; ?></div>
                <span class="count_bottom"><i class="green"></i>₺</span>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><!--<i class="fa fa-user">--></i>Toplam</span>
                <div class="count"><?php echo $gelircek['gelir']-$gidercek['gider']; ?></div>
                <span class="count_bottom"><i class="green"></i>₺</span>
              </div>

           </div>  
          <!-- /top tiles -->
          
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Muhasebe Kayıtları</h2>
                    <!--<div class=" text-right">
                      <a href="yemkayit-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
                    </div>-->
                    <div class="clearfix"></div>
                  </div>

                  <?php
                  if(isset($_GET['durum'])){
                    if ($_GET['durum']=='true') { ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong></strong> İşlem başarıyla kaydedildi..
                      </div>
                    <?php } elseif ($_GET['durum']=='false') { ?>
                      <div class="alert alert-danger alert-dismissible fade in" role="alert" style="color: #fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>HATA!</strong> İşlem kaydedilemedi, lütfen tekrar deneyiniz. Sorunun devam etmesi halinde site yöneticisi ile irtibata geçin..
                      </div>
                    <?php }
                    } ?>

                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="">Id</th>
                          <th class="">Açıklama</th>
                          <th class="">Gelir</th>
                          <th class="">Gider</th>
                          <th class="">Kayıt Tarihi</th>
                          <!--<th class=""></th>-->
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($muhasebecek=$muhasebesorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          
                          <td class="col-md-1 col-sm-1"><?php echo $muhasebecek['muhasebe_id']; ?></td>
                          <td class=""><?php echo $muhasebecek['muhasebe_aciklama']; ?></td>
                          <td class="green">
                            <?php 
                              if ($muhasebecek['muhasebe_gelir']>0) {
                                echo $muhasebecek['muhasebe_gelir']." ₺";
                              } else {
                                echo "Yok";
                              }
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 red"><?php echo $muhasebecek['muhasebe_gider']." ₺"; ?></td>
                          <td class="col-md-2 col-sm-2"><?php echo $muhasebecek['muhasabe_kayittarihi']; ?></td>
                          <!--<td class="col-md-2 col-sm-2 text-center">
                            <a href="muhasebe-duzenle.php?muhasebe_id=<?php echo $muhasebecek['muhasebe_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>
                            <a href="../../islem.php?muhasebesil=true&muhasebe_id=<?php echo $muhasebecek['muhasebe_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</a>
                          </td>-->
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>