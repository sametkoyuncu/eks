<?php 
    include 'header.php'; 

    $abonesorgu=$db->prepare("SELECT * FROM aboneler WHERE kullanici_id=:id");
    $abonesorgu->execute(array(
        'id' => 5
        ));
    $sayac=$abonesorgu->rowCount();
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
                    <h2>Haber Bülteni Abone Listesi</h2>
                    
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
                          <th class="">E Posta</th>
                          <th class="col-md-6 col-sm-3">Tarih</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($abonecek=$abonesorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $abonecek['abone_eposta']; ?></td>
                          <td>
                            <?php 
                                echo date("d.m.Y", strtotime($abonecek["abone_tarih"]));
                            ?>
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
        <!-- mesajı oku olarak düzenle -->
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