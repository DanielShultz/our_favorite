<html lang="ru">
<head>
   <link rel="stylesheet" href="../css/big_table.css">
   <link rel="stylesheet" href="../css/button.css">
</head>
<body>
  <?php
    require '../parts/menu.php';

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `breed` WHERE `breed_id` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p></p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }
  ?>


  <table>
    <tr>
      <th>Порода</th>
      <th>Удаление</th>
      <th>Редактирование</th>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT * FROM breed');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['breed_name']}</td>" .
             "<td><a class='button' href='?del_id={$result['breed_id']}'>Удалить</a></td>" .
             "<td><a class='button' href=add_breed.php?red_id={$result['breed_id']}>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>

</body>
</html>