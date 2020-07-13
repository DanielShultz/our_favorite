<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform')
      {
       if (session_id() == "")
       {
          session_start();
       }
       unset($_SESSION['user_email']);
       unset($_SESSION['user_id']);
       header('Location: ./index.php');
       exit;
      }
?>
