<?php
include('./classes/DB.php');
include('./classes/Login.php');


if (Login::isLoggedin()) {
	echo " logged in";
	
} else {
	echo "Not logged in";
}




?>