<?php
session_start();
$con=mysqli_connect("localhost","root","","ecomerce");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idp'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $id) {
            $cartItem['quantity']++;
            $found = true;
            break;
        }
    }

    // If not found, add new item
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    // Redirect back to the product page or wherever appropriate
    header('Location: your-product-page.php'); // Adjust the location as needed
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                <li>
                    <?= htmlspecialchars($cartItem['name']) ?> - <?= htmlspecialchars($cartItem['price']) ?> - Quantity: <?= $cartItem['quantity'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
