<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "../txt/");

	if(empty($_GET['file'])){
		exit('Введіть файл');
	}
	
	//Парсим URL
	$url = DATA_DIR . $_GET['file'];
	$content = file_get_contents($url);

	//Шукаємо коментар
	$pattern = "#/\*([\s\S.]*?)\*/#ui";
	preg_match_all($pattern, $content, $comments);
	$content = implode(" ", $comments[1]);

	//Шукаємо дати
	$monthes = ["Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересня", "Жовтня", "Листопада", "Грудня"];

	$pattern = "#(\b(?:[1-9]|[1-2][\d]|3[0-1])-(?:(?:0?[1-9]|1[0-2])|" . implode("|", $monthes) . ")(?:-\d+)?\b)#ui";
	preg_match_all($pattern, $content, $dates);
	$dates = implode(" ", $dates[1]);
?>

<!DOCTYPE html>
<html>
<head>
	<title>4</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="/4/">На головну</a><br>
	<?=$dates?>
</body>
</html>