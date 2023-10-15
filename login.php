<?php
//created by dsyafaatul
  if(!isset($koneksi)){
    header("Location: index.php");
  }else{
  if(!empty($_SESSION['id_user']) AND !empty($_SESSION['username']) AND !empty($_SESSION['level'])){
    ?>
    <script type="text/javascript">
      document.location='admin/index.php';
    </script>
    <?php
  }else{
?>
<div class="login-box" style="margin-top: 70px;">
   <div class="login-logo">
     <div class="login-logo">
      <a href="index.php"><b>SISTEM</b> PPDB</a>
    </div>
   </div>
    <?php
      $alert = (!empty($_GET['alert']))?$_GET['alert']:"";
      if($alert=='error1'){
      ?>
        <div class="alert alert-danger alert-dismissible" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-ban"></i>Login Gagal! Username Tidak Ditemukan
        </div>
      <?php
      }else if($alert=='error2'){
      ?>
        <div class="alert alert-danger alert-dismissible" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-ban"></i>Login Gagal! Password Salah
        </div>
      <?php
      }else{
        ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-warning"></i>Silahkan Login Terlebih dahulu
        </div>
      <?php
      }
    ?>
    <form action="proses_login.php" method="POST">
      <div class="form-group has-feedback">
        <input type="username" name="username" class="form-control" placeholder="Username" required="required">
        <span class="fa fa-user-circle-o form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="action" value="login" class="btn btn-primary btn-block" style="margin-top: 5px;">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
</div>
<!-- /.login-box -->
<?php } ?>
<?php } ?>