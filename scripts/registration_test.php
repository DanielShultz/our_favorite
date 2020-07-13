<?php

    require 'connect.php';

    session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['user_email'])) { $user_email = $_POST['user_email']; if ($user_email == '') { unset($user_email);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['user_password'])) { $user_password=$_POST['user_password']; if ($user_password =='') { unset($user_password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($user_email) or empty($user_password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $user_email = stripslashes($user_email);
    $user_email = htmlspecialchars($user_email);
    $user_password = stripslashes($user_password);
    $user_password = htmlspecialchars($user_password);
//удаляем лишние пробелы
    $user_email = trim($user_email);
    $user_password = trim($user_password);
// подключаемся к базе

    $sql_select = ("SELECT * FROM user WHERE user_email='$user_email'");
    $result = mysqli_query($link, $sql_select);
    $row = mysqli_fetch_array($result);
    if (empty($row['user_email']))
    {
    //если пользователя с введенным логином не существует
    exit ("Извините, введённый вами login или пароль неверный.");
    }
    else {
    //если существует, то сверяем пароли
    if ($row['user_password']==$user_password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['user_email']=$row['user_email'];
    $_SESSION['user_id']=$row['user_id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
    header('Location: ../index.php');
    }
    else {
    //если пароли не сошлись

    exit ("Извините, введённый вами login или пароль неверный.");
    }
    }
    ?>
