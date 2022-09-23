<?php
@session_start();

if (empty($_SESSION['active'])) {
  header("location:" . dirname(dirname(__DIR__)) . '/index.php');
} else if ($_SESSION['rol'] > 2) {
  session_destroy();
  header("location:" . dirname(dirname(__DIR__)) . '/index.php');
} else if (isset($_SESSION["timeout"])) {
  $inactividad = 1500;
  $sessionTTL = time() - $_SESSION["timeout"];
  if ($sessionTTL > $inactividad) {
    session_destroy();
    header("location:" . dirname(dirname(__DIR__)) . '/index.php');
  }
}
