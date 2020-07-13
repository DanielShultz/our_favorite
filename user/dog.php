<html lang="ru">
<head>
   <link rel="stylesheet" href="../css/small_table.css">
   <link rel="stylesheet" href="../css/button.css">
	 <link rel="stylesheet" href="../css/photo.css">
</head>
<body>
<div class="wrapper">

<?php
  require '../parts/menu.php';

if (isset($_GET['info_id'])) {
  $sql = mysqli_query($link, "SELECT * FROM `dog`   LEFT OUTER JOIN `breed` ON dog_breed = breed_id 
                                                    LEFT OUTER JOIN `gender` ON dog_gender = gender_id
                                                    WHERE `dog_id`={$_GET['info_id']}");
  $dog = mysqli_fetch_array($sql);
}

if($dog)
{
	printf("
	<div class='post-wrap'>
   <img src=$dog[dog_photo] width=400>
  <div class='post-inner'>
      <h3>".$dog['dog_name'] ."</h3>
  </div>
		<table>
		<tr>
			<td>Дата рождения:</td>
			<td>".$dog['dog_date'] ."</td>
        </tr>
		<tr>
			<td>Титулы:</td>
			<td>".$dog['dog_titles'] ."</td>
        </tr>
		<tr>
			<td>Тесты:</td>
			<td>".$dog['dog_tests'] ."</td>
        </tr>
		<tr>
			<td>Заводчик:</td>
			<td>".$dog['dog_breeder'] ."</td>
        </tr>
		<tr>
			<td>Владелец:</td>
			<td>".$dog['dog_owner'] ."</td>
        </tr>
		<tr>
			<td>Порода:</td>
			<td>".$dog['breed_name'] ."</td>
        </tr>
		<tr>
			<td>Пол:</td>
			<td>".$dog['gender_name'] ."</td>
		</tr>
	"
	);
}
else{echo ("Пользователя с таким именем в базе нет<br/><br/>");}
?>
			<tr>
				<td colspan="2">	<a class="button" href="../user/dogs.php">Вернуться к списку собак</a></td>
			</tr>
		</table>
	</div>
</div>

    <?php
        require '../parts/footer.php';
    ?>

</body>

</html>
