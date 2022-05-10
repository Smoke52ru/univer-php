<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<h1>Заказ</h1>

	<form>
		
		<?php if ( isset($_GET['title']) ) : ?>
			<p>Вы заказываете курс: <?php echo $_GET['title']; ?></p>
		<?php elseif ( isset($_SESSION['cart_list']) ) : ?>
			<ul>
				<?php foreach( $_SESSION['cart_list'] as $course ) : ?>

					<li><?php echo $course['name']; ?> | <?php echo $course['price']; ?> грн.</li>

				<?php endforeach; ?>
			</ul>

			<p>
				<a href="cart.php">Изменить заказ</a>
			</p>
		<?php endif; ?>

		
		<input type="text" placeholder="Name">
		<input type="text" placeholder="Mobile">
		<input type="submit">
	</form>
	
</body>
</html>