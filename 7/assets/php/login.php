<?php session_start(); ?>
<a href="/7">На головну</a><br>
<?php
    //Перевіряємо, чи увійшов користувач
    $user = $_SESSION['user'];
	if(!empty($user['id'])){
		exit("Ви вже ввійшли до аккаунту");
	}

	//Підключаємо файл з налаштуванням
	define(CONFIG, 'config.php');
	require CONFIG;
	$config = json_decode($config, 1);

	if(empty($_POST)){
		exit("Заповніть поля");
	}
	//Перевіряємо правильність введених даних
	if(strlen($_POST['login']) <= 3){
		exit("Логін має містити більше 3 сивмолів");
	}else if(strlen($_POST['password']) <= 5){
		exit("Пароль має містити більше 5 сивмолів");
	}

	//Підключаємо бд - базу данних
	$database = mysqli_connect($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);
	mysqli_query($database, "SET NAMES 'utf8'");

	$login = $_POST['login'];
	$password = $_POST['password'];
	$type = 1;

	//Перевіряємо, чи є такий же логін в бд
	$query = "SELECT `users`.`id` as id, `users`.`login` as login, `users`.`password` as password, `perms`.`permsion` as type FROM `users` LEFT JOIN `perms` ON `perms`.`id` = `users`.`type` WHERE `users`.`login` = '{$login}'";
	$result = $database->query($query);
	$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$result = $result[0];

	//Перевіряємо пароль
	if(!password_verify($password, $result['password'])){
		exit("Невірний пароль");
	}

	//Логіним користувача
	$_SESSION['user'] = $result;

	echo("Ви ввійшли");
?>
<br>
<a href="/7/profile.php">Профіль</a><br>