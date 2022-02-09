<?php

session_start();

if( isset( $_SESSION['access'] ) || $_SESSION['access'] == true ){
	unset($_SESSION['access']);
	session_destroy();
    header("location: ../index.php");
}

?>