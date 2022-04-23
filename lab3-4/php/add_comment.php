<?php 
	date_default_timezone_set('Europe/Moscow');

	$file = '../data/comments.txt';

	$name = $_POST["name"];
	$comment = str_replace("\n", "~", $_POST["comment"]);

	if ($name != NULL and $comment != NULL) {
		$current = file_get_contents($file);
		file_put_contents($file, $current . ($comment . "\n" .
											 $name . "\n" .
											 date('d.m.Y H:i') . "\n"));
	}

	header("Location: ../index.php");
?>