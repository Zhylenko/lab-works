<?php 
	if(!empty($_POST['name'])){

		$name = trim($_POST['name']);

		$pattern = "#^((([A-Z]{1}[a-z]{1,15})\s([A-Z]{1}[a-z]{1,15}))|(([А-ЯЙІЇ]{1}[а-яії]{1,15})\s([А-ЯЙІЇ]{1}[а-яії]{1,15})))$#u";
		preg_match_all($pattern, $name, $matches);
		
		if(empty($matches[0])){
			$error = "Введіть правильно дані";
		}else{
			$success = "Успіх";
		}


	}else{
		$error = "Заповніть форму";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>4</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="/4/">На головну</a><br>
	<form method="post">
		<input type="text" name="name">
		<input type="submit">
	</form>
	<br>
	<span style="color: red"><?=$error?></span>
	<span style="color: green"><?=$success?></span>
</body>
</html>