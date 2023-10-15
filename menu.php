<?php
//created by dsyafaatul
$menu = (!empty($_GET['menu']))?$_GET['menu']:"";
switch($menu){
	case 'error404':
		include("error404.php");
		break;
	case "login":
		include("login.php");
		break;
	default:
		include("home.php");
}
?>