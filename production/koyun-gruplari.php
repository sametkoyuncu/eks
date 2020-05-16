<?php
include 'header.php';

$koyungrupsorgu = $db->prepare("SELECT * FROM koyun_grup WHERE kullanici_id=:id");
$koyungrupsorgu->execute(array(
  'id' => $kullanici_id
));
$sayac = $koyungrupsorgu->rowCount();

$padoksorgu = $db->prepare("SELECT * FROM koyun_padok WHERE kullanici_id=:id and koyun_padok_id=:padok_id");

$rasyonsorgu = $db->prepare("SELECT * FROM rasyon WHERE kullanici_id=:id and rasyon_id=:rasyon_id");
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
            <h2>Koyun Grupları Sayfası</h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="koyun-grup-ekle.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            Bu sayfada hayvanları belirli özelliklerine göre gruplandırıp toplu işlemler, onlara özel padok ve rasyon atayabilirsiniz. Buradan <a href="koyun-padok-ekle.php" class="btn btn-round btn-warning btn-xs"><i class="fas fa-plus" aria-hidden="true"></i> Yeni Padok Oluştur</a>abilir ve buradan da <a href="" class="btn btn-round btn-warning btn-xs"><i class="fas fa-plus" aria-hidden="true"></i> Yeni Rasyon Ekle</a>yebilirsiniz.
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- widget başlangıç-->
      <?php while ($koyungrupcek = $koyungrupsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php
        $grup_id = $koyungrupcek['koyun_grup_id'];
        $koyunsorgu = $db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_grup_id=:grup_id");
        $koyunsorgu->execute(array(
          'id' => $kullanici_id,
          'grup_id' => $grup_id
        ));
        $sayac = $koyunsorgu->rowCount();
        ?>
        <div class="col-md-4 col-xs-12">
          <div class="x_panel fixed_height_210">
            <div class="">
              <h2 class="">
                <?php echo $koyungrupcek['koyun_grup_adi']; ?>&nbsp;&nbsp;&nbsp;
              </h2>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <!--<img class="col-md-12" src="../images/iletisim.jpg" alt="">-->
              <table class="table table-bordered table-hover">
                <tbody>
                  <tr>
                    <th>Bulunduğu Bölme:</th>
                    <td>
                      <?php
                      $padoksorgu->execute(array(
                        'id' => $kullanici_id,
                        'padok_id' => $koyungrupcek['koyun_grup_padokid']
                      ));
                      $padokcek = $padoksorgu->fetch(PDO::FETCH_ASSOC);
                      if(isset($padokcek['koyun_padok_adi'])){echo $padokcek['koyun_padok_adi'];}
                      else {echo "Padok seçilmemiş..";}
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Oluşturma Tarihi:</th>
                    <td><?php echo date("d.m.Y", strtotime($koyungrupcek['koyun_grup_kayittarihi'])); ?></td>
                  </tr>
                  <tr>
                    <th>Hayvan Sayısı:</th>
                    <td><?php echo $sayac; ?></td>
                  </tr>
                  <tr>
                    <th>Uygulanan Rasyon:</th>
                    <td>
                    <?php
                      $rasyonsorgu->execute(array(
                        'id' => $kullanici_id,
                        'rasyon_id' => $koyungrupcek['koyun_grup_rasyonid']
                      ));
                      $rasyoncek = $rasyonsorgu->fetch(PDO::FETCH_ASSOC);
                      if(isset($rasyoncek['rasyon_adi'])){echo $rasyoncek['rasyon_adi'];}
                      else {echo "Rasyon seçilmemiş..";}
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Notlar:</th>
                    <td><?php echo substr($koyungrupcek['koyun_grup_not'], 0, 20) . "..."; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="grup_buton_grup text-center">
                <a href="koyun-grup-islemler.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-success btn-xs disabled" aria-disabled="true"><i class="fa fa-plus" aria-hidden="true"></i> İşlem Ekle</a>
                <a href="koyun-grup-ayrintilar.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-primary btn-xs"><i class="fa fa-info" aria-hidden="true"></i> Ayrıntılar</a>
                <a href="koyun-grup-duzenle.php?koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-info btn-xs"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
                <a href="../islem.php?koyungrupsil=true&koyun_grup_id=<?php echo $grup_id; ?>" class="btn btn-round btn-danger btn-xs"><i class="far fa-trash-alt" aria-hidden="true"></i> Sil</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <!-- widget son-->
    </div>

  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>