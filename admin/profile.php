<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
        <small>Selamat datang! di Sistem Penerimaan Peserta Didik Baru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Profile</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div class="col-md-12">
          <?php
          $alert = (!empty($_GET['alert']))?$_GET['alert']:"";
          if(isset($alert)){
            if($alert=='error'){
            ?>
              <div class="alert alert-danger alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-ban"></i>Gagal!
              </div>
            <?php
            }else if($alert=='success'){
            ?>
              <div class="alert alert-success alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i>Berhasil!
              </div>
            <?php
            }
          }
          ?>
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?= $data_user->nama ?></h3>
              <h5 class="widget-user-desc"><?= $data_user->level ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="../img/user.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-12">
                  <div class="description-block">
                    <h5 class="description-header"></h5>
                    <span class="description-text"></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered table-striped datatables-full" width="100%">
                    <tr>
                      <td>ID</td>
                      <td>:</td>
                      <td><?= $data_user->id_user ?></td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><?= $data_user->nama ?></td>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td><?= $data_user->username ?></td>
                    </tr>
                    <tr>
                      <td>Level</td>
                      <td>:</td>
                      <td><?= $data_user->level ?></td>
                    </tr>
                  </table>
                  <br>
                  <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_edit_profile" >Edit Profile</a>
                  <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_ganti_password" >Ganti Password</a>
                </div>
              </div>
              <!-- /.row -->

          <div class="modal fade" id="modal_edit_profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <span class="close" data-dismiss="modal">&times;</span>
                <h4 class="modal-title">Edit Profile</h4>
              </div>
              <form action="proses_edit_profile.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" value="<?= $data_user->username ?>" placeholder="Username" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <input type="text" name="nama" value="<?= $data_user->nama ?>" placeholder="Nama Lengkap" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <input type="button" value="Batal" class="btn btn-default" data-dismiss="modal" />
                <input type="Reset" value="Reset" class="btn btn-warning" />
                <input type="submit" name="action" value="Simpan" class="btn btn-success" />
              </div>
              </form>
            </div>
          </div>
        </div>

          <div class="modal fade" id="modal_ganti_password">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ganti Password</h4>
              </div>
              <form action="proses_edit_password.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="password" name="password_lama" placeholder="Password Lama" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" name="password_baru" placeholder="Password Baru" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" name="password_baru_ulang" placeholder="Ulangi Password Baru" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <input type="button" value="Batal" class="btn btn-default" data-dismiss="modal" />
                <input type="Reset" value="Reset" class="btn btn-warning" />
                <input type="submit" name="action" value="Simpan" class="btn btn-success" />
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php } ?>