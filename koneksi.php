<?php
//created by dsyafaatul
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "db_siswa";
// error_reporting(E_NOTICE ^(E_NOTICE | E_WARNING));
$koneksi = new mysqli($host,$user,$password,$db);
if($koneksi->connect_errno){
	die("Koneksi Error : ".$koneksi->connect_errno." - ".$koneksi->connect_error);
}
/* function anti_injection($data){
	$filter=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter;
} */
?>