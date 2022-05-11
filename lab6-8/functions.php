<?php
require_once "db.php";

function get_course_by_id($id)
{
    global $connection;

    $query = "SELECT * FROM products WHERE id=" . $id;
    $req = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($req);
}

function write_order_to_db($customer_name, $customer_contact, $product_ids): string
{
    global $connection;
    $log = '';

    if (isset($_SESSION['cart_list'])) {
        $req = mysqli_query($connection, "
        INSERT INTO orders (customer_name,customer_contact) 
        VALUES ($customer_name, $customer_contact);");
        if ($req) {
            $log .= "Success creating order\n";
        } else {
            $log .= "Error creating order (" . mysqli_error($connection) . ")\n";
            return $log;
        }

        $order_id = (int)mysqli_insert_id($connection);

        foreach ($product_ids as $product_id) {
            $product_id = (int)$product_id;
            $product = get_course_by_id($product_id);
            $product_name = (string)$product['name'];
            $product_price = (int)$product['price'];

            $req = mysqli_query($connection, "
            INSERT INTO order_products (order_id, product_id, product_name, product_price)
            VALUES ($order_id, $product_id, '$product_name', $product_price );");
            if ($req) {
                $log .= "Success assigning product id=$product_id to order\n";
            } else {
                $log .= "Error creating order (" . mysqli_error($connection) . ")\n";
                return $log;
            }
        }

    }
    return $log;
}