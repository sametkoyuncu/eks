 <?php 
    include 'header.php';
    include '../baglan.php';

    $hayvansorgu=$db->prepare("SELECT * FROM hayvan WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
    $hayvansorgu->execute(array(
      'id' => $kullanici_id,
      'hayvan_id' => $_GET['hayvan_id']
      ));
    $hayvancek=$hayvansorgu->fetch(PDO::FETCH_ASSOC);

    $sayac=$hayvansorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");

    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:id and hayvan_id=:hayvan_id");
    $tartimsorgu->execute(array(
      'id' => $kullanici_id,
      'hayvan_id' => $_GET['hayvan_id']
      ));
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
                    <h2><?php echo $hayvancek['hayvan_kupeno'] ?> Küpeli Hayvan Bilgileri </h2>
                    <div class=" text-right">
                      <a href="hayvanlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                     
                      <a href="hayvan-duzenle.php?hayvan_id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      <img src="../images/hayvan/<?php echo $hayvancek['hayvan_irk']; ?>.jpg" alt="" style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 5px solid rgba(255,255,255,0.5);" >
                      <br>
                      <?php 
                            echo "<b>Adı:</b> ";
                            if(strlen($hayvancek['hayvan_adi'])>0){
                              echo $hayvancek['hayvan_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php echo "<b>Küpe Numarası:</b> ".$hayvancek['hayvan_kupeno']; ?>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <?php 
                            echo "<b>Doğum Tarihi:</b> ";
                            if(strlen($hayvancek['hayvan_dogumtarihi'])>0){
                              echo $hayvancek['hayvan_dogumtarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Ölüm Tarihi:</b> ";
                            if(strlen($hayvancek['hayvan_olumtarihi'])>0){
                              echo $hayvancek['hayvan_olumtarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Alış Tarihi:</b> ";
                            if(strlen($hayvancek['hayvan_alistarihi'])>0){
                              echo $hayvancek['hayvan_alistarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Satış Tarihi:</b> ";
                            if(strlen($hayvancek['hayvan_satistarihi'])>0){
                              echo $hayvancek['hayvan_satistarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <?php 
                            echo "<b>Irk:</b> ";
                            if($hayvancek['hayvan_irk']){
                              $irksorgu->execute(array(
                              'id' => $hayvancek['hayvan_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Alış Fiyatı:</b> ";
                            if($hayvancek['hayvan_alisfiyati']>0){
                              echo $hayvancek['hayvan_alisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Satış Fiyatı:</b> ";
                            if($hayvancek['hayvan_satisfiyati']>0){
                              echo $hayvancek['hayvan_satisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      <br>
                      <?php 
                            echo "<b>Durum:</b> ";
                            if($hayvancek['hayvan_durum']){
                              if($hayvancek['hayvan_durum']=='1'){
                                echo "Mevcut";
                              }elseif ($hayvancek['hayvan_durum']=='2') {
                                echo "Satıldı";
                              }else{
                                echo "Öldü";
                              }
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12 text-center">
                    </div>
                    <br>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tartım Geçmişi </h2>
                    <div class=" text-right">
                      <a href="tartim-ekle.php?id=<?php echo $hayvancek['hayvan_id']; ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tartım Ekle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-3 col-sm-3">Tartım Zamanı</th>
                          <th class="col-md-1 col-sm-1">Kilo</th>
                          <th class="">Açıklama</th>
                          <th ></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($tartimcek=$tartimsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $tartimcek['tartim_tarihi']; ?></td>
                          <td><?php echo $tartimcek['tartim_kilo']." kg"; ?></td>
                          <td><?php echo $tartimcek['tartim_aciklama']; ?></td>
                          <td class="col-md-1 col-sm-1 text-center">
                            <a href="../islem.php?tartimsil=true&tartim_id=<?php echo $tartimcek['tartim_id']; ?>&hayvan_id=<?php echo $tartimcek['hayvan_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</a>
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
<!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
        <?php include 'footer.php'; ?>