<?php
include 'header.php';

$koyunpadoksorgu = $db->prepare("SELECT * FROM koyun_padok WHERE kullanici_id=:id");
$koyunpadoksorgu->execute(array(
  'id' => $kullanici_id
));
$sayac = $koyunpadoksorgu->rowCount();
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>
    </div>

    <div class="clearfix"></div>
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
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Koyun Padokları</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="koyun-padok-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="">#</th>
                  <th class="">Padok Adı</th>
                  <th class="">Oluşturma Tarihi</th>
                  <th class="">Açıklama</th>
                  <th class="">Ayarlar</th>
                </tr>
              </thead>


              <tbody>
                <?php $indis = 1; ?>
                <?php while ($koyunpadokcek = $koyunpadoksorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td class="text-center">
                      <?php
                      echo $indis;
                      $indis++;
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $koyunpadokcek['koyun_padok_adi'];
                      ?>
                    </td>
                    <td class="col-md-2 col-sm-2">
                      <?php
                      echo date("d.m.Y", strtotime($koyunpadokcek["koyun_padok_kayittarihi"]));
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $koyunpadokcek['koyun_padok_not'];
                      ?>
                    </td>

                    <td class="col-md-2 col-sm-2 text-center">
                      <!-- <a href="hayvan-profil.php?hayvan_id=<?php #echo $koyuntohumcek['koyun_tohum_id']; 
                                                                ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a> -->
                      <a href="koyun-padok-duzenle.php?koyun_padok_id=<?php echo $koyunpadokcek['koyun_padok_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Düzenle</a>
                      <a href="../islem.php?koyunpadoksil=true&koyun_padok_id=<?php echo $koyunpadokcek['koyun_padok_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i> Sil</a>
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