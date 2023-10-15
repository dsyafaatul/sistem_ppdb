<?php
//created by dsyafaatul
include("../koneksi.php");
$id_user = $_GET['id'];
if(!empty($id_user)){
	$hapus_siswa_query = $koneksi->prepare("DELETE FROM user WHERE id_user=?");
	$hapus_siswa_query->bind_param("i",$id_user);
	$hapus_siswa_query->execute();
	if($hapus_siswa_query){
		header("location: index.php?menu=user&alert=success");
	}else{
		header("location: index.php?menu=user&alert=error");
	}
}else{
	header("location: index.php?menu=user&alert=error");
}
$koneksi->close();
?>