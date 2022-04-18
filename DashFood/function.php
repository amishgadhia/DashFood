<?php
session_start();
require 'connection.php';
$conn = Connect();


unset($_SESSION["cart"]);
?>
