<?php
//created by dsyafaatul
include("../koneksi.php");
$nama = $_POST['nama'];
$username = $_POST['username'];
$level = $_POST['level'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$action = $_POST['action'];
if(!empty($action) AND !empty($nama) AND !empty($username) AND !empty($password)){
  	$tambah_user_sql = $koneksi->query("INSERT INTO user VALUES('','$nama','$username','$password','$level')");
  	if($tambah_user_sql){
  		header("location: index.php?menu=user&aksi=tambah&alert=success");
  	}else{
  		header("location: index.php?menu=user&aksi=tambah&alert=error");
  	}
}else{
	header("location: index.php?menu=user&aksi=tambah&alert=error");
}
$koneksi->close();
?>