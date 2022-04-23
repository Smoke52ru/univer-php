<?php
    header('Content-Type: text/html; charset=utf8');
	session_start();

	$file = 'data/files.txt';

	function get_files($path, $level, $answer) {
		$files = scandir($path);

		foreach ($files as $key => $value) {
			if (strcmp($value, '.') == 0 or strcmp($value, '..') == 0) {
				continue;
			}
			else if (is_dir($value) == true) {
				$answer = $answer . str_repeat("ᅠᅠ", $level) . "└─ " . $value . "\n";
				$answer = get_files($path . '/' . $value, $level + 1, $answer);
			}
			else {
				$sym = count($files) - 1 == $key ? "└─ " : "├─ ";
				$answer = $answer . str_repeat("ᅠᅠ", $level) . $sym . $value . "\n";
			}
		}

		return $answer;
	}

	file_put_contents($file, get_files('.', 0, 'root' . "\n")); 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<title>lab 3</title>
</head>
<body>
	<?php
		echo(file_get_contents('html/comment_form.html'));
	?>
	<div class="comments">
		<h3>Отзывы</h3>
		<ul>
			<?php
				$comments = file('data/comments.txt');
				if (count($comments) == 0) {
					echo("<span>Отзывов пока нет</span>");
				}

				foreach ($comments as $key => $value) {
					if ($key % 3 == 0) {
						$comment = str_replace("~", "<br>", $value);
						echo("<li><p>$comment</p>");
					}
					else if ($key % 3 == 1)
						echo("<span>$value</span>");
					else
						echo("<span> - $value</span></li>");
				}	
			?>
		</ul>
	</div>

	<article class="files">
		<?php 
			$files = file('data/files.txt');

			foreach ($files as $key => $value) {
				echo("<p>$value</p>");
			}
		?>
	</article>
</body>
</html>