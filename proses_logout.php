<?php
//created by dsyafaatul
	include("koneksi.php");
	session_destroy();
	$koneksi->close();
	header("Location: index.php?menu=login");
?>