<?php
	//Встановлюємо URL для парсинга
	define(URL, "https://pnu.edu.ua/%D1%82%D0%B5%D0%BB%D0%B5%D1%84%D0%BE%D0%BD%D0%BD%D0%B8%D0%B9-%D0%B4%D0%BE%D0%B2%D1%96%D0%B4%D0%BD%D0%B8%D0%BA/#t23");

	//Парсим URL
	$page = file_get_contents(URL);
	
	//Вибираємо таблиці
	$tables = getTables($page);

	//З'єднуємо воєдино всі таблиці
	$table = uniteTables($tables);

	//З'єднуємо воєдино всі таблиці
	function uniteTables($tables)
	{
		$table = [];
		foreach ($tables as $key => $tab) {
			foreach ($tab as $num => $row) {
				//Позбавляємося від підзаголовків таблиці
				if(count($row) == 1){
					continue;
				}

				//Заносимо дані в одну таблицю
				$table[] = $row;		
			}
		}
		return $table;
	}

	//Вибираємо таблиці
	function getTables($content, $title = null)
	{
		//Готуємо патерн
		if(!empty($title)){
			$pattern = "#<h1 class=\"title\">$title</h1>[\S\s.]*?<div.*(?:id\s*=\s*[\"\']tab[\"\']).*>[\s\S.]*?(<table.*>[\S\s.]*?</table>)[\s\S.]*?</div>#ui";
		}else{
			$pattern = "#<div.*(?:id\s*=\s*[\"\']tab[\"\']).*>[\s\S.]*?(<table.*>[\S\s.]*?</table>)[\s\S.]*?</div>#ui";
		}
		//Вибираємо таблиці
		preg_match_all($pattern, $content, $tables);
		$tables = $tables[1];

		//Переносимо значення таблиць в масив
		$data = [];
		foreach ($tables as $key => $table) {
			//Шукаємо рядки
			$pattern = "#<tr.*?>([\s\S.]*?)</tr>#ui";
			preg_match_all($pattern, $table, $matches);
			$rows = $matches[1];
			//Шукаємо стовпчики в кожному рядку
			foreach ($rows as $num => $row) {
				$pattern = "#(<td.*?>[\s\S.]*?</td>)#ui";
				preg_match_all($pattern, $row, $matches);
				if(!empty($matches[1])){
					$data[$key][] = $matches[1];
				}
			}
		}

		//Чистим данные от лишних тегов
		foreach ($data as $tab => $table) {
			foreach ($table as $num => $row) {
				foreach ($row as $col => $column) {
					$pattern = "#</?td.*?>|</?b.*?>|</?p.*?>|</?br.*?>|</?strong.*?>|</?span.*?>|</?table.*?>|</?tbody.*?>|</?tr.*?>|</?th.*?>#ui";
					$data[$tab][$num][$col] = preg_replace($pattern, "", $column);
				}
			}
		}
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>4</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="/4/">На головну</a>
	<h1>Всі записи</h1>
	<table border="1">
		<tr>
			<th>ПІБ</th>
			<th>Телефон</th>
		</tr>
		<?php foreach ($table as $key => $row) { ?>
		<tr>
			<td><?=$row[0]?></td>
			<td><?=$row[1]?></td>
		</tr>
		<?php } ?>
	</table>
	<?php 
	//Вибираємо таблиці факультету
	$tables = getTables($page, "ФАКУЛЬТЕТ МАТЕМАТИКИ ТА ІНФОРМАТИКИ");

	//З'єднуємо воєдино всі таблиці
	$table = uniteTables($tables);
	?>
	<h1>Записи факультету математики та інформатики</h1>
	<table border="1">
		<tr>
			<th>ПІБ</th>
			<th>Телефон</th>
		</tr>
		<?php foreach ($table as $key => $row) { ?>
		<tr>
			<td><?=$row[0]?></td>
			<td><?=$row[1]?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>