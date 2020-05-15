<?php 
    include 'header.php'; 

    $yemsorgu=$db->prepare("SELECT * FROM yem WHERE kullanici_id=:id");
    $yemsorgu->execute(array(
      'id' => $kullanici_id
      ));

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yemler</h2>
                    <div class=" text-right">
                      <a href="yem-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
                    </div>
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
                          <th class="">Ad</th>
                          <th class="">Yem Tipi</th>
                          <th class="col-md-2 col-sm-2 col-xs-12">Depodaki Miktar</th>
                          <th class="">Birim</th>
                          <th class="col-md-2 col-sm-2 col-xs-12"></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($yemcek=$yemsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $yemcek['yem_adi']; ?></td>
                          <td>
                            <?php 
                              if($yemcek['yem_tipi'] == 1){
                                echo "Kesif Yem";
                              } elseif($yemcek['yem_tipi'] == 2){ 
                                echo "Kaba Yem";
                              } elseif($yemcek['yem_tipi'] == 3){ 
                                echo "Yem Katkı Maddesi";
                              }
                            ?>
                          </td>
                          <td><?php echo $yemcek['yem_miktari']; ?></td>
                          <td>
                            <?php
                              $birimsorgu=$db->prepare("SELECT * FROM birim WHERE birim_id=:id");
                              $birimsorgu->execute(array(
                                'id' => $yemcek['yem_birimi']
                                ));
                              $birimcek=$birimsorgu->fetch(PDO::FETCH_ASSOC);
                              echo $birimcek['birim_adi']; 
                            ?>
                          </td>
                          <td class="text-center">
                            <!--<a href="yem-duzenle.php?yem_id=<?php echo $yemcek['yem_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>-->
                            <a href="../islem.php?yemsil=true&yem_id=<?php echo $yemcek['yem_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
                          </td>
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