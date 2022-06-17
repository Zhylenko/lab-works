<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "../txt/");

	if(empty($_GET['file'])){
		exit('Введіть файл');
	}
	
	//Парсим URL
	$url = DATA_DIR . $_GET['file'];
	$content = file_get_contents($url);

	//Встановлюємо слова для підрахунку
	$words = ['білий', 'чорний', 'кіт', 'пес'];

	//Шукаємо cлова
	$pattern = "#\b" . implode("|", $words) . "\b#ui";
	preg_match_all($pattern, $content, $matches);

	//Підраховуємо слова
	$matches = array_count_values($matches[0]);

?>

<!DOCTYPE html>
<html>
<head>
	<title>4</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="/4/">На головну</a><br>
	<?php foreach ($matches as $key => $match) { ?>
	<?=$key?> - <?=$match?><br>
	<?php }?>
</body>
</html>