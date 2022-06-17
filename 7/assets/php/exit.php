<?php 
	session_start(); 

	//Видаляємо сесію
	unset($_SESSION['user']);

	//Перенаправляємо користувача назад
	$returnPage = '/7/';
	header('Location: ' . $returnPage);
?>