<?php 
    include 'header.php'; 

    $notsorgu=$db->prepare("SELECT * FROM notlar WHERE kullanici_id=:id ORDER BY not_kayittarihi ASC");
    $notsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$notsorgu->rowCount();
?>
<head>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
</head>
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
                    <h2>Notlar</h2>
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
                          <th class="col-md-2 col-sm-2">Başlık</th>
                          <th class="col-md-1 col-sm-1">Kayıt Tarihi</th>
                          <th class="col-md-6 col-sm-6">Açıklama</th>
                          <th class="col-md-3 col-sm-3" >Ayarlar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php while ($notcek=$notsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $notcek['not_baslik']; ?></td>
                          <td class="col-md-2 col-sm-2"><?php echo date('d.m.Y',strtotime($notcek['not_kayittarihi'])); ?></td>
                          <td><?php echo $notcek['not_aciklama']; ?></td>
                          <td class="text-center">
                            <form action="../islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                              <a href="not-duzenle.php?notid=<?php echo $notcek['not_id']; ?>" class="btn btn-success btn-round btn-xs" data-toggle="tooltip" data-placement="top" title="Notu Düzenle">   Düzenle   </a>
                              <a href="../islem.php?notsil=true&notid=<?php echo $notcek['not_id']; ?>" class="btn btn-danger btn-round btn-xs" data-toggle="tooltip" data-placement="top" title="Notu Sil">   Sil   </a>
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
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" id="first-name" required="required" name="not_baslik" class="form-control col-md-8 col-xs-12" placeholder="Bir başlık giriniz..">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Not <span class="required">*</span>
                          </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="not_aciklama"></textarea> 
                            <script>
                                CKEDITOR.replace( 'not_aciklama' );
                            </script>
                          </div>
                        </div>
              </div>
              <div class="modal-footer">
                <div class="col text-center">
                  <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Kapat</button>
                  <button type="submit" name="notekle" class="btn btn-round btn-success">Kaydet</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>

        <?php include 'footer.php'; ?>