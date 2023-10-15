<?php
//created by dsyafaatul
	include("koneksi.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	$action = $_POST['action'];
	if(!empty($action)){
		if(!empty($username) AND !empty($password)){
			$login_query = $koneksi->prepare("SELECT * FROM user WHERE username=?");
			$login_query->bind_param("s",$username);
			$login_query->execute();
			$row = $login_query->get_result();
			if($row->num_rows>0){
				$result = $row->fetch_object();
				if(password_verify($password,$result->password)){
					$_SESSION['id_user'] = $result->id_user;
					$_SESSION['username'] = $result->username;
					$_SESSION['level'] = $result->level;
					$koneksi->close();
					header("location: admin/index.php");
				}else{
					header("Location: index.php?menu=login&alert=error2");
				}
			}else{
				header("Location: index.php?menu=login&alert=error1");
			}
		}else{
			header("Location: index.php?menu=login&alert=error1");
		}
	}else{
		header("Location: index.php?menu=login&alert=error1");
	}
	$koneksi->close();
?>