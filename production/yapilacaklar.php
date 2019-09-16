<?php 
    include 'header.php'; 

    $issorgu=$db->prepare("SELECT * FROM isler WHERE kullanici_id=:id and isler_durum=1 ORDER BY isler_tarih DESC");
    $issorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$issorgu->rowCount();
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
                    <h2>Yapılacaklar</h2>
                    <div class=" text-right">
                    <button type="button" class="btn btn-round btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                      <i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle
                    </button>
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
                          <th class="col-md-7 col-sm-7">Yapılacaklar</th>
                          <th class="col-md-1 col-sm-1">Tarih</th>
                          <th class="col-md-1 col-sm-1">Durum</th>
                          <th class="col-md-3 col-sm-3" ></th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($iscek=$issorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $iscek['isler_aciklama']; ?></td>
                          <td class="col-md-2 col-sm-2">
                            <?php 
                                echo date("d.m.Y", strtotime($iscek["isler_tarih"]));
                            ?>
                          </td>
                          <td>
                          <?php 
                            if($iscek['isler_durum']=='1'){
                              echo "Bekleniyor";
                            }else{
                              echo "Tamamlandı";
                            }
                          ?>
                          </td>
                          <td class="text-center">
                            <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                              <input type="hidden" name="isler_durum" value="0">
                              <input type="hidden" name="isler_id" value="<?php echo $iscek['isler_id']; ?>">
                              <button type="submit" name="istamamla" class="btn btn-round btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Tamamlandı</button>
                              <a href="../islem.php?issil=true&isler_id=<?php echo $iscek['isler_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> İptal</a>
                            </form>    
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="../islem.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
              <div class="modal-body">
              
                      <input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id ?>">
                      <div class="form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Ne Yapmalısın? <span class="required">*</span>
                          </label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="first-name" required="required" name="isler_aciklama" class="form-control col-md-8 col-xs-12" placeholder="Yapmak istediğiniz şeyi yazınız..">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Ne Zaman Yapılmalı? 
                          </label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="date" id="first-name" required="required" name="isler_tarih" class="form-control col-md-3 col-xs-12" value="<?php echo date('Y-m-d') ?>">
                          </div>  
                      </div> 
              </div>
              <div class="modal-footer">
                <div class="col text-center">
                  <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Kapat</button>
                  <button type="submit" name="isekle" class="btn btn-round btn-success">Kaydet</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>

        <?php include 'footer.php'; ?>