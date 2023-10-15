<?php
//created by dsyafaatul
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=LAPORAN ".strtoupper("PPDB ").".xls");
include('../koneksi.php');
?>
<table border="1">
<thead>
  <tr>
    <th style="width: 10px">#</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Asal Sekolah</th>
    <th>Pilih Jurusan</th>
    <th>No Telepon</th>
    <th>Nama Ayah</th>
    <th>Nama Ibu</th>
    <th>pekerjaan Ayah</th>
    <th>pekerjaan Ibu</th>
    <th>Anak Ke</th>
    <th>Tahun Pelajaran</th>
  </tr>
</thead>
<tbody>
  <?php
  $no = 1;
  $data_siswa_query = $koneksi->query("SELECT * FROM siswa,jurusan WHERE siswa.pilih_jurusan=jurusan.id_jurusan ORDER BY id_siswa");
    while($data_siswa = $data_siswa_query->fetch_object()){
    $jenis_kelamin = ($data_siswa->jenis_kelamin=="L"?"Laki-Laki":"Perempuan");
    $pisah = explode(",", $data_siswa->ttl);
    $tempat_lahir = $pisah[0];
    $tanggal_lahir = $pisah[1];
      ?>
      <tr>
        <td style="width: 10px"><?= $no ?></td>
        <td><?= $data_siswa->nama ?></td>
        <td><?= $jenis_kelamin ?></td>
        <td><?= $data_siswa->alamat ?></td>
        <td><?= $tempat_lahir ?></td>
        <td><?= $tanggal_lahir ?></td>
        <td><?= $data_siswa->asal_sekolah ?></td>
        <td><?= $data_siswa->jurusan ?></td>
        <td>'<?= $data_siswa->no_telp ?></td>
        <td><?= $data_siswa->nama_ayah ?></td>
        <td><?= $data_siswa->nama_ibu ?></td>
        <td><?= $data_siswa->pekerjaan_ayah ?></td>
        <td><?= $data_siswa->pekerjaan_ibu ?></td>
        <td><?= $data_siswa->anak_ke ?></td>
        <td><?= $data_siswa->tahun_ajaran ?></td>
      </tr>
      <?php
      $no++;
    }
    ?>
</tbody>
</table>