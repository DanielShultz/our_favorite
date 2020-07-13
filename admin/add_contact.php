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
    if (isset($_POST["contact_surname"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `contact` SET  `contact_surname` = '{$_POST['contact_surname']}',
                                                            `contact_name` = '{$_POST['contact_name']}',
                                                            `contact_secondname` = '{$_POST['contact_secondname']}',
                                                            `contact_phone` = '{$_POST['contact_phone']}',
                                                            `contact_email` = '{$_POST['contact_email']}',
                                                            `contact_status` = '{$_POST['contact_status']}' WHERE `contact_id`={$_GET['red_id']}");
      header('Location: ../user/contacts.php');
      }
      else{
        $contact_surname = $_POST['contact_surname'];
        $contact_name = $_POST['contact_name'];
        $contact_secondname = $_POST['contact_secondname'];
        $contact_phone = $_POST['contact_phone'];
        $contact_email = $_POST['contact_email'];
        $contact_status = $_POST['contact_status'];

        $upload_folder = "upload";
        $upload_folder = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME'])."/".$upload_folder;
        $contact_photo = $upload_folder .'/'.$_FILES['contact_photo']['name'];

        if(isset($_FILES) && $_FILES['contact_photo']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
        $photo_dir = dirname(__FILE__) ."/upload/".$_FILES['contact_photo']['name']; // Директория для размещения файла
        move_uploaded_file($_FILES['contact_photo']['tmp_name'], $photo_dir ); // Перемещаем файл в желаемую директорию
        echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
        }
        else{
        echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
        }

            // сохраняем данные
        $sql_select =  ("INSERT INTO contact (contact_surname,contact_name,contact_secondname,contact_phone,contact_email,contact_status,contact_photo) 
                                  VALUES ('$contact_surname','$contact_name','$contact_secondname','$contact_phone','$contact_email','$contact_status','$contact_photo')");
        $result = mysqli_query($link, $sql_select);

            // Проверяем, есть ли ошибки
        if ($result=='TRUE')
        {
          header('Location: ../user/contacts.php');
        }
        else {
        echo "Ошибка";
        };
      };
    }
    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT * FROM `contact` WHERE `contact_id`={$_GET['red_id']}");
      $contact = mysqli_fetch_array($sql);
    }
      ?>

<form action="" method="post" enctype="multipart/form-data">
<table>
  <tr>
    <td colspan="2">Добавить контакт</td>
  </tr>
  <tr>
    <td>Статус:</td>
    <td><input class="edit" name="contact_status" type="text" value='<?= isset($_GET['red_id']) ? $contact['contact_status'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Фамилия:</td>
    <td><input class="edit" name="contact_surname" type="text" value='<?= isset($_GET['red_id']) ? $contact['contact_surname'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Имя:</td>
    <td><input class="edit" name="contact_name" type="text" value='<?= isset($_GET['red_id']) ? $contact['contact_name'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Отчество:</td>
    <td><input class="edit" name="contact_secondname" type="text" value='<?= isset($_GET['red_id']) ? $contact['contact_secondname'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Номер телефона:</td>
    <td><input class="edit" name="contact_phone" type="tel" value='<?= isset($_GET['red_id']) ? $contact['contact_phone'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>E-mail:</td>
    <td><input class="edit" name="contact_email" type="email" value='<?= isset($_GET['red_id']) ? $contact['contact_email'] : ''; ?>'></td>
  </tr>
  <tr>
    <td>Фото:</td>
    <td>
      <input class="button" name="contact_photo" id="contact_photo" type="file">
    </td>
  </tr>
  <tr>
    <td colspan="2"><input class="button" type="submit" name="submit" value="Принять"></td>
  </tr>
</table>
</form>
    </body>
    </html>