<?php 
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "../txt/");
	//Встановлюємо дозволені розширення файлу
	define(TYPES, ['txt']);
	

	//Перевіряємо завантажений файл
	if($_FILES['file']['error'][0] == 4){
		exit("Загрузіть файл");
	}

	//Перевіряємо розширення файлу
	$checkType = 0;
	foreach (TYPES as $type) {
		if(preg_match("#\.$type$#ui", $_FILES['file']['name']) == 1){
			$checkType = 1;
			break;
		}else{
			$checkType = $type;
		}
	}
	if($checkType != 1){
		exit("Загрузіть файл ." . $checkType);
	}

	//Завантажуємо файл на сервер
	$file_name = basename($_FILES['file']['name']);
	$tmp_name = $_FILES['file']['tmp_name'];
	move_uploaded_file($tmp_name, DATA_DIR . $file_name);

	//Перенаправляємо користувача назад
	$returnPage = '/2/';
	header('Location: ' . $returnPage);

?>