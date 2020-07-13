<html lang="ru">
<head>
   <link rel="stylesheet" href="../css/big_table.css">
   <link rel="stylesheet" href="../css/button.css">
   <link rel="stylesheet" href="../css/dogs.css">
</head>
<body>
<div class="wrapper">

    <?php
        require '../parts/menu.php';
    ?>

<div class='post-wrap'>
<?php
    if (isset($_GET['info_id'])) {
        $sql = mysqli_query($link, "SELECT * FROM `dog` LEFT OUTER JOIN `gender` ON dog_gender = gender_id
                                                        LEFT OUTER JOIN `breed` ON dog_breed = breed_id
                                                        WHERE `dog_breed`={$_GET['info_id']}");
    }
    else    $sql = mysqli_query($link, "SELECT * FROM `dog` LEFT OUTER JOIN `breed` ON dog_breed = breed_id
                                                            LEFT OUTER JOIN `gender` ON dog_gender = gender_id");
        while ($result = mysqli_fetch_array($sql)) {
        echo
    "<div class='post-item'>".
    	"<div class='item-content'>".
            "<div class='item-icon'>
                <img src=$result[dog_photo] width=300>
            </div>".
    		"<div class='item-body'>".
    			"<h3>{$result['gender_name']} {$result['breed_name']} <br> {$result['dog_name']}</h3>".
    		"</div>".
    		    "<div class='item-footer'>".
                "<a class='link' href=../user/dog.php?info_id={$result['dog_id']}><span>Подробнее</span></a>".
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