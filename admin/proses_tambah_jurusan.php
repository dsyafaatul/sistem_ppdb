<?php
//created by dsyafaatul
include("../koneksi.php");
$jurusan = $_POST['jurusan'];
$action = $_POST['action'];
if(!empty($action) AND !empty($jurusan)){
  	$tambah_jurusan_sql = $koneksi->query("INSERT INTO jurusan VALUES('','$jurusan')");
  	if($tambah_jurusan_sql){
  		header("location: index.php?menu=jurusan&aksi=tambah&alert=success");
  	}else{
  		header("location: index.php?menu=jurusan&aksi=tambah&alert=error");
  	}
}else{
	header("location: index.php?menu=jurusan&aksi=tambah&alert=error");
}
$koneksi->close();
?>