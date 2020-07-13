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
    if (isset($_POST["dog_name"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `dog` SET  `dog_name` = '{$_POST['dog_name']}',
                                                        `dog_date` = '{$_POST['dog_date']}',
                                                        `dog_titles` = '{$_POST['dog_titles']}',
                                                        `dog_tests` = '{$_POST['dog_tests']}',
                                                        `dog_breeder` = '{$_POST['dog_breeder']}',
                                                        `dog_owner` = '{$_POST['dog_owner']}',
                                                        `dog_breed` = '{$_POST['dog_breed']}',
                                                        `dog_gender` = '{$_POST['dog_gender']}' WHERE `dog_id`={$_GET['red_id']}");
      header('Location: ../user/dogs.php');
      }
      else{
        $dog_name = $_POST['dog_name'];
        $dog_date = $_POST['dog_date'];
        $dog_titles = $_POST['dog_titles'];
        $dog_tests = $_POST['dog_tests'];
        $dog_breeder = $_POST['dog_breeder'];
        $dog_owner = $_POST['dog_owner'];
        $dog_breed = $_POST['dog_breed'];
        $dog_gender = $_POST['dog_gender'];

        $upload_folder = "upload";
        $upload_folder = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME'])."/".$upload_folder;
        $dog_photo = $upload_folder .'/'.$_FILES['dog_photo']['name'];

        if(isset($_FILES) && $_FILES['dog_photo']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
        $photo_dir = dirname(__FILE__) ."/upload/".$_FILES['dog_photo']['name']; // Директория для размещения файла
        move_uploaded_file($_FILES['dog_photo']['tmp_name'], $photo_dir ); // Перемещаем файл в желаемую директорию
        echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
        }
        else{
        echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
        }

            // сохраняем данные
        $sql_select =  ("INSERT INTO dog (dog_name,dog_date,dog_titles,dog_tests,dog_breeder,dog_owner,dog_breed,dog_gender,dog_photo) 
                                  VALUES ('$dog_name','$dog_date','$dog_titles','$dog_tests','$dog_breeder','$dog_owner','$dog_breed','$dog_gender','$dog_photo')");
        $result = mysqli_query($link, $sql_select);

            // Проверяем, есть ли ошибки
        if ($result=='TRUE')
        {
          header('Location: ../user/dogs.php');
        }
        else {
        echo "Ошибка";
        };
      }
      //Если вставка прошла успешно
      if ($sql) {
        header('Location: ../user/dogs.php');
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT * FROM `dog` WHERE `dog_id`={$_GET['red_id']}");
      $dog = mysqli_fetch_array($sql);
    }
      ?>

<form action="" method="post" enctype="multipart/form-data">
<table>
  <tr>
    <td colspan="2">Добавить собаку</td>
  </tr>
  <tr>
    <td>Кличка:</td>
    <td><input class="edit" name="dog_name" type="text" value='<?= isset($_GET['red_id']) ? $dog['dog_name'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Дата рождения:</td>
    <td><input class="edit" name="dog_date" type="date" value='<?= isset($_GET['red_id']) ? $dog['dog_date'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Титулы</td>
    <td><input class="edit" name="dog_titles" type="text" value='<?= isset($_GET['red_id']) ? $dog['dog_titles'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Тесты</td>
    <td><input class="edit" name="dog_tests" type="text" value='<?= isset($_GET['red_id']) ? $dog['dog_tests'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Заводчик</td>
    <td><input class="edit" name="dog_breeder" type="text" value='<?= isset($_GET['red_id']) ? $dog['dog_breeder'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Владелец</td>
    <td><input class="edit" name="dog_owner" type="text" value='<?= isset($_GET['red_id']) ? $dog['dog_owner'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Порода:</td>
    <td>
      <div class="dropdown">
        <select class="dropdown-select" name="dog_breed" value='<?= isset($_GET['red_id']) ? $dog['dog_breed'] : ''; ?>'>
            <?php
            $sql = mysqli_query($link, 'SELECT * FROM `breed`');
            while ($result = mysqli_fetch_array($sql)) {
              echo "<option value={$result['breed_id']}>{$result['breed_name']}</option>" ;
            }
            ?>
          </select>
        </div>
    </td>
  </tr>
  <tr>
    <td>Пол:</td>
    <td>
      <div class="dropdown">
        <select class="dropdown-select" name="dog_gender" value='<?= isset($_GET['red_id']) ? $dog['dog_gender'] : ''; ?>'>
            <?php
            $sql = mysqli_query($link, 'SELECT * FROM `gender`');
            while ($result = mysqli_fetch_array($sql)) {
              echo "<option value={$result['gender_id']}>{$result['gender_name']}</option>" ;
            }
            ?>
          </select>
        </div>
    </td>
  </tr>
  <tr>
    <td>Фото:</td>
    <td>
      <input class="button" name="dog_photo" id="dog_photo" type="file">
    </td>
  </tr>
  <tr>
    <td colspan="2"><input class="button" type="submit" name="submit" value="Принять"></td>
  </tr>
</table>
</form>
    </body>
    </html>