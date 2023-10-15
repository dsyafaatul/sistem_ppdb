<?php
if(!isset($koneksi)){
  header("Location: index.php");
}else{
  $jumlah = $koneksi->query("SELECT (SELECT COUNT(*) FROM siswa) as siswa,(SELECT COUNT(*) FROM user) as user")->fetch_object();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Selamat datang! di Sistem Penerimaan Peserta Didik Baru</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> Home</li>
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
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlah->siswa ?></h3>

              <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="?menu=siswa" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?= $jumlah->user ?></h3>

              <p>Jumlah User</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-circle-o"></i>
            </div>
            <a href="?menu=user" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <?php $tahun = (!empty($_GET['tahun']))?(int)$_GET['tahun']:date("Y"); ?>
      <div class="row">
        <div class="col-md-7 connectedSortable">
          <div class="box box-primary">
            <div class="box-header ">
              <h3 class="box-title">Jumlah Peserta Didik Baru Tahun <?= $tahun ?></h3>
            </div>
            <div class="box-body">
              <form action="index.php" method="GET" name="form_tahun">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <!-- <input type="text" name="tahun_ajaran" placeholder="Masukan Tahun" class="form-control" id="tahun" data-mask> -->
                  <select class="form-control select2" name="tahun" onchange="form_tahun.submit()">
                  <?php
                  $data_tahun_query = $koneksi->query("SELECT tahun_ajaran FROM siswa GROUP BY tahun_ajaran ORDER BY tahun_ajaran DESC");
              while($data_tahun_result = $data_tahun_query->fetch_object()){
              ?>
                <option value="<?= $data_tahun_result->tahun_ajaran ?>" <?= ($data_tahun_result->tahun_ajaran==$tahun)?"selected":"" ?>><?= $data_tahun_result->tahun_ajaran ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
              </div>
              </form>
              <div class="chart" id="bar-chart" style="height: 200px;width: 100%;"></div>
            </div>
          </div>
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Siswa</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-min" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Jurusan</th>
                    <th>Laki-Laki</th>
                    <th>Perempuan</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $total_laki2 = 0;
                  $total_perempuan = 0;
                  $total_jumlah = 0;
                  $data_siswa_query = $koneksi->query("SELECT jurusan, SUM(case WHEN jenis_kelamin='L' then 1 else 0 end) as laki2, SUM(case WHEN jenis_kelamin='P'  then 1 else 0 end) as perempuan, COUNT(siswa.id_siswa) as jumlah FROM siswa RIGHT JOIN jurusan ON siswa.pilih_jurusan = jurusan.id_jurusan WHERE tahun_ajaran='$tahun' GROUP BY id_jurusan");
                    while($data_siswa = $data_siswa_query->fetch_object()){
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_siswa->jurusan ?></td>
                        <td><?= $data_siswa->laki2 ?></td>
                        <td><?= $data_siswa->perempuan ?></td>
                        <td><?= $data_siswa->jumlah ?></td>
                      </tr>
                      <?php
                      $no++;
                      $total_laki2 += $data_siswa->laki2;
                      $total_perempuan += $data_siswa->perempuan;
                      $total_jumlah += $data_siswa->jumlah;
                    }
                    ?>
                </tbody>
                <tfooter>
                  <tr>
                    <th colspan="2">Total :</th>
                    <th><?= $total_laki2 ?></th>
                    <th><?= $total_perempuan ?></th>
                    <th><?= $total_jumlah ?></th>
                  </tr>
                </tfooter>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-5 connectedSortable">
          <div class="box box-info">
            <div class="box-header ">
              <h3 class="box-title">Statistik Jumlah Peserta Didik Baru Pertahun</h3>
            </div>
            <div class="box-body">
              <div class="chart" id="line-chart" style="height: 200px;width: 100%;"></div>
            </div>
          </div>
          <div class="box box-warning">
            <div class="box-header ">
              <h3 class="box-title">Statistik Jumlah Peserta Didik Baru Pertahun</h3>
            </div>
            <div class="box-body">
              <div class="chart" id="donut-chart" style="height: 200px;width: 100%;"></div>
            </div>
          </div>
        </div>
        <?php
        $data_bar_chart_query = $koneksi->prepare("SELECT jurusan.jurusan,COUNT(siswa.id_siswa) as jumlah FROM siswa RIGHT JOIN jurusan ON siswa.pilih_jurusan=jurusan.id_jurusan WHERE siswa.tahun_ajaran=? GROUP BY jurusan.jurusan ORDER BY jurusan");
        $data_bar_chart_query->bind_param("i",$tahun);
        $data_bar_chart_query->execute();
        $result = $data_bar_chart_query->get_result();
        $data_bar_chart = "[";
        $nama_jurusan = "";
        while($data_chart_result = $result->fetch_object()){
          $pisah = explode(" ",$data_chart_result->jurusan);
          foreach($pisah as $value){
            $substr = substr($value,0,1);
            $nama_jurusan .= $substr;
          }
          $data_bar_chart .= "{y : '".$nama_jurusan."', jumlah : ".$data_chart_result->jumlah."},
          ";
          $nama_jurusan = "";
        }
        $data_bar_chart .= "]";
        //
        $data_line_chart_query = $koneksi->prepare("SELECT tahun_ajaran,COUNT(*) as jumlah FROM siswa GROUP BY tahun_ajaran ORDER BY tahun_ajaran");
        $data_line_chart_query->execute();
        $result = $data_line_chart_query->get_result();
        $data_line_chart = "[";
        while($data_chart_result = $result->fetch_object()){
          $data_line_chart .= "{y : '".$data_chart_result->tahun_ajaran."', jumlah : ".$data_chart_result->jumlah."},
          ";
        }
        $data_line_chart .= "]";
        //
        $data_donut_chart_query = $koneksi->prepare("SELECT jurusan,COUNT(*) as jumlah FROM siswa,jurusan WHERE siswa.pilih_jurusan=jurusan.id_jurusan GROUP BY pilih_jurusan");
        // $data_donut_chart_query->bind_param("i",$tahun);
        $data_donut_chart_query->execute();
        $result = $data_donut_chart_query->get_result();
        $data_dount_chart = "[";
        while($data_chart_result = $result->fetch_object()){
          $data_dount_chart .= "{label : '".$data_chart_result->jurusan."', value : ".$data_chart_result->jumlah."},
          ";
        }
        $data_dount_chart .= "]";
        ?>
        <script>
          $(function(){
          //BAR CHART
          var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: <?= $data_bar_chart ?>,
            barColors: ['#00a65a'],
            xkey: 'y',
            ykeys: ['jumlah'],
            labels: ['Jumlah Siswa'],
            hideHover: 'auto'
          });
          // LINE CHART
          var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
             data: <?= $data_line_chart ?>,
            xkey: 'y',
            ykeys: ['jumlah'],
            labels: ['Jumlah Siswa'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
          });
          //DONUT CHART
          var donut = new Morris.Donut({
            element: 'donut-chart',
            resize: true,
            colors: ["#3c8dbc", "#f56954", "#00a65a"],
            data: <?= $data_dount_chart ?>,
            hideHover: 'auto'
          });
          })
        </script>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php } ?>