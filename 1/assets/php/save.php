<?php 
	//Встановлюємо шлях до json-файлу як константу
	define(JSON, "../json/data.json");

	//Перевіряємо post запит
	if(!empty($_POST)){
		//Перевірка поля на вміст
		if(empty($_POST['date']) || empty($_POST['task'])){
			exit("Заповніть поля");
		}

		//Перевіряємо, чи існує json-файл
		if(!file_exists(JSON)){
			$data = ['tasks' => []];
			file_put_contents(JSON, json_encode($data)); 	//Якщо немає, створюємо порожній json-файл
		}

		//Прочитуємо файл
		$data = json_decode(file_get_contents(JSON), 1);

		//Оновлюємо дані
		$prepareData = ["date" => $_POST['date'], "task" => $_POST['task']];
		$data["tasks"][] = $prepareData;
		$data = json_encode($data);

		//Записуємо в json-файл
		file_put_contents(JSON, $data);
		
		//Перенаправляємо користувача назад
		$returnPage = '/1/';
		header('Location: ' . $returnPage);

	}
?>