<html lang="ru">
<head>
    <link rel="stylesheet" href="../css/contacts.css">
</head>
<body>
<div class="wrapper">

    <?php
        require '../parts/menu.php';
    ?>

    <div class='post-wrap'>

        <?php
            $sql = mysqli_query($link, "SELECT * FROM `contact`");
            while ($result = mysqli_fetch_array($sql)) {
            echo
            "<div class='post-item'>".
                "<div class='card'>".
                    "<img src=$result[contact_photo] style='width:100%'>".
                    "<div class='container'>".
                        "<h4><b>{$result['contact_status']}</b></h4>".
                        "<p>{$result['contact_surname']} {$result['contact_name']} {$result['contact_secondname']}".
                        "<br>Номер телефона: {$result['contact_phone']}".
                        "<br>E-mail: {$result['contact_email']}".
                        "</p>".
                    "</div>".
                "</div>".
            "</div>";
            }
        ?>

    </div>

</div>

    <?php
        require '../parts/footer.php';
    ?>

</body>
</html>