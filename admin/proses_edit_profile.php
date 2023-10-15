<?php
//created by dsyafaatul
include("../koneksi.php");
$id_user = $_SESSION['id_user'];
$nama = $_POST['nama'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nama)){
		$edit_user_query = $koneksi->prepare("UPDATE user SET nama=? WHERE id_user=?");
		$edit_user_query->bind_param("ss",$nama,$id_user);
		$edit_user_query->execute();
		if($edit_user_query){
			header("location: index.php?menu=profile&alert=success");
		}else{
			header("location: index.php?menu=profile&alert=error");
		}
	}else{
		header("location: index.php?menu=profile&alert=error");
	}
}else{
	header("location: index.php?menu=profile&alert=error");
}
$koneksi->close();
?>