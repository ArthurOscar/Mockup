<?php
include '../src/auth.php';

session_start();
$auth = new Auth();

$auth -> logout();

?>