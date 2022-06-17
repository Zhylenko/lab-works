<?php
	//Встановлюємо шлях до json-файлу як константу
	define(JSON, "assets/json/data.json");

	//Перевіряємо, чи існує json-файл
	if(!file_exists(JSON)){
		exit("Дані не існують");
	}

	//Прочитуємо файл
	$data = json_decode(file_get_contents(JSON), 1);

	//Перетворимо дату в секунди, для сортування
	foreach ($data['tasks'] as $key => $task) {
		$time = $task['date'];
		$timeData = explode("-", $time);
		$year = $timeData[0];
		$month = $timeData[1];
		$day = $timeData[2];

		$time = mktime(0, 0, 0, $month, $day, $year);

		$data['tasks'][$key]['date'] = $time;
	}

	//Сортуємо дані за датою бульбашкою
	for ($i=0; $i < count($data['tasks']); $i++) { 
		
		for ($j=0; $j < count($data['tasks']); $j++) { 
			if(!isset($data['tasks'][$j + 1])){
				continue;
			}

			if($data['tasks'][$j]['date'] > $data['tasks'][$j + 1]['date']){
				$a = $data['tasks'][$j];
				$data['tasks'][$j] = $data['tasks'][$j + 1];
				$data['tasks'][$j + 1] = $a;
				unset($a);
			}
		}

	}

	//Перетворимо дату
	foreach ($data['tasks'] as $key => $task) {
		$data['tasks'][$key]['date'] = date("Y-m-d", $task['date']);
	}

	//Виводимо json
	header('Content-Type: application/json');		//Даємо браузеру зрозуміти, що це дані json
	exit(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

?>