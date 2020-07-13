<?php

    require 'connect.php';

    if (isset($_POST['user_email'])) { $user_email= $_POST['user_email']; if ($user_email == '') { unset($user_email);} }
    //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    $user_password = $_POST['user_password'];
    $user_confirmpassword = $_POST['user_confirmpassword'];
    if ($user_password != $user_confirmpassword)
    {
       $error_message = 'Пароль и подтверждение пароля не совпадают';
    }
    else
    {
      if (isset($_POST['user_password'])) { $user_password=$_POST['user_password']; if ($user_password =='') { unset($user_password);} }
    }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (empty($user_email) or empty($user_password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $user_email = stripslashes($user_email);
    $user_email = htmlspecialchars($user_email);
    $user_password = stripslashes($user_password);
    $user_password = htmlspecialchars($user_password);
    //удаляем лишние пробелы
    $user_email = trim($user_email);
    $user_password = trim($user_password);
    // проверка на существование пользователя с таким же логином
    $sql_select = ("SELECT user_id FROM user WHERE user_email='$user_email'");
    $result = mysqli_query($link, $sql_select);
    $row = mysqli_fetch_array($result);
    if (!empty($row['user_id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
    // если такого нет, то сохраняем данные
    $sql_select =  ("INSERT INTO user (user_email,user_password) VALUES ('$user_email','$user_password')");
    $result = mysqli_query($link, $sql_select);
    // Проверяем, есть ли ошибки
    if ($result=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='authorization.php'>Главная страница</a>";
    }
    else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
    ?>
