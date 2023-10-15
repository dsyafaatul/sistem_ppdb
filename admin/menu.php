<?php
$menu = (!empty($_GET['menu']))?$_GET['menu']:"";
switch($menu){
	case 'error404':
		include("error404.php");
		break;
	case 'siswa':
		include("siswa.php");
		break;
	case 'jurusan':
		include("jurusan.php");
		break;
	case 'user':
		include("user.php");
		break;
	case 'laporan':
		include("laporan.php");
		break;
	case "profile":
		include("profile.php");
		break;
	default:
		include("home.php");
}
?>