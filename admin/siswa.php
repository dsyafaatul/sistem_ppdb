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
        Siswa
        <small>Selamat datang! di Sistem Penerimaan Peserta Didik Baru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Siswa</a></li>
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
                  <h3 class="box-title">Tambah Siswa</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_tambah_siswa.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" required="required">
                    </div>
                     <div class="form-group">
                        <input type="radio" name="jenis_kelamin" value="L" class="minimal" required="required">
                         Laki-Laki
                        <input type="radio" name="jenis_kelamin" value="P" class="minimal" required="required">
                         Perempuan
                    </div>
                    <div class="form-group">
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-map-marker"></i>
                            </span>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required="required">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah" required="required">
                    </div>
                    <div class="form-group">
                      <select name="pilih_jurusan" class="form-control">
                        <?php
                          $data_jurusan_query = $koneksi->query("SELECT * FROM jurusan");
                          while($data_jurusan = $data_jurusan_query->fetch_object()){
                        ?>
                          <option value="<?= $data_jurusan->id_jurusan ?>"><?= $data_jurusan->jurusan ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="no_telp" placeholder="No Telepon">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" required="required">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" required="required">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" required="required">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="anak_ke" placeholder="Anak Ke" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tahun_ajaran" placeholder="Tahun Ajaran" data-inputmask="'alias': 'yyyy'" id="tahun" value="<?= date("Y") ?>" data-mask>
                    </div>
                    <div class="form-group">
                      <a href="index.php?menu=siswa" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
            $id_siswa = (!empty($_GET['id']))?(int)$_GET['id']:"";
            if(!empty($id_siswa)){
            $data_siswa_query = $koneksi->prepare("SELECT * FROM siswa WHERE id_siswa=?");
            $data_siswa_query->bind_param("i",$id_siswa);
            $data_siswa_query->execute();
            $data_siswa = $data_siswa_query->get_result()->fetch_object();
            $pisah = explode(",",$data_siswa->ttl);
            $tempat_lahir = $pisah[0];
            $tanggal_lahir = $pisah[1];
            ?>
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Siswa</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_edit_siswa.php?id=<?= $data_siswa->id_siswa ?>" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="<?= $data_siswa->nama ?>" required="required">
                    </div>
                     <div class="form-group">
                        <input type="radio" name="jenis_kelamin" value="L" class="minimal" required="required" <?= ($data_siswa->jenis_kelamin=="L")?"checked":"" ?>>
                         Laki-Laki
                        <input type="radio" name="jenis_kelamin" value="P" class="minimal" required="required" <?= ($data_siswa->jenis_kelamin=="P")?"checked":"" ?>>
                         Perempuan
                    </div>
                    <div class="form-group">
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"><?= $data_siswa->alamat ?></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $tanggal_lahir ?>" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-map-marker"></i>
                            </span>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $tempat_lahir ?>" required="required">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah" value="<?= $data_siswa->asal_sekolah ?>" required="required">
                    </div>
                    <div class="form-group">
                      <select name="pilih_jurusan" class="form-control">
                        <?php
                          $data_jurusan_query = $koneksi->query("SELECT * FROM jurusan");
                          while($data_jurusan = $data_jurusan_query->fetch_object()){
                        ?>
                          <option value="<?= $data_jurusan->id_jurusan ?>" <?= ($data_jurusan->id_jurusan==$data_siswa->pilih_jurusan)?"selected":"" ?>><?= $data_jurusan->jurusan ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="no_telp" placeholder="No Telepon" value="<?= $data_siswa->no_telp ?>">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" value="<?= $data_siswa->nama_ayah ?>" required="required">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="<?= $data_siswa->nama_ibu ?>" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" value="<?= $data_siswa->pekerjaan_ayah ?>" required="required">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="<?= $data_siswa->pekerjaan_ibu ?>" required="required">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="anak_ke" placeholder="Anak Ke" required="required" value="<?= $data_siswa->anak_ke ?>">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tahun_ajaran" placeholder="Tahun Ajaran" data-inputmask="'alias': 'yyyy'" id="tahun" value="<?= $data_siswa->tahun_ajaran ?>" value="<?= $data_siswa->tahun_ajaran ?>" data-mask>
                    </div>
                    <div class="form-group">
                      <a href="index.php?menu=siswa" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
            case "detail":
            $id_siswa = (!empty($_GET['id']))?(int)$_GET['id']:"";
            if(!empty($id_siswa)){
            $data_siswa_query = $koneksi->prepare("SELECT * FROM siswa,jurusan WHERE jurusan.id_jurusan=siswa.pilih_jurusan AND id_siswa=?");
            $data_siswa_query->bind_param("i",$id_siswa);
            $data_siswa_query->execute();
            $data_siswa = $data_siswa_query->get_result()->fetch_object();
            $pisah = explode(",",$data_siswa->ttl);
            $tempat_lahir = $pisah[0];
            $tanggal_lahir = $pisah[1];
            ?>
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Siswa</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="col-md-12">
                    <table class="table table-bordered table-hover" width="100%">
                      <tr>
                        <td>ID</td>
                        <td>:</td>
                        <td><?= $data_siswa->id_siswa ?></td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $data_siswa->nama ?></td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $data_siswa->jenis_kelamin ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $data_siswa->alamat ?></td>
                      </tr>
                      <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= $data_siswa->ttl ?></td>
                      </tr>
                      <tr>
                        <td>Asal Sekolah</td>
                        <td>:</td>
                        <td><?= $data_siswa->asal_sekolah ?></td>
                      </tr>
                      <tr>
                        <td>Pilih Jurusan</td>
                        <td>:</td>
                        <td><?= $data_siswa->jurusan ?></td>
                      </tr>
                      <tr>
                        <td>No Telp</td>
                        <td>:</td>
                        <td><?= $data_siswa->no_telp ?></td>
                      </tr>
                      <tr>
                        <td>Nama Ayah</td>
                        <td>:</td>
                        <td><?= $data_siswa->nama_ayah ?></td>
                      </tr>
                      <tr>
                        <td>Nama Ibu</td>
                        <td>:</td>
                        <td><?= $data_siswa->nama_ibu ?></td>
                      </tr>
                      <tr>
                        <td>Pekerjaan Ayah</td>
                        <td>:</td>
                        <td><?= $data_siswa->pekerjaan_ayah ?></td>
                      </tr>
                      <tr>
                        <td>Pekerjaan Ibu</td>
                        <td>:</td>
                        <td><?= $data_siswa->pekerjaan_ibu ?></td>
                      </tr>
                      <tr>
                        <td>Anak ke</td>
                        <td>:</td>
                        <td><?= $data_siswa->anak_ke ?></td>
                      </tr>
                      <tr>
                        <td>Tahun Ajaran</td>
                        <td>:</td>
                        <td><?= $data_siswa->tahun_ajaran ?></td>
                      </tr>
                    </table>
                    <a href="index.php?menu=siswa" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="?menu=siswa&aksi=edit&id=<?= $data_siswa->id_siswa ?>" class="btn btn-warning">
                      <i class="fa fa-pencil"></i>
                    </a> |
                    <a href="proses_hapus_siswa.php?id=<?= $data_siswa->id_siswa ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin logout?')">
                      <i class="fa fa-trash"></i>
                    </a> | 
                    <a href="index.php?menu=siswa&aksi=formulir&id=<?= $data_siswa->id_siswa ?>" class="btn btn-info">
                      <i class="fa fa-print"></i>
                    </a>
                  </div>
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
          case "formulir":
          $id_siswa = (!empty($_GET['id']))?(int)$_GET['id']:"";
          if(!empty($id_siswa)){
          $data_siswa_query = $koneksi->prepare("SELECT * FROM siswa,jurusan WHERE jurusan.id_jurusan=siswa.pilih_jurusan AND id_siswa=?");
          $data_siswa_query->bind_param("i",$id_siswa);
          $data_siswa_query->execute();
          $data_siswa = $data_siswa_query->get_result()->fetch_object();
          $pisah = explode(",",$data_siswa->ttl);
          $tempat_lahir = $pisah[0];
          $tanggal_lahir = $pisah[1];
          ?>
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
                <td align="center" style="padding-top: 15px;font-size: 14pt;font-weight: bold;">FORMULIR PENDAFTARAN</td>
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
        <table class="table" style="width: 80%;" align="center">
        <tr>
          <td style="width: 180px;">1. Nama</td>
          <td style="width: 1px;">:</td>
          <td><?= $data_siswa->nama ?></td>
        </tr>
        <tr>
          <td>2. Jenis Kelamin</td>
          <td>:</td>
          <td><?= $data_siswa->jenis_kelamin ?></td>
        </tr>
        <tr>
          <td>3. Alamat</td>
          <td>:</td>
          <td><?= $data_siswa->alamat ?></td>
        </tr>
        <tr>
          <td>4. Tempat Tanggal Lahir</td>
          <td>:</td>
          <td><?= $data_siswa->ttl ?></td>
        </tr>
        <tr>
          <td>5. Asal Sekolah</td>
          <td>:</td>
          <td><?= $data_siswa->asal_sekolah ?></td>
        </tr>
        <tr>
          <td>6. Pilih Jurusan</td>
          <td>:</td>
          <td><?= $data_siswa->jurusan ?></td>
        </tr>
        <tr>
          <td>7. No Telp</td>
          <td>:</td>
          <td><?= $data_siswa->no_telp ?></td>
        </tr>
        <tr>
          <td>8. Nama Ayah</td>
          <td>:</td>
          <td><?= $data_siswa->nama_ayah ?></td>
        </tr>
        <tr>
          <td>9. Nama Ibu</td>
          <td>:</td>
          <td><?= $data_siswa->nama_ibu ?></td>
        </tr>
        <tr>
          <td>10. Pekerjaan Ayah</td>
          <td>:</td>
          <td><?= $data_siswa->pekerjaan_ayah ?></td>
        </tr>
        <tr>
          <td>11. Pekerjaan Ibu</td>
          <td>:</td>
          <td><?= $data_siswa->pekerjaan_ibu ?></td>
        </tr>
        <tr>
          <td>12. Anak ke</td>
          <td>:</td>
          <td><?= $data_siswa->anak_ke ?></td>
        </tr>
        <tr>
          <td>13. Tahun Ajaran</td>
          <td>:</td>
          <td><?= $data_siswa->tahun_ajaran ?></td>
        </tr>
      </table>
      <br>
      <br>
          <br>
          <table border="0">
            <tr>
              <td align="left" style="padding-left: 80px;">Majalengka, <?= date("d-m-Y") ?></td>
              <td align="right" style="padding-right: 80px;">Majalengka, <?= date("d-m-Y") ?></td>
            </tr>
            <tr>
              <td align="left" style="padding-left: 80px;">Calon Siswa/Siswi<br><br><br><br></td>
              <td align="right" style="padding-right: 80px;">Orang Tua/Wali<br><br><br><br></td>
            </tr>
            <tr>
              <td align="left" style="padding-left: 40px;"><input type="text" style="border: none; border-bottom: 1px solid black; text-align: center; width: 200px;"></td>
              <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; border-bottom: 1px solid black; text-align: center; width: 200px;"></td>
            </tr>
            <tr>
              <td align="left" style="padding-left: 40px;"><input type="text" style="border: none; text-align: left; width: 200px;" value=""></td>
              <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; text-align: left; width: 200px;" value=""></td>
            </tr>
          </table>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
                  <h3 class="box-title">Data Siswa</h3>
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
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>TTL</th>
                        <th>Asal Sekolah</th>
                        <th>Pilih Jurusan</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $data_siswa_query = $koneksi->query("SELECT * FROM siswa,jurusan WHERE siswa.pilih_jurusan=jurusan.id_jurusan ORDER BY nama");
                        while($data_siswa = $data_siswa_query->fetch_object()){
                        $jenis_kelamin = ($data_siswa->jenis_kelamin=="L"?"Laki-Laki":"Perempuan");
                          ?>
                          <tr>
                            <td style="width: 10px"><?= $no ?></td>
                            <td><?= $data_siswa->nama ?></td>
                            <td><?= $jenis_kelamin ?></td>
                            <td><?= $data_siswa->alamat ?></td>
                            <td><?= $data_siswa->ttl ?></td>
                            <td><?= $data_siswa->asal_sekolah ?></td>
                            <td><?= $data_siswa->jurusan ?></td>
                            <td><?= $data_siswa->no_telp ?></td>
                            <td>
                            <a href="?menu=siswa&aksi=edit&id=<?= $data_siswa->id_siswa ?>" class="text-orange">
                              <i class="fa fa-pencil"></i>
                            </a> |
                            <?php if($level=="admin"){ ?>
                            <a href="proses_hapus_siswa.php?id=<?= $data_siswa->id_siswa ?>" class="text-red" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">
                              <i class="fa fa-trash"></i>
                            </a> | <?php } ?>
                            <a href="?menu=siswa&aksi=detail&id=<?= $data_siswa->id_siswa ?>" class="text-aqua">
                              <i class="fa fa-info"></i>
                            </a>
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
  <?php } ?>