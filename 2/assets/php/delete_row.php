<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "../txt/");
	//Файл json
	define(JSON, ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/2/json.php");
	//Підключаємо функції
	require_once 'functions.php';

	if(empty($_GET['file'])){
		exit('Виберіть файл для перегляду');
	}

	if(empty($_GET['row'])){
		exit('Виберіть рядок для видалення');
	}

	if(!file_exists(DATA_DIR . $_GET['file'])){
		exit('Файл не існує');
	}

	//Парсим дані
	$file = $_GET['file'];
	$data = json_decode(file_get_contents(JSON . "?file=" . $file), 1);
	$data = $data['rows'];

	//Видаляєм рядок
	unset($data[$_GET['row']]);

	//Готуємо дані для файлу
	$data = arrayToTable($data);

	//Оновлюємо файл
	file_put_contents(DATA_DIR . $file, $data);

	//Перенаправляємо користувача назад
	$returnPage = "/2/showData.php?file={$file}";
	header('Location: ' . $returnPage);
?>