<?php
	//Встановлюємо файл для запису
	define(OUT, "../html/out.html");

	//Встановлюємо шлях для читання
	define(IN, "../html/");

	if(empty($_GET['url'])){
		exit('Введіть url');
	}

	//Читаємо вміст
	$url = IN . $_GET['url'];
	$file = file_get_contents($url);

	//Шукаємо посилання
	$pattern = "#<a.*href\s*=\s*[\"\'](.*?)[\"\'].*>#ui";
	preg_match_all($pattern, $file, $hrefs);
	$hrefs = $hrefs[1];

	//Готуємо таблицю для запису
	foreach ($hrefs as $key => $href) {
		$num = $key + 1;
		$contentTable .= "<tr>
			<td>" . $num . "</td>
			<td>$href</td>
		</tr>";
	}
	$table = "<table border=\"1\">
		$contentTable
	</table>";
	
	//Оновлюємо файл з таблицею
	$file = file_get_contents(OUT);

	//Замінюємо стару таблицю на нову
	$pattern = "#<table.*>[\S\s.]*?</table>#ui";
	$replacement = $table;
	$file = preg_replace($pattern, $replacement, $file);

	file_put_contents(OUT, $file);

	//Перенаправляємо користувача
	header('Location: ' . OUT);

?>