<?php 
	//Встановлюємо шлях до папки з txt-файлами
	define(DATA_DIR, "assets/txt/");

	//Отримуємо всі файли
	$dataFiles = array_diff(scandir(DATA_DIR), ['.', '..']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>2</title>
	<meta charset="utf-8">
</head>
<body>
	<h2>Завантажити таблицю</h2>
	<form action="assets/php/upload_file.php" method="post" enctype='multipart/form-data'>
		<input type="file" name="file" accept=".txt">
		<input type="submit">
	</form>
	<h2>Таблиці</h2>
	<table border="1">
		<tr>
			<th>Таблиця</th>
			<th>json</th>
		</tr>
		<?php foreach ($dataFiles as $file) { ?>
		<tr>
			<td><a href="showData.php?file=<?=$file?>"><?=$file?></a></td>
			<td><a href="json.php?file=<?=$file?>"><?=$file?></a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>