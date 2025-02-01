<?php
session_start();
require '../includes/auth.php';

$auth = new Auth();
$auth->logout();

header("Location: login.php");
exit();
?>