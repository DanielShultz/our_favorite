<html lang="ru">
<head>
   <link rel="stylesheet" href="../css/header.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
  <?php
    require '../scripts/check_authorization.php';
    require '../scripts/connect.php';
  ?>
<header>
  <form class="logout" name="logoutform" method="post" action="./index.php" style="display:inline">
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform')
       {
        if (session_id() == "")
        {
           session_start();
        }
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        header('Location: ../user/admin.php');
        exit;
       }
      if (empty($_SESSION['user_email']) or empty($_SESSION['user_id']))
        {
          printf("Неавторизован
          <input type='hidden' name='form_name' value='logoutform'>
          <input type='submit' name='logout' value='Войти'>"
        );
        }
        else
        {
          printf("".$_SESSION['user_email']."
          <input type='hidden' name='form_name' value='logoutform'>
          <input type='submit' name='logout' value='Выйти'>"
        );
        }
    ?>
  </form>
  <a href="../index.php" class="logo">
    <object type="image/svg+xml" data="picture.svg">
      <img src="../css/logo.svg">
    </object>
  </a>
  <nav>
    <ul class="topmenu">
      <li><a href="../user/index.php">Главная</a></li>
      <li><a href="../user/dogs.php" class="submenu-link">Собаки</a>
        <ul class="submenu">
          <?php
            $sql = mysqli_query($link, 'SELECT * FROM `breed`');
            while ($result = mysqli_fetch_array($sql)) {
              echo '<tr>' .
              "<li><a href=../user/dogs.php?info_id={$result['breed_id']}>{$result['breed_name']}</a></li>";
            }
          ?>
        </ul>
      </li>
      <li><a href="../user/contacts.php">Контакты</a></li>
    </ul>
  </nav>
</header>
</body>
</html>
