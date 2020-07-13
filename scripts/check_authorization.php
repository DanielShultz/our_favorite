<?php
session_start();
if (empty($_SESSION['user_email']) or empty($_SESSION['user_id']))
  {

  }
  else
  {
    require '../parts/admin_panel.php';
  }
 ?>