<?php session_start(); ?>
<a href="/7">На головну</a><br>
<?php
    //Перевіряємо, чи увійшов користувач
	$user = $_SESSION['user'];
	if(empty($user['id'])){
		exit("Ви не ввійшли до аккаунту");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>7</title>
    <meta charset="utf-8">
</head>
<body>
	id - <?=$user['id']?><br>
    Логін - <?=$user['login']?><br>
    Тип - <?=$user['type']?><br>
    <?php if($user['type'] == "admin") {?>
    Це бачить тільки адмін<br>
    <?php } ?>
    <a href="/7/assets/php/exit.php">Вийти за акаунту</a>
</body>
</html>