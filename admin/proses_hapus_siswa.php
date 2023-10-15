<?php
//created by dsyafaatul
include("../koneksi.php");
$id_siswa = $_GET['id'];
if(!empty($id_siswa)){
	$hapus_siswa_query = $koneksi->prepare("DELETE FROM siswa WHERE id_siswa=?");
	$hapus_siswa_query->bind_param("s",$id_siswa);
	$hapus_siswa_query->execute();
	if($hapus_siswa_query){
		header("location: index.php?menu=siswa&alert=success");
	}else{
		header("location: index.php?menu=siswa&alert=error");
	}
}else{
	header("location: index.php?menu=siswa&alert=error");
}
$koneksi->close();
?>