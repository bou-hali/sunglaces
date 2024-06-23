<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    $product = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $quantity
    ];

    // Check if the cart session already exists
    if (isset($_SESSION['cart'])) {
        // Check if the product already exists in the cart
        $product_exists = false;
        foreach ($_SESSION['cart'] as &$cart_product) {
            if ($cart_product['id'] == $product_id) {
                $cart_product['quantity'] += $quantity;
                $product_exists = true;
                break;
            }
        }

        // If the product doesn't exist, add it to the cart
        if (!$product_exists) {
            $_SESSION['cart'][] = $product;
        }
    } else {
        // If the cart doesn't exist, create a new cart with the product
        $_SESSION['cart'] = [$product];
    }
}

header('Location: cart.php');
exit;
?>
