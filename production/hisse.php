 <?php 
    include 'header.php';

    /*$kullanicisorgu=$db->prepare("SELECT * FROM kullanici WHERE kullanici_adi=:kullanici");
    $kullanicisorgu->execute(array(
        'kullanici' => $_SESSION['kullanici_adi']
      ));
    $kullanicicek=$kullanicisorgu->fetch(PDO::FETCH_ASSOC);*/
    
    $hayvansorgu=$db->prepare("SELECT * FROM kurbanlik_hayvanlar WHERE hayvan_id=:id ORDER BY hayvan_kayittarihi ASC");
    $hayvansorgu->execute(array(
        'id' => $_GET['hayvan_id']
        ));
    $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);
    
    $hissesorgu=$db->prepare("SELECT * FROM hisse WHERE hayvan_id=:id ORDER BY hayvan_kayittarihi ASC");
    $hissesorgu->execute(array(
        'id' => $_GET['hayvan_id']
        ));

    #$sayac=$iceriksorgu->rowCount();
  ?>  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> </h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Arama yap..">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ara!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hayvan Bilgileri </h2>
                    <div class=" text-right" id="yazdirma">
                      
                      <button class="btn btn-round btn-default" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
                      <a href="kurban.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                      <a href="kurbanlik-duzenle.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-info btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  <div class="col-md-3">
                      <label class="text-right" for="first-name">Küpe No: </label>
                      <text class="text-left" for="first-name"><?php echo $hayvancek['hayvan_kupeno']; ?> </text>
                    </div>

                    <div class="col-md-3">
                      <label class="text-right" for="first-name">Hayvan Adı: </label>
                      <text class="text-left" for="first-name"><?php echo $hayvancek['hayvan_adi']; ?> </text>
                    </div>
                    
                    <div class="col-md-3">
                      <label class="text-right" for="first-name">Hisse Fiyatı: </label>
                      <?php
                        $hisse_fiyati = $hayvancek['hayvan_satisfiyati']/$hayvancek['hayvan_hisse_adedi'];
                      ?>
                      <text class="text-left" for="first-name"><?php echo number_format($hisse_fiyati,2,",",".")." ₺"; ?> </text>
                    </div>

                    <div class="col-md-3">
                      <label class="text-right" for="first-name">Toplam Fiyat: </label>
                      <text class="text-left" for="first-name"><?php echo $hayvancek['hayvan_satisfiyati']." ₺"; ?> </text>
                    </div>

                  </div>


                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="">Hisseler</h2>
                    <div class=" text-right"  id="yazdirma">
                      
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
                          <th class="">Sıra</th>
                          <th class="">Ad Soyad</th>
                          <th class="">Telefon</th>
                          <th class="">Ödenen</th>
                          <th class="">Kalan</th>
                          <th class=""  id="yazdirma">Ayarlar</th>
                        </tr>
                      </thead>

                      <?php $sira=1; ?>

                      <tbody>
                      <?php while ($hayvancek=$hissesorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php $kalan = $hayvancek['hisse_toplam']-$hayvancek['hisse_odenen'] ?>
                        <tr>
                          <td class="col-md-1 text-center <?php if($kalan=='0') { echo "bg-success";} ?> ">
                            <?php 
                                echo $sira;
                                $sira++;
                            ?>
                          </td>
                          <td class="<?php if($kalan=='0') { echo "bg-success";} ?>">
                            <?php 
                                echo $hayvancek['hisse_alici'];
                            ?>
                          </td>
                          <td class="<?php if($kalan=='0') { echo "bg-success";} ?>">
                            <?php
                                echo $hayvancek['hisse_alici_tel'];
                            ?>
                          </td>
                          <td class="<?php if($kalan=='0') { echo "bg-success";} ?>">
                            <?php
                              echo $hayvancek['hisse_odenen']." ₺";
                            ?>
                          </td>
                          
                          <td class="<?php if($kalan=='0') { echo "bg-success";} ?>">
                            <?php
                              echo $kalan." ₺";
                            ?>
                          </td>
                          <td class=" text-center <?php if($kalan=='0') { echo "bg-success";} ?>" id="yazdirma">
                            <a href="hissedar-duzenle.php?hisse_id=<?php echo $hayvancek['hisse_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
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
        
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hissedar Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="../../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
                      <input type="hidden" name="hayvan_id" value="<?php echo $hayvancek['hayvan_id']; ?>">
                        
                      <div class="form-group">
                         <label class="control-label col-md-2" for="first-name">Alıcı 
                         </label>
                         <div class="col-md-9">
                           <input type="text" id="first-name" name="hayvan_alici" class="form-control" value="<?php echo $hayvancek['hisse_alici'] ?>" required>
                         </div>
                         <!--<label class="control-label col-md-1 col-sm-1 col-xs-12 text-left"> ₺</label>-->
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-2" for="first-name">Telefon 
                          </label>
                          <div class="col-md-9">
                            <input type="text" id="first-name" required="required" name="hayvan_alici_tel" class="form-control col-md-2 col-xs-12" value="<?php echo $hayvancek['hisse_alici_tel'] ?>" required>
                          </div>  
                        </div>

                       <div class="form-group">
                          <label class="control-label col-md-2" for="first-name">Ödenen 
                          </label>
                          <div class="col-md-9">
                            <input type="text" id="first-name" required="required" name="hayvan_alici_tel" class="form-control col-md-2 col-xs-12" value="<?php echo $hayvancek['hisse_odenen'] ?>" required>
                          </div>  
                        </div> 

                      </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="submit" name="kurbanlikguncelle" class="btn btn-round btn-success">Kaydet</button>
              </div>
            </div>
          </div>
        </div>

        <?php include 'footer.php'; ?>