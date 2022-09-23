<?php
@session_start();

if (empty($_SESSION['active'])) {
  var_dump(1);
  header("location: /index.php");
}

if ($_SESSION['rol'] > 2) {
  session_destroy();
  var_dump(2);
  header("location: /index.php");
}

if (isset($_SESSION["timeout"])) {
  $inactividad = 1500;
  $sessionTTL = time() - $_SESSION["timeout"];

  if ($sessionTTL > $inactividad) {
    session_destroy();
    var_dump(3);
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
