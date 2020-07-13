<html>
    <head>
      <link rel="stylesheet" href="../css/small_table.css">
      <link rel="stylesheet" href="../css/button.css">
      <link rel="stylesheet" href="../css/edit.css">
    </head>
    <body>
<div class="wrapper">

<?php require '../parts/menu.php';?>

<form action="../scripts/save_user.php" method="post">
<table>
  <tr>
    <td colspan="2">Регистрация</td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td><input class="edit" name="user_email" type="email"></td>
  </tr>
  <tr>
    <td>Пароль:</td>
    <td><input class="edit" name="user_password" type="password"></td>
  </tr>
  <tr>
    <td>Подтвердите пароль:</td>
    <td><input class="edit" name="user_confirmpassword" type="password"></td>
  </tr>
  <tr>
    <td colspan="2"><input class="button" type="submit" name="submit" value="Зарегистрироваться"></td>
  </tr>
</table>
</form>
</div>

<?php require '../parts/footer.php';?>

</body>
</html>
