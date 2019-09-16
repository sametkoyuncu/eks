<?php 
    include 'header.php'; 

    $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and buzagi_goster=1 ORDER BY hayvan_kayittarihi ASC");
    $hayvansorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$hayvansorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");
    
    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:k_id and hayvan_id=:h_id ORDER BY tartim_tarihi DESC");

    

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
                    <h2>Buzağı Doğum Kaydı</h2>
                    <div class=" text-right">
                      <a href="buzagi-dogum-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
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
                          <th class="">Doğum Tarihi</th>
                          <th class="">Adı</th>
                          <th class="">Annesi</th>
                          <th class="">Irk</th>
                          <th class="">Cinsiyet</th>
                          <th class="">Ayarlar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td class="col-md-2 col-sm-2">
                            <?php 
                                echo date("d.m.Y", strtotime($hayvancek["hayvan_dogumtarihi"]));
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                            <?php
                                echo $hayvancek['hayvan_adi'];
                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                            <?php
                              $ana_id = $hayvancek['ana_id'];

                              $anasorgu=$db->prepare("SELECT * FROM hayvan WHERE hayvan_id=:id");
                              $anasorgu->execute(array(
                                  'id' => $ana_id
                                  ));
                              $anacek=$anasorgu->fetch(PDO::FETCH_ASSOC);
                              
                              echo $anacek['hayvan_adi'];

                            ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
                            $irksorgu->execute(array(
                              'id' => $hayvancek['hayvan_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                          ?>
                          </td>
                          <td class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
                            if($hayvancek['hayvan_cinsiyet']=='1'){
                              echo "Erkek";
                            }else{
                              echo "Dişi";
                            }
                          ?>
                          </td>
                          
                          
                          <td class="text-center">
                            <!-- <a href="hayvan-profil.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a> -->
                            <a href="buzagi-dogum-duzenle.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?buzagisil=true&hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i> Sil</a>
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