<?php 
      include 'header.php'; 
      include '../../baglan.php';

      if (isset($_POST['arama'])) {

        $aranan=$_POST['aranan'];

        $sosyalmedyasorgu=$db->prepare("SELECT * FROM sosyal_medya WHERE sosyalmedya_adi LIKE '%$aranan%' ORDER BY sosyalmedya_durum DESC, sosyalmedya_sira ASC");
        $sosyalmedyasorgu->execute();
        #$sayac=$sosyalmedyasorgu->rowCount();

      } else {

        $sosyalmedyasorgu=$db->prepare("SELECT * FROM sosyal_medya ORDER BY sosyalmedya_durum DESC, sosyalmedya_sira ASC");
        $sosyalmedyasorgu->execute();
        #$sayac=$sosyalmedyasorgu->rowCount();

      }
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
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
                    <h2>Default Example <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>İkon</th>
                          <th>Ad</th>
                          <th>Bağlantı</th>
                          <th>Sıra</th>
                          <th>Durum</th>
                          <th>İşlemler</th>
                        </tr>
                      </thead>


                      <tbody>
                      	<?php 
                            #foreach ($db->query("SELECT * FROM nedenler ORDER BY neden_durum DESC, neden_sira ASC", PDO::FETCH_ASSOC) as $nedencek)
                            if (empty($sosyalmedyasorgu->rowCount())) { ?>
                                <p>Eşleşme bulunamadı.. 
                                <br>
                                <br>
                                <a class="btn btn-round btn-warning btn-sm text-center" href="sosyalmedya-ayarlari.php"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri dön</a></p>
                            <?php } else {
                            while ($sosyalmedyacek=$sosyalmedyasorgu->fetch(PDO::FETCH_ASSOC)) {
                               # code...
                             
                          ?>
                              <tr>
                                <td class=" " style="vertical-align: middle;">
                                  <i class="fa fa-<?php echo $sosyalmedyacek['sosyalmedya_ikon']; ?>" aria-hidden="true"></i>
                                </td>
                                <td class=" " style="vertical-align: middle;"><?php echo $sosyalmedyacek['sosyalmedya_adi']; ?></td>
                                <td class=" " style="vertical-align: middle;"><?php echo $sosyalmedyacek['sosyalmedya_adresi']; ?></td>
                                <td class=" " style="vertical-align: middle;"><?php echo $sosyalmedyacek['sosyalmedya_sira'];?></td>
                                <td class=" " style="vertical-align: middle;">
                                <?php 
                                  $durum=$sosyalmedyacek['sosyalmedya_durum'];
                                  if($durum==1) { ?>
                                    <i style="color: #3FC1A5;"><?php echo 'Görünür'; ?></i>
                                  <?php } else { ?>
                                    <i style="color: #D9534F;"><?php echo 'Gizli'; ?></i>
                                  <?php }
                                ?>
                                </td>
                                <td class="col-md-2  text-right" style="vertical-align: middle;">
                                  <a href="sosyalmedya-duzenle.php?durum=null&sosyalmedya_id=<?php echo $sosyalmedyacek['sosyalmedya_id']; ?>" class="btn btn-round btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</a>
                                  <a href="../../islem.php?sosyalmedyasil=true&sosyalmedya_id=<?php echo $sosyalmedyacek['sosyalmedya_id']; ?>" class="btn btn-round btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</a>
                                </td>
                              </tr>

                          <?php 
                              }
                          } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php include 'footer.php'; ?>