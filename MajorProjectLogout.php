<?php
session_start();
$_SESSION= array(); //unset all session variables at once disabling session
session_destroy();
header("Location:Login.php")
?>