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
        Laporan
        <small>Selamat datang! di Sistem Penerimaan Peserta Didik Baru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Laporan</a></li>
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
      <!-- Main content -->
       <style>
 table{
  width: 100%;
 }
 table th{
  padding: 0px;
  font-size: 11pt;
 }
 table td{
  padding: 0px;
  font-size: 11pt;
 }
@media print {
  html, body{
    height: 297mm;
    width: 210mm;
  }
}
td{
vertical-align:top;
}
body {
  margin : 0 auto;
  font-size: 11pt;
}
</style>
    <section class="invoice">
      <div class="row pull-right no-print">
        <div class="col-xs-12">
          <a href="javascript:void()" class="btn btn-default" onclick="print()"><i class="fa fa-print"></i> Print</a>
          <a href="laporan_pdf.php" class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
          <a href="laporan_excel.php" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
        </div>
      </div>
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <table border="0" width="100%">
              <img src="../img/LOGO.png" alt="" style="width: 70px;height: 70px;position: absolute;left: 110px;top: 25px;">
              <tr>
                  <td align="center" style="width: 100%;padding: 5px;font-size: 20pt;font-weight: bold;">
                  SMK PUI Majalengka
                  </td>
              </tr>
              <tr>
                <td align="center" style="padding: 5px;font-size: 11pt;">
                  Jalan Suma No.478 Majalengka 45419 Telp. /Fax (0233) 281027
                </td>
              </tr>
              <tr style="border-bottom: 1px solid black;">
                <td align="center" style="padding: 5px;font-size: 11pt;">
                  www.smkpui-majalengka.sch.id email: smkpuimjlk@yahoo.com
                </td>
              </tr>
              <tr>
                <td align="center" style="padding-top: 15px;font-size: 14pt;font-weight: bold;">LAPORAN PPDB</td>
              </tr>
              <tr>
                <td align="center" style="font-size: 11pt;">TANGGAL 
                  <?php
                  if(!empty($_GET['range'])){
                    echo $_GET['range'];
                  }else{  
                    echo strtoupper(date("d/m/Y"));
                  }
                  ?>
                </td>
              </tr>
          </table>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%">
            <thead>
              <tr>
                <th width="10">No</th>
                <th width="100">Nama</th>
                <th width="50">Jenis Kelamin</th>
                <th width="200">Alamat</th>
                <th width="50">TTL</th>
                <th width="100">Asal Sekolah</th>
                <th width="50">Pilih Jurusan</th>
                <th width="50">No Telepon</th>
                <th width="50">Tahun Pelajaran</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $data_siswa_query = $koneksi->query("SELECT * FROM siswa,jurusan WHERE siswa.pilih_jurusan=jurusan.id_jurusan ORDER BY nama");
                $nama_jurusan = "";
                while($data_siswa = $data_siswa_query->fetch_object()){
                $jenis_kelamin = ($data_siswa->jenis_kelamin=="L"?"Laki-Laki":"Perempuan");
                $pisah = explode(" ",$data_siswa->jurusan);
                foreach($pisah as $value){
                  $substr = substr($value,0,1);
                  $nama_jurusan .= $substr;
                }
                  ?>
                  <tr>
                    <td style="width: 10px"><?= $no ?></td>
                    <td valign="top"><?= $data_siswa->nama ?></td>
                    <td valign="top"><?= $jenis_kelamin ?></td>
                    <td valign="top" style="width: 50px;"><?= $data_siswa->alamat ?></td>
                    <td valign="top"><?= $data_siswa->ttl ?></td>
                    <td valign="top"><?= $data_siswa->asal_sekolah ?></td>
                    <td valign="top"><?= $nama_jurusan ?></td>
                    <td valign="top"><?= $data_siswa->no_telp ?></td>
                    <td valign="top"><?= $data_siswa->tahun_ajaran ?></td>
                  </tr>
                  <?php
                  $no++;
                  $nama_jurusan = "";
                }
                ?>
            </tbody>
          </table>
          <br>
          <br>
          <table border="0">
            <tr>
              <td align="right" style="padding-right: 80px;">Majalengka, <?= date("d-m-Y") ?></td>
            </tr>
            <tr>
              <td><br><br><br><br></td>
            </tr>
            <tr>
              <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; border-bottom: 1px solid black; text-align: center; width: 200px;"></td>
            </tr>
            <tr>
              <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; text-align: left; width: 200px;" value="NIP. "></td>
            </tr>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php }} ?>