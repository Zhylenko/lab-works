<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "assets/txt/");
	//Підключаємо функції
	require_once 'assets/php/functions.php';

	if(empty($_GET['file'])){
		exit('Виберіть файл для перегляду');
	}

	if(!file_exists(DATA_DIR . $_GET['file'])){
		exit('Файл не існує');
	}

	//Читаємо файл
	$file = $_GET['file'];
	$content = file_get_contents(DATA_DIR . $file);

	//Конвертуємо отримані дані в масив
	$data = tableToArray($content);

	//Виводимо json
	header('Content-Type: application/json');		//Даємо браузеру зрозуміти, що це дані json
	exit(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
?>