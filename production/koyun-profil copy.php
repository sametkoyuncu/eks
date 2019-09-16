 <?php 
    include 'header.php';
    include '../baglan.php';

    $koyunsorgu=$db->prepare("SELECT * FROM koyun WHERE kullanici_id=:id and koyun_id=:koyun_id");
    $koyunsorgu->execute(array(
      'id' => $kullanici_id,
      'koyun_id' => $_GET['koyun_id']
      ));
    $koyuncek=$koyunsorgu->fetch(PDO::FETCH_ASSOC);

    $sayac=$koyunsorgu->rowCount();

    $irksorgu=$db->prepare("SELECT * FROM irk WHERE irk_id=:id");

    $tartimsorgu=$db->prepare("SELECT * FROM tartim WHERE kullanici_id=:id and hayvan_id=:koyun_id");
    $tartimsorgu->execute(array(
      'id' => $kullanici_id,
      'koyun_id' => $_GET['koyun_id']
      ));
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
                    <h2><?php echo $koyuncek['koyun_kupeno'] ?> Küpeli Koyun Bilgileri </h2>
                    <div class=" text-right">
                      <a href="koyunlar.php" class="btn btn-round btn-warning btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Geri Dön</a>
                     
                      <a href="koyun-duzenle.php?koyun_id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-info btn-sm"><i class="far fa-edit" aria-hidden="true"></i> Düzenle</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img src="../images/koyun/<?php echo $koyuncek['koyun_irk']; ?>.jpg" alt="" style="width: 250px; height: 250px; max-width: 250px; max-height: 250px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; border: 5px solid rgba(255,255,255,0.5);" >
                          <!--<img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">-->
                        </div>
                      </div>
                      <h3>
                        <?php 
                            echo "<b>İşletme Küpesi:</b> ";
                            if(strlen($koyuncek['koyun_kupeno_isletme'])>0){
                              echo $koyuncek['koyun_kupeno_isletme'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                      </h3>
                      <hr>
                      <ul class="list-unstyled user_data">
                        <li>
                          <?php echo "<b>Devlet Küpesi:</b> ".$koyuncek['koyun_kupeno']; ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Adı:</b> ";
                            if(strlen($koyuncek['koyun_adi'])>0){
                              echo $koyuncek['koyun_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Doğum Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_dogumtarihi'])>0){
                              echo $koyuncek['koyun_dogumtarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>

                        <li>
                          <?php 
                            echo "<b>Irk:</b> ";
                            if($koyuncek['koyun_irk']){
                              $irksorgu->execute(array(
                              'id' => $koyuncek['koyun_irk']
                              ));
                            $irkcek=$irksorgu->fetch(PDO::FETCH_ASSOC);
                            echo $irkcek['irk_adi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Nitelik:</b> ";
                            if($koyuncek['koyun_nitelik']){
                              if($koyuncek['koyun_nitelik']=='1'){
                                echo "Damızlık";
                              }elseif ($koyuncek['koyun_nitelik']=='2') {
                                echo "Adaklık";
                              }elseif ($koyuncek['koyun_nitelik']=='3') {
                                echo "Kurbanlık";
                              }elseif ($koyuncek['koyun_nitelik']=='4') {
                                echo "Kasaplık";
                              }
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Durum:</b> ";
                            if($koyuncek['koyun_durum']){
                              if($koyuncek['koyun_durum']=='1'){
                                echo "Mevcut";
                              }elseif ($koyuncek['koyun_durum']=='2') {
                                echo "Satıldı";
                              }else{
                                echo "Öldü";
                              }
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <hr>
                        <li>
                          <?php 
                            echo "<b>Alış Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_alistarihi'])>0){
                              echo $koyuncek['koyun_alistarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Alış Fiyatı:</b> ";
                            if($koyuncek['koyun_alisfiyati']>0){
                              echo $koyuncek['koyun_alisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Satış Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_satistarihi'])>0){
                              echo $koyuncek['koyun_satistarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <li>
                          <?php 
                            echo "<b>Satış Fiyatı:</b> ";
                            if($koyuncek['koyun_satisfiyati']>0){
                              echo $koyuncek['koyun_satisfiyati']." ₺";
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                        <hr>
                        <li>
                          <?php 
                            echo "<b>Ölüm Tarihi:</b> ";
                            if(strlen($koyuncek['koyun_olumtarihi'])>0){
                              echo $koyuncek['koyun_olumtarihi'];
                            }else{
                              echo "Belirtilmemiş";
                            } ?>
                        </li>
                      </ul>

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>

                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Project Name</th>
                                  <th>Client Company</th>
                                  <th class="hidden-phone">Hours Spent</th>
                                  <th>Contribution</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">18</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>New Partner Contracts Consultanci</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">13</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Partners and Inverstors report</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">30</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">28</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                      <!-- tartım -->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Tartım Geçmişi </h2>
                            <div class=" text-right">
                              <a href="tartim-ekle.php?id=<?php echo $koyuncek['koyun_id']; ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tartım Ekle</a>
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
              <!-- tartım son -->
                    </div>
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