<html>
    <head>
      <link rel="stylesheet" href="../css/small_table.css">
      <link rel="stylesheet" href="../css/button.css">
      <link rel="stylesheet" href="../css/edit.css">
      <link rel="stylesheet" href="../css/select.css">
    </head>
    <body>

    <?php
        require '../parts/menu.php';

    //Если переменная name передана
    if (isset($_POST["breed_name"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `breed` SET  `breed_name` = '{$_POST['breed_name']}', WHERE `breed_id`={$_GET['red_id']}");
      header('Location: ../user/index.php');
      }
      else{
        $sql =  mysqli_query($link, "INSERT INTO breed (breed_name) VALUES ('{$_POST['breed_name']}')");
        // Проверяем, есть ли ошибки
          if ($sql=='TRUE')
            {
              header('Location: ../user/index.php');
            }
            else {
              echo "Ошибка";
            };
      };
    }
    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT * FROM `breed` WHERE `breed_id`={$_GET['red_id']}");
      $breed = mysqli_fetch_array($sql);
    }
      ?>

<form action="" method="post" enctype="multipart/form-data">
<table>
  <tr>
    <td colspan="2">Добавить породу</td>
  </tr>
  <tr>
    <td>Название:</td>
    <td><input class="edit" name="breed_name" type="text" value='<?= isset($_GET['red_id']) ? $breed['breed_name'] : ''; ?>'></td>
  </tr>
  <tr>
    <td colspan="2"><input class="button" type="submit" name="submit" value="Принять"></td>
  </tr>
</table>
</form>
    </body>
    </html>