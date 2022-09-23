<?php
@session_start();

if (empty($_SESSION['active'])) {
  header("location: /index.php");
}

if ($_SESSION['rol'] > 2) {
  session_destroy();
  header("location: /index.php");
}

if (isset($_SESSION["timeout"])) {
  $inactividad = 1500;
  $sessionTTL = time() - $_SESSION["timeout"];

  if ($sessionTTL > $inactividad) {
    session_destroy();
    header("location: /index.php");
  }
}

/* @session_start();
if (empty($_SESSION['active']) || time() - $_SESSION['time'] > 5600) {
  session_destroy();
  echo "<script> window.location='/index.php'; </script>";
  exit();
} else
  @session_start(); */
