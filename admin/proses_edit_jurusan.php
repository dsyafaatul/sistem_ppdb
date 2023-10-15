<?php
//created by dsyafaatul
include("../koneksi.php");
$id_jurusan = $_GET['id'];
$jurusan = $_POST['jurusan'];
$action = $_POST['action'];
if(!empty($action) AND !empty($jurusan)){
  	$edit_user_query = $koneksi->prepare("UPDATE jurusan SET jurusan=? WHERE id_jurusan=?");
  	$edit_user_query->bind_param("si",$jurusan,$id_jurusan);
  	$edit_user_query->execute();
  	if($edit_user_query){
  		header("location: index.php?menu=jurusan&aksi=edit&id=$id_jurusan&alert=success");
  	}else{
  		header("location: index.php?menu=jurusan&aksi=edit&id=$id_jurusan&alert=error");
  	}
}else{
	header("location: index.php?menu=jurusan&aksi=edit&id=$id_jurusan&alert=error");
}
$koneksi->close();
?>