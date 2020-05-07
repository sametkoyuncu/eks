<?php
include 'header.php';
$grup_id = $_GET['koyun_grup_id'];
$koyungrupsorgu = $db->prepare("SELECT * FROM koyun_grup WHERE kullanici_id=:id and koyun_grup_id=:koyun_grup_id");
$koyungrupsorgu->execute(array(
  'id' => $kullanici_id,
  'koyun_grup_id' => $grup_id
));
$koyungrupcek = $koyungrupsorgu->fetch(PDO::FETCH_ASSOC);

$koyunsorgu = $db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_durum=1 and koyun_grup_id=:grup_id ORDER BY koyun_kayittarihi ASC");
$koyunsorgu->execute(array(
  'id' => $kullanici_id,
  'grup_id' => $grup_id
));
$sayac = $koyunsorgu->rowCount();

$irksorgu = $db->prepare("SELECT * FROM irk_koyun WHERE irk_id=:id");

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Koyunlar </h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><span><?php echo "'".$koyungrupcek['koyun_grup_adi']."' "; ?></span>İsimli Grup Bilgisi</h2>
            <div class=" text-right">
              <a href="koyun-gruplari.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
              <a href="koyun-grup-islemler.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> İşlem Ekle</a>
              <a href="koyun-grup-duzenle.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-info btn-sm"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
              <a href="../islem.php?koyungrupsil=true&koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
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


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Genel Bakış</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Hayvanlar</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">İşlem Geçmişi</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                    synth. Cosby sweater eu banh mi, qui irure terr.</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>İşletme K.</th>
                        <th>Devlet Küpesi</th>
                        <th>Koyun Adı</th>
                        <th class="col-md-1 col-sm-1">Irk</th>
                        <th class="col-md-1 col-sm-1">Cinsiyet</th>
                        <!--<th class="">Nitelik</th>-->
                        <th></th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php while ($koyuncek = $koyunsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td class="text-center"><?php echo $koyuncek['koyun_kupeno_isletme']; ?></td>
                          <td class="text-center">
                            <?php if (isset($koyuncek['koyun_kupeno'])) {
                              echo $koyuncek['koyun_kupeno'];
                            } else {
                              echo "TR 34 XXXX XXX XX";
                            }
                            ?>
                          </td>
                          <td><?php echo $koyuncek['koyun_adi']; ?></td>
                          <td>
                            <?php
                            $irksorgu->execute(array(
                              'id' => $koyuncek['koyun_irk']
                            ));
                            $irkcek = $irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($koyuncek['koyun_cinsiyet'] == '1') {
                              echo "Erkek";
                            } else {
                              echo "Dişi";
                            }
                            ?>
                          </td>
                          <!--
                          <td>
                            <?php
                            /*if($koyuncek['koyun_nitelik']=='1'){
                                echo "Damızlık";
                              }elseif($koyuncek['koyun_nitelik']=='2'){
                                echo "Adaklık";
                              }elseif($koyuncek['koyun_nitelik']=='3'){
                                echo "Kurbanlık";
                              }elseif($koyuncek['koyun_nitelik']=='4'){
                                echo "Kasaplık";
                              }*/
                            ?>
                          </td>
                          -->
                          <td class="text-center">
                            <a href="koyun-profil.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a>
                            <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
                            <a href="../islem.php?koyunsil=true&koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                    booth letterpress, commodo enim craft beer mlkshk </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>