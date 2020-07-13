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
      $sql = mysqli_query($link, "DELETE FROM `contact` WHERE `contact_id` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p></p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }
  ?>

  <table>
    <tr>
      <th>Фамилия</th>
      <th>Имя</th>
      <th>Отчество</th>
      <th>Удаление</th>
      <th>Редактирование</th>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT * FROM contact');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['contact_surname']}</td>" .
             "<td>{$result['contact_name']}</td>" .
             "<td>{$result['contact_secondname']}</td>" .
             "<td><a class='button' href='?del_id={$result['contact_id']}'>Удалить</a></td>" .
             "<td><a class='button' href=add_contact.php?red_id={$result['contact_id']}>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>

</body>
</html>