<?php
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "assets/txt/");
	//Файл json
	define(JSON, ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/2/json.php");

	if(empty($_GET['file'])){
		exit('Виберіть файл для перегляду');
	}

	if(!file_exists(DATA_DIR . $_GET['file'])){
		exit('Файл не існує');
	}

	//Парсим дані
	$file = $_GET['file'];
	$data = json_decode(file_get_contents(JSON . "?file=" . $file), 1);
	$data = $data['rows'];

	//Встановлюємо title таблиці
	$title = $data[0][0];
	unset($data[0]);

	//Готуємо таблицю

	//Максимальна к-ть стовпців
	$maxColumns = 0;
	foreach ($data as $key => $row) {
		if(count($row) > $maxColumns){
			$maxColumns = count($row);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>2</title>
	<meta charset="utf-8">
</head>
<body>
	<h2><a href="/2/">На головну</a></h2>
	<table border="1">
		<tr>
			<th><?=$title?></th>
		</tr>
		<?php foreach ($data as $key => $row) { ?>
		<tr>
			<form action="assets/php/edit_file.php" method="get">
				<input type="text" name="file" hidden value="<?=$file?>">
				<input type="text" name="row" hidden value="<?=$key?>">
				<?php 
				for ($i=0; $i < $maxColumns; $i++) { ?>
				<td><input type="text" name="field[<?=$i?>]" value="<?=$row[$i]?>"></td>
				<?php } ?>
				<td><input type="submit" value="Редагувати"></td>
			</form>
			<td><a href="assets/php/delete_row.php?file=<?=$file?>&row=<?=$key?>">Видалити</a></td>
		</tr>	
		<?php } ?>
	</table>
</body>
</html>