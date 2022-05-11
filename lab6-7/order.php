<?php
session_start();

require "functions.php";

if (!isset($_SESSION['cart_list']) && !isset($_GET['title'])){
    header('Location: index.php');
}

if (isset($_POST['isOrdered'])) {
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $product_ids = [];
    if (isset($_SESSION['cart_list'])) {
        foreach ($_SESSION['cart_list'] as $value) {
            $product_ids[] = $value['id'];
        }
    }
    $_SESSION['order_success'] = write_order_to_db($customer_name, $customer_contact, $product_ids);
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h1>Заказ</h1>

<form action="order.php" method="post">
    <?php
    if (isset($_SESSION['order_success'])) {
        echo '<h3>' . $_SESSION['order_success'] . '</h3>';
        unset($_SESSION['order_success']);
        unset($_SESSION['cart_list']);
    }
    ?>


    <?php if (isset($_GET['title'])) : ?>
        <p>Вы заказываете курс: <?php echo $_GET['title']; ?></p>
    <?php elseif (isset($_SESSION['cart_list'])) : ?>
        <ul>
            <?php foreach ($_SESSION['cart_list'] as $course) : ?>

                <li><?php echo $course['name']; ?> | <?php echo $course['price']; ?> грн.</li>

            <?php endforeach; ?>
        </ul>

        <p>
            <a href="basket.php">Изменить заказ</a>
        </p>
    <?php endif; ?>


    <input type="text" placeholder="Name" name="customer_name">
    <input type="text" placeholder="Mobile" name="customer_contact">
    <input type="hidden" name="isOrdered" value="true">
    <input type="submit">
</form>

</body>
</html>