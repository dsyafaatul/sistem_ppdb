<?php
//created by dsyafaatul
include("../koneksi.php");
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];
$password_baru_ulang = $_POST['password_baru_ulang'];
$id_user = $_SESSION['id_user'];
$action = $_POST['action'];
	if(!empty($action)){
		if(!empty($password_lama) AND !empty($password_baru) AND !empty($password_baru_ulang)){
			$data_user_query = $koneksi->prepare("SELECT * FROM user WHERE id_user=?");
			$data_user_query->bind_param("s",$id_user);
			$data_user_query->execute();
			$data_user = $data_user_query->get_result();
			if($data_user->num_rows>=1){
				if(password_verify($password_lama,$data_user->fetch_object()->password)){
					if($password_baru == $password_baru_ulang){
						$password_baru = password_hash($password_baru,PASSWORD_BCRYPT);
							$ganti_password_query = $koneksi->prepare("UPDATE user SET password=? WHERE id_user=?");
							$ganti_password_query->bind_param("ss",$password_baru,$id_user);
							$ganti_password_query->execute();
							if($ganti_password_query){
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