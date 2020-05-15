<?php
include 'header.php';

$yemkayitsorgu = $db->prepare("SELECT * FROM yem_kayit WHERE kullanici_id=:id");
$yemkayitsorgu->execute(array(
  'id' => $kullanici_id
));
$sayac = $yemkayitsorgu->rowCount();

$kesifyemsorgu = $db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yem_tipi=:tip");
$kesifyemsorgu->execute(array(
  'id' => $kullanici_id,
  'tip' => 1
));

$kabayemsorgu = $db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yem_tipi=:tip");
$kabayemsorgu->execute(array(
  'id' => $kullanici_id,
  'tip' => 2
));

$katkiyemsorgu = $db->prepare("SELECT * FROM yem WHERE kullanici_id=:id and yem_tipi=:tip");
$katkiyemsorgu->execute(array(
  'id' => $kullanici_id,
  'tip' => 3
));



?>

<!-- page content -->
<div class="right_col" role="main">


  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <!-- üst tablo -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yem Stok Durumu </h2>
            <div class=" text-right">
              <a href="yem-kayit.php#kayitlar" class="btn btn-round btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Satın Alım Kayıtları</a>
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
            Bu sayfada stokta bulunan yem ve yem katkı maddelerini görüntüleyebilir, satın alım kaydı ekleyebilir veya önceden yapılan alımlarla ilgili kayıtları inceleyebilirsiniz.
          </div>
        </div>
      </div>
      <!-- üst tablo son -->
      <!-- üst tablo -->
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kesif Yemler </h2>
            <div class=" text-right">
              <a href="yem-kayit-ekle-kesif-yem.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Alım Ekle</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="">Ad</th>
                  <th class="">Miktar</th>
                  <th class="">Birim</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($yemcek = $kesifyemsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $yemcek['yem_adi']; ?></td>
                    <td><?php echo $yemcek['yem_miktari']; ?></td>
                    <td>
                      <?php
                      $birimsorgu = $db->prepare("SELECT * FROM birim WHERE birim_id=:id");
                      $birimsorgu->execute(array(
                        'id' => $yemcek['yem_birimi']
                      ));
                      $birimcek = $birimsorgu->fetch(PDO::FETCH_ASSOC);
                      echo $birimcek['birim_adi'];
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- üst tablo son -->
      <!-- üst tablo -->
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kaba Yemler </h2>
            <div class=" text-right">
              <a href="yem-kayit-ekle-kaba-yem.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Alım Ekle</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="">Ad</th>
                  <th class="">Miktar</th>
                  <th class="">Birim</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($yemcek = $kabayemsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $yemcek['yem_adi']; ?></td>
                    <td><?php echo $yemcek['yem_miktari']; ?></td>
                    <td>
                      <?php
                      $birimsorgu = $db->prepare("SELECT * FROM birim WHERE birim_id=:id");
                      $birimsorgu->execute(array(
                        'id' => $yemcek['yem_birimi']
                      ));
                      $birimcek = $birimsorgu->fetch(PDO::FETCH_ASSOC);
                      echo $birimcek['birim_adi'];
                      ?>
                    </td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- üst tablo son -->
      <!-- üst tablo -->
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yem Katkı Maddeleri </h2>
            <div class=" text-right">
              <a href="yem-kayit-ekle-katki-yem.php" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Alım Ekle</a>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="">Ad</th>
                  <th class="">Miktar</th>
                  <th class="">Birim</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($yemcek = $katkiyemsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $yemcek['yem_adi']; ?></td>
                    <td><?php echo $yemcek['yem_miktari']; ?></td>
                    <td>
                      <?php
                      $birimsorgu = $db->prepare("SELECT * FROM birim WHERE birim_id=:id");
                      $birimsorgu->execute(array(
                        'id' => $yemcek['yem_birimi']
                      ));
                      $birimcek = $birimsorgu->fetch(PDO::FETCH_ASSOC);
                      echo $birimcek['birim_adi'];
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- üst tablo son -->
      <div class="col-md-12 col-sm-12 col-xs-12" id="kayitlar">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yem Satın Alım Kayıtları</h2>
            <div class=" text-right">

            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="">Ad</th>
                  <th class="">Miktar</th>
                  <th class="">Birim</th>
                  <th class="">Birim Fiyat</th>
                  <th class="">Toplam Fiyat</th>
                  <th class="">Kayıt Tarihi</th>
                  <th class="">Açıklama</th>
                  <th class=""></th>
                </tr>
              </thead>


              <tbody>
                <?php while ($yemkayitcek = $yemkayitsorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td>
                      <?php
                      $yemsorgu = $db->prepare("SELECT * FROM yem WHERE yem_id=:id");
                      $yemsorgu->execute(array(
                        'id' => $yemkayitcek['yemkayit_adi']
                      ));
                      $yemcek = $yemsorgu->fetch(PDO::FETCH_ASSOC);
                      echo $yemcek['yem_adi'];
                      $birim = $yemcek['yem_birimi'];
                      ?>
                    </td>
                    <td><?php echo $yemkayitcek['yemkayit_miktari'] ?></td>
                    <td>
                      <?php
                      $birimsorgu = $db->prepare("SELECT * FROM birim WHERE birim_id=:id");
                      $birimsorgu->execute(array(
                        'id' => $birim
                      ));
                      $birimcek = $birimsorgu->fetch(PDO::FETCH_ASSOC);
                      echo $birimcek['birim_adi'];
                      ?>
                    </td>
                    <td><?php echo $yemkayitcek['yemkayit_birimfiyati'] . " ₺"; ?></td>
                    <td><?php echo $yemkayitcek['yemkayit_birimfiyati'] * $yemkayitcek['yemkayit_miktari'] . " ₺"; ?></td>
                    <td><?php echo $yemkayitcek['yemkayit_alistarihi']; ?></td>
                    <td><?php echo $yemkayitcek['yemkayit_aciklama']; ?></td>
                    <td class="text-center">
                      <!--<a href="yemkayit-duzenle.php?id=<?php echo $yemkayitcek['yemkayit_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>-->
                      <a href="../islem.php?yemkayitsil=true&yemkayit_id=<?php echo $yemkayitcek['yemkayit_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i> Sil</a>
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