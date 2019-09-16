<?php 
    include 'header.php'; 

    $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 ORDER BY koyun_kayittarihi ASC");
    $koyunsorgu->execute(array(
        'id' => $kullanici_id
        ));
    $sayac=$koyunsorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk_koyun WHERE irk_id=:id");
    
    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:k_id and hayvan_id=:h_id ORDER BY tartim_tarihi DESC");
    
    $erkeksorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 and koyun_cinsiyet=1");
    $erkeksorgu->execute(array(
      'id' => $kullanici_id
      ));
    $sayacErkek=$erkeksorgu->rowCount();
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h2 class="modal-title" id="exampleModalLongTitle">Kayıt Şeklini Seçiniz
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </h2>
      </div>
      <div class="modal-body text-center">
        <a href="koyun-ekle-satinal.php"><img class="" src="../images/koyun-ekle-modal/koyun.png" alt=""></a>
        <a href="koyun-ekle-dogum.php"><img class="" src="../images/koyun-ekle-modal/kuzu.png" alt=""></a>
      </div><!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
<!-- modal son -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Grup Sayfası</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <a href="" class="btn btn-round btn-success btn-sm"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Grup Oluştur</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      Bu sayfada hayvanları belirli özelliklerine göre gruplandırıp onlara özel padok ve rasyon atayabilirsiniz. Buradan <a href="" class="btn btn-round btn-danger btn-xs"><i class="fas fa-plus" aria-hidden="true"></i> Yeni Padok Oluştur</a>abilir ve buradan da <a href="" class="btn btn-round btn-warning btn-xs"><i class="fas fa-plus" aria-hidden="true"></i> Yeni Rasyon Ekle</a>yebilirsiniz.
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
            <!-- widget başlangıç-->
            <div class="col-md-4 col-xs-12">
              <div class="x_panel fixed_height_210">
                <div class="">
                  <h2 class="">Grup Adı&nbsp;&nbsp;&nbsp;<a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a></h2>
            
                  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!--<img class="col-md-12" src="../images/iletisim.jpg" alt="">-->
                    <table class="table table-bordered table-hover">
                      <tbody>
                        <tr>
                          <th>Bulunduğu Bölme:</th>
                          <td>Bölme 1</td>
                        </tr>
                        <tr>
                          <th>Oluşturma Tarihi:</th>
                          <td>06.09.2019</td>
                        </tr>
                        <tr>
                          <th >Hayvan Sayısı:</th>
                          <td>15</td>
                        </tr>
                        <tr>
                          <th>Uygulanan Rasyon:</th>
                          <td>Besilik Kuzu 1</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              <!-- widget son-->
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>