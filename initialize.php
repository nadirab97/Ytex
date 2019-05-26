<?php
  ob_start(); // output buffering is turned on
  session_start();
  require_once('database.php');
  require_once('product.php');
  $errors = [];
?>
