<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
  if($level!=="admin"){
    ?>
    <script type="text/javascript">
      location='index.php?menu=error404';
    </script>
    <?php
  }else{
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Selamat datang! di Sistem Penerimaan Peserta Didik Baru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">User</li>
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
      </div>
      <?php
        $aksi = (!empty($_GET['aksi']))?$_GET['aksi']:"";
        switch ($aksi) {
          case "tambah":
            ?>
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah User</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_tambah_user.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama" placeholder="Nama User" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                      <select name="level" id="" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <a href="index.php?menu=user" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                      <input type="submit" class="btn btn-success" name="action" value="Simpan">
                    </div>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <?php
            break;
          case "edit":
            $id_user = (!empty($_GET['id']))?(int)$_GET['id']:"";
            if(!empty($id_user)){
            $data_user_query = $koneksi->prepare("SELECT * FROM user WHERE id_user=?");
            $data_user_query->bind_param("i",$id_user);
            $data_user_query->execute();
            $data_user = $data_user_query->get_result()->fetch_object();
            ?>
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit user</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_edit_user.php?id=<?= $data_user->id_user ?>" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama" placeholder="Nama user" value="<?= $data_user->nama ?>" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" placeholder="Nama user" value="<?= $data_user->username ?>" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="password" placeholder="Password" value="">
                    </div>
                    <div class="form-group">
                      <select name="level" id="" class="form-control">
                        <option value="admin" <?= ($data_user->level=="admin")?"selected":"" ?>>Admin</option>
                        <option value="operator" <?= ($data_user->level=="operator")?"selected":"" ?>>Operator</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <a href="index.php?menu=user" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                      <input type="submit" class="btn btn-success" name="action" value="Simpan">
                    </div>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            <?php
            }else{
          ?>
          <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i>ERROR!!
          </div>
        <?php
        }
            break;
          default:
            ?>
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Data User</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped table-hover datatables-full" width="100%">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $data_user_query = $koneksi->query("SELECT * FROM user ORDER BY nama");
                        while($data_user = $data_user_query->fetch_object()){
                          ?>
                          <tr>
                            <td style="width: 10px"><?= $no ?></td>
                            <td><?= $data_user->nama ?></td>
                            <td><?= $data_user->username ?></td>
                            <td><?= $data_user->level ?></td>
                            <td>
                            <a href="?menu=user&aksi=edit&id=<?= $data_user->id_user ?>" class="text-orange">
                              <i class="fa fa-pencil"></i>
                            </a><?php if($data_user->level!=="admin"){ ?>|
                            <a href="proses_hapus_user.php?id=<?= $data_user->id_user ?>" class="text-red">
                              <i class="fa fa-trash"></i>
                            </a><?php } ?>
                          </td>
                          </tr>
                          <?php
                          $no++;
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <?php
            break;
        }
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php }} ?>