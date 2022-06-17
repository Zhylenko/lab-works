<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "../txt/");

	if(empty($_GET['file'])){
		exit('Введіть файл');
	}
	
	//Парсим URL
	$url = DATA_DIR . $_GET['file'];
	$content = file_get_contents($url);

	//Замінюємо місяці
	$monthes = ["Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересня", "Жовтня", "Листопада", "Грудня"];

	$pattern = "#\b([1-9]|[1-2][\d]|3[0-1])\b\s(" . implode("|", $monthes) . ")#ui";
	$replacement = "січня";
	$content = preg_replace($pattern, "$1 " . $replacement, $content);
?>
<!DOCTYPE html>
<html>
<head>
	<title>4</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="/4/">На головну</a><br>
	<?=$content?>
</body>
</html>