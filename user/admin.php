    <html>
    <head>
      <link rel="stylesheet" href="../css/small_table.css">
      <link rel="stylesheet" href="../css/button.css">
      <link rel="stylesheet" href="../css/edit.css">
    </head>
<body>

<div class="wrapper">

<?php
  require '../parts/menu.php';
?>

<form action="../scripts/registration_test.php" method="post">
  <table>
    <tr>
      <td colspan='2'>Авторизация</td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input class="edit" name="user_email" type="text"></td>
    </tr>
    <tr>
      <td>Пароль</td>
      <td><input class="edit" name="user_password" type="password"></td>
    </tr>
    <tr>
      <td><input class="button" type="submit" name="submit" value="Войти"></td>
      <td><a class="button" href="registration.php">Зарегистрироваться</a></td>
    </tr>
  </table>
</form>

</div>

<?php
  require '../parts/footer.php';
?>

</body>
    </html>
