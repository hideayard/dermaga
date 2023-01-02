<?php
	session_start();
	unset($_SESSION['i']);
	unset($_SESSION['u']);
	unset($_SESSION['e']);
	unset($_SESSION['t']);
	
	if(session_destroy())
	{
		// header("Location: login.php");
		// exit(); //hentikan eksekusi kode di login_proses.php
		echo "<script>alert('Log Out Berhasil');window.location='login.php';</script>";
	}
?>