<?php
@session_start();

if (empty($_SESSION['active'])) {
  var_dump(1);
  echo "<script> window.location='/index.php'; </script>";
}

if ($_SESSION['rol'] > 2) {
  session_destroy();
  var_dump(2);
  echo "<script> window.location='/index.php'; </script>";
}

if (isset($_SESSION["timeout"])) {
  $inactividad = 1500;
  $sessionTTL = time() - $_SESSION["timeout"];

  if ($sessionTTL > $inactividad) {
    session_destroy();
    var_dump(3);
    echo "<script> window.location='/index.php'; </script>";
  }
}

/* @session_start();
if (empty($_SESSION['active']) || time() - $_SESSION['time'] > 5600) {
  session_destroy();
  echo "<script> window.location='/index.php'; </script>";
  exit();
} else
  @session_start(); */
