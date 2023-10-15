<?php
//created by dsyafaatul
include("../koneksi.php");
$jumlah = $koneksi->query("SELECT * FROM siswa");
$id_siswa = $jumlah->num_rows.date("Ymd");
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$tempat_lahir = $_POST['tempat_lahir'];
$ttl = $tempat_lahir.", ".$tanggal_lahir;
$asal_sekolah = $_POST['asal_sekolah'];
$pilih_jurusan = $_POST['pilih_jurusan'];
$no_telp = (is_numeric($_POST['no_telp']))?$_POST['no_telp']:header("location: index.php?menu=siswa&alert=error");
$nama_ayah = $_POST['nama_ayah'];
$nama_ibu = $_POST['nama_ibu'];
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
$anak_ke = (is_numeric($_POST['anak_ke']))?$_POST['anak_ke']:header("location: index.php?menu=siswa&alert=error");
$tahun_ajaran = (!empty($_POST['tahun_ajaran']))?$_POST['tahun_ajaran']:date("Y");
$action = $_POST['action'];
if(!empty($action) AND !empty($nama) AND !empty($jenis_kelamin) AND !empty($alamat) AND !empty($tanggal_lahir) AND !empty($tempat_lahir) AND !empty($asal_sekolah) AND !empty($pilih_jurusan) AND !empty($nama_ayah) AND !empty($nama_ibu) AND !empty($pekerjaan_ayah) AND !empty($pekerjaan_ibu) AND !empty($anak_ke)){
  	$tambah_siswa_sql = $koneksi->prepare("INSERT INTO siswa VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  	$tambah_siswa_sql->bind_param("isssssisssssis",$id_siswa,$nama,$jenis_kelamin,$alamat,$ttl,$asal_sekolah,$pilih_jurusan,$no_telp,$nama_ayah,$nama_ibu,$pekerjaan_ayah,$pekerjaan_ibu,$anak_ke,$tahun_ajaran);
  	$tambah_siswa_sql->execute();
  	if($tambah_siswa_sql){
  		header("location: index.php?menu=siswa&aksi=formulir&id=$id_siswa&alert=success");
  	}else{
  		header("location: index.php?menu=siswa&aksi=tambah&alert=error");
  	}
}else{
	header("location: index.php?menu=siswa&aksi=tambah&alert=error");
}
$koneksi->close();
?>