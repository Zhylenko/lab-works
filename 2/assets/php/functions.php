<?php 
	//Задаємо розділяючі символи
	$explodeChars = ['row' => '-', 'column' => '|'];

	function tableToArray($content = '')
	{
		global $explodeChars; 

		//Прибираємо зайві символи
		$content = preg_replace("#\r\n#", "", $content);

		//Розбиваємо на рядки
		$data['rows'] = explode($explodeChars['row'], $content);
		//Прибираємо зайві пробіли
		$data['rows'] = array_map('trim', $data['rows']);

		//Розбиваємо на стовпці
		foreach ($data['rows'] as $key => $row) {
			$values = explode($explodeChars['column'], $row);
			//Прибираємо зайві пробіли
			$values = array_map('trim', $values);
			
			$data['rows'][$key] = $values;
		}

		return $data;
	}

	function arrayToTable($data = [])
	{
		global $explodeChars; 

		//Готуємо дані для файлу
		foreach ($data as $key => $row) {
			$values = implode(" " . $explodeChars['column'] . " ", $row);
			$data[$key] = $values;
		}
		$data = implode(" " . $explodeChars['row'] . " \r\n", $data);

		return $data;
	}
?>