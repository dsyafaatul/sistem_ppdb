<?php
//created by dsyafaatul
include("../koneksi.php");
$id_user = $_GET['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$action = $_POST['action'];
if(!empty($action) AND !empty($nama) AND !empty($username) AND !empty($level)){
  if(!empty($password)){
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  	$edit_user_query = $koneksi->prepare("UPDATE user SET nama=?,username=?,password=?,level=? WHERE id_user=?");
  	$edit_user_query->bind_param("ssssi",$nama,$username,$password,$level,$id_user);
  }else{
    $edit_user_query = $koneksi->prepare("UPDATE user SET nama=?,username=?,level=? WHERE id_user=?");
    $edit_user_query->bind_param("sssi",$nama,$username,$level,$id_user);
  }
  	$edit_user_query->execute();
  	if($edit_user_query){
  		header("location: index.php?menu=user&aksi=edit&id=$id_user&alert=success");
  	}else{
  		header("location: index.php?menu=user&aksi=edit&id=$id_user&alert=error");
  	}
}else{
	header("location: index.php?menu=user&aksi=edit&id=$id_user&alert=error");
}
$koneksi->close();
?>