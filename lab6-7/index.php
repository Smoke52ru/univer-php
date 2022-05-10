<?php
session_start();

if (isset($_SESSION['cart_list'])) {
    echo "<a href='cart.php'>Корзина</a>: " . count($_SESSION['cart_list']);
}

include "db.php";


$req = mysqli_query($connection, "SELECT * FROM products");
$data_from_db = [];


while ($result = mysqli_fetch_assoc($req)) {
    $data_from_db[] = $result;
}

$req = mysqli_query($connection, "SELECT DISTINCT category FROM products");
$categories_from_db = [];

while ($result = mysqli_fetch_assoc($req)) {
    $categories_from_db[] = $result['category'];
}
# var_dump($data_from_db);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Learning Center</title>
</head>

<style>
    body {
        font-family: Tahoma, serif;
    }

    h1 {
        text-align: center;
    }

    #wrapper {
        display: flex;
        flex-direction: row;
        align-content: stretch;
        flex-wrap: wrap;
        width: 90%;
        margin: 0 auto;
        overflow: hidden;
    }

    .course_item {
        width: 260px;
        float: left;
        background: #424242;
        color: #fff;
        margin: 0 10px;
        padding: 10px;
    }

    .course_item a {
        display: block;
        color: #424242;
        text-decoration: none;
        text-align: center;
        border: 1px solid #fff;
        padding: 10px 0;
        margin: 0 0 10px 0;
        background: #fff;
    }

    .course_item a:hover {
        background: transparent;
        color: #fff;
    }
</style>

<body>

<h1>Welcome to our Learning Center</h1>

<a href="index.php">All</a>
<?php foreach ($categories_from_db as $category): ?>
    <a href="index.php?category=<?php echo $category ?>"><?php echo $category ?></a>
<?php endforeach; ?>

<div id="wrapper">

    <?php foreach ($data_from_db as $course_item):
        if ((isset($_GET['category']) && ($course_item['category'] == $_GET['category'])) || !isset($_GET['category'])) {
            ?>

            <div class="course_item">
                <h2>
                    <?php echo $course_item['name'] ?>
                </h2>

                <p>
                    <?php echo $course_item['description'] ?>
                </p>

                <p><strong>
                        <?php echo $course_item['price'] ?> гривен
                    </strong></p>

                <a href="single.php?id=<?php echo $course_item['id'] ?>">
                    Подробнее
                </a>

                <a href="cart.php?course_id=<?php echo $course_item['id'] ?>">
                    В корзину
                </a>
            </div>

        <?php }
    endforeach; ?>

</div>

</body>
</html>