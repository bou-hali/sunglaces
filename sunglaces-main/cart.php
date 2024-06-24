<?php
session_start();
$con = new mysqli("localhost", "root", "", "optitrend");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$total_price = 0;
$total_quantity = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="fich.js" defer></script> 
    <link rel="stylesheet" type="text/css" href="stylecart.css">
    <link rel="stylesheet" href="product.css">
    <style>
        .remove-button {
            background: none;
            border: none;
            cursor: pointer;
        }
        .remove-button i {
            color: white; /* Change the color if needed */
            font-size: 1.5rem; /* Adjust the size if needed */
        }
        .cart-total{

            flex: 0.25;

            margin-left: 20px;

            padding: 20px;

            height: 190px;

            border: 1px solid silver;

            border-radius: 5px;

    }
    .cart{

        display: flex;
        margin-top: 5rem;
        height:50rem;

    }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav container">
            <div class="nav__data" style="margin-top: 1%; font-size: 300%;">
                <img src="Sans titre - 1.png" style="width: 5rem; height: 2rem; margin-top: 2%; margin-right: 1%;">
                OptiTrend
            </div>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li>
                        <a href="home.html" class="nav__link">Home</a>
                    </li>
                    <li class="dropdown__item">
                        <div class="nav__link dropdown__button">
                            Products <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                        </div>
                        <div class="dropdown__container">
                            <div class="dropdown__content">
                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-shape-2-line"></i>
                                    </div>
                                    <span class="dropdown__title">Styles</span>
                                    <ul class="dropdown__list">
                                        <li><a href="#" class="dropdown__link">Ronde</a></li>
                                        <li><a href="#" class="dropdown__link">Carré</a></li>
                                        <li><a href="#" class="dropdown__link">Ovale</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-palette-line"></i>
                                    </div>
                                    <span class="dropdown__title">Color</span>
                                    <ul class="dropdown__list">
                                        <li><a href="#" class="dropdown__link">Noir</a></li>
                                        <li><a href="#" class="dropdown__link">Marron</a></li>
                                        <li><a href="#" class="dropdown__link">Blanc</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-user-3-line"></i>
                                    </div>
                                    <span class="dropdown__title">Sex</span>
                                    <ul class="dropdown__list">
                                        <li><a href="#" class="dropdown__link">Homme</a></li>
                                        <li><a href="#" class="dropdown__link">Femme</a></li>
                                        <li><a href="#" class="dropdown__link">Enfant</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown__item">
                        <div class="cartDiv empty" id="cartDiv" style="margin-top: 33px; margin-right: 20px;">
                            <img src="icon-cart.svg" class="icon" id="cartIcon">
                            <div class="cart-box hide" id="cart-box">
                                <div class="heading"><span>Cart</span></div>
                                <div class="products" id="products"></div>
                                <div class="checkout" id="checkout">
                                    <a href="panier.html"><button>Checkout</button></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container5">
        <h1>Shopping Cart</h1>
        <div class="cart">
            <div class="products5">
                <?php
                if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $item) {
                        $id = $item['id'];
                        $qtee = $item['quantity'];

                        // Préparez la requête pour éviter les injections SQL
                        $stmt = $con->prepare("SELECT * FROM products WHERE product_id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $res = $result->fetch_assoc();

                        // Vérifiez que $res est défini avant d'accéder à ses éléments
                        if ($res) {
                            // Requête pour récupérer les images du produit
                            $stmt_img = $con->prepare("SELECT path_image FROM product_images WHERE product_id = ?");
                            $stmt_img->bind_param("i", $id);
                            $stmt_img->execute();
                            $result_img = $stmt_img->get_result();

                            $images = array();
                            while ($res1 = $result_img->fetch_assoc()) {
                                $images[] = $res1['path_image'];
                            }

                            // Calculer le prix total et la quantité totale
                            $total_price += $res['price'] * $qtee;
                            $total_quantity += $qtee;

                            echo '<div class="product5">';
                            if (count($images) > 0) {
                                echo '<img src="' . htmlspecialchars($images[0]) . '" alt="' . htmlspecialchars($res['name']) . '">';
                            }
                            echo '<div class="product5-info">';
                            echo '<h3 class="product5-name">' . htmlspecialchars($res['name']) . '</h3>';
                            echo '<h4 class="product5-price">' . htmlspecialchars($res['price']) . '</h4>';
                            echo '<h4 class="product5-offer">50%</h4>';
                            echo '<p class="product5-quantity">Qnt: ' . htmlspecialchars($qtee) . '<input value="' . htmlspecialchars($qtee) . '" name=""></p>';
                            echo '<form action="remove.php" method="POST">';
                            echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">';
                            echo '<p class="product5-remove">';
                            echo '<button type="submit" name="remove" class="remove-button"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            echo '</p>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';

                            $stmt_img->close();
                        }
                        $stmt->close();
                    }
                } else {
                    echo '<p>Votre panier est vide.</p>';
                }
                $con->close();
                ?>
            </div>
            <div class="cart-total">
                <p>
                    <span>Total Price</span>
                    <span><?php echo htmlspecialchars($total_price); ?></span>
                </p>
                <p>
                    <span>Number of Items</span>
                    <span><?php echo htmlspecialchars($total_quantity); ?></span>
                </p>
                <a href="#">Proceed to Checkout</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row3">
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; font-size: 5rem; margin-left: 2px; margin-bottom: 5%;">OptiTrend</h4>
                    <ul></ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">Get Help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Payment Options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">Online Shop</h4>
                    <ul>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">Optic</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">Contact Us</h4>
                    <ul>
                        <li><a href="mailto:hajrbouhali07@gmail.com">hajrbouhali07@gmail.com</a></li>
                        <li><a href="tel:0684912299">0684912299</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
