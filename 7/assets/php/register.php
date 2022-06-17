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
	}else if($_POST['password'] != $_POST['cpassword']){
		exit("Паролі не співпадають");
	}

	//Підключаємо бд - базу данних
	$database = mysqli_connect($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);
	mysqli_query($database, "SET NAMES 'utf8'");

	$login = $_POST['login'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$type = 1;

	//Перевіряємо, чи є такий же логін в бд
	$query = "SELECT * FROM `users` WHERE `login` = '{$login}'";
	$result = $database->query($query);
	$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if(!empty($result)){
		exit("Такий логін зареєстровано");
	}

	//Реєструємо користувача
	$query = "INSERT INTO `users`(`login`, `password`, `type`) VALUES ('{$login}', '{$password}', '{$type}')";
	$database->query($query);

	exit("Успішна реєстрація! Увійдіть до аккаунту");
?>