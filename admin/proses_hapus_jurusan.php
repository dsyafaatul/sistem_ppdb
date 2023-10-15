<?php
//created by dsyafaatul
include("../koneksi.php");
$id_jurusan = $_GET['id'];
if(!empty($id_jurusan)){
	$hapus_jurusan_query = $koneksi->prepare("DELETE FROM jurusan WHERE id_jurusan=?");
	$hapus_jurusan_query->bind_param("s",$id_jurusan);
	$hapus_jurusan_query->execute();
	if($hapus_jurusan_query){
		header("location: index.php?menu=jurusan&alert=success");
	}else{
		header("location: index.php?menu=jurusan&alert=error");
	}
}else{
	header("location: index.php?menu=jurusan&alert=error");
}
$koneksi->close();
?>