<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="stylesproduct.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-PLT9vEEwbABK8Lpln8L+L8b/vfzXsI5e2+OKl7K2WyErKNyI9AvH2XZxICn3cOtvqMe5URgV6aZxpt1g9wshjw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="fich.js" defer></script>
    <style>
        <?php
        // Connexion à la base de données
        $con = new mysqli("localhost", "root", "", "optitrend");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Récupérer la catégorie des produits à afficher
        $cat = isset($_GET['category']) ? (int)$_GET['category'] : 0;

        // Requête pour récupérer les produits de la catégorie
        $req = $con->query("SELECT product_id, name, price FROM products WHERE category_id=1");

        while ($res = $req->fetch_assoc()) {
            $product_id = $res['product_id'];
            $req1 = $con->query("SELECT path_image FROM product_images WHERE product_id='$product_id'");
            $images = [];
            while ($res1 = $req1->fetch_assoc()) {
                $images[] = $res1['path_image'];
            }

            // Générer le CSS pour chaque produit avec ses images
            if (count($images) > 0) {
                echo ".style$product_id { background-image: url( $images[0] ); margin-bottom: 2rem; }\n";
                echo "@keyframes changeBackground$product_id {";
                foreach ($images as $index => $image) {
                    $percent = ($index / count($images)) * 100;
                    echo "$percent% { background-image: url($image); }\n";
                }
                echo "}\n";
                echo ".style$product_id:hover { animation: changeBackground$product_id 3s infinite; }\n";
            }
        }

        $con->close();
        ?>
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

                                    <span class="dropdown__title">styles</span>

                                    <ul class="dropdown__list">
                                        <li>
                                            <a href="#" class="dropdown__link">ronde</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">carre</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">ovale</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-palette-line"></i>
                                    </div>

                                    <span class="dropdown__title">color</span>

                                    <ul class="dropdown__list">
                                        <li>
                                            <a href="#" class="dropdown__link">noir</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">marron</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">blanc </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-user-3-line"></i>
                                    </div>

                                    <span class="dropdown__title">sex</span>

                                    <ul class="dropdown__list">
                                        <li>
                                            <a href="#" class="dropdown__link">homme </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">femme</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown__link">enfant</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown__item">
                        <div class="cartDiv empty" id="cartDiv" style="margin-top: 33px; margin-right: 20px;">
                            <img src="icon-cart.svg" class="icon" id="cartIcon">
                            <div class="cart-box hide" id="cart-box">
                                <div class="heading">
                                    <span>Cart</span>
                                </div>
                                <div class="products" id="products">
                                </div>
                                <div class="checkout" id="checkout">
                                    <a href="panier.html"> <button>Checkout</button></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container1">
        <div class="row">
            <?php 
            if(isset($_POST["ok"])) {
                $idp = $_POST["idp"];
                $con = new mysqli("localhost", "root", "", "optitrend");

                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                $req = $con->query("SELECT * FROM products WHERE product_id='$idp'");
                $req1 = $con->query("SELECT path_image FROM product_images WHERE product_id='$idp'");

                $images = array();
                while ($res1 = $req1->fetch_assoc()) {
                    $images[] = $res1['path_image'];
                }

                echo '<div class="col-2">';
                if (count($images) > 0) {
                    echo '<img src="' . $images[0] . '" id="emphasisPicture">';
                    echo '<div class="smallImg">';
                    echo '<div class="col-4">
                            <img src="' . $images[0] . '" class="smallpictures active" alt="">
                          </div>';
                    if (isset($images[1])) {
                        echo '<div class="col-4">
                                <img src="' . $images[1] . '" class="smallpictures" alt="">
                              </div>';
                    }
                    if (isset($images[2])) {
                        echo '<div class="col-4">
                                <img src="' . $images[2] . '" class="smallpictures" alt="">
                              </div>';
                    }
                    echo '</div>';
                }
                echo '</div>';

                echo '<div class="col-2">';
                echo '<form action="panier.php" method="POST">';
                while ($res = $req->fetch_assoc()) {
                    echo '<small class="companyName">'. $res['name'] .'</small>';
                    echo '<h2>Fall Limited Edition Sunglasses</h2>';
                    echo '<p>' . $res['description'] . '</p>';
                    echo '<div class="price"><span class="productValue">' . $res['price'] . '</span></div>';
                    $style = $res['style']; // Get the style for similar products
                    $CATEGORY = $res['category_id']; // Get the CATEGO for similar products
                }
                echo' <div class="buttonsRow">
                    <div class="increment">
                        <img src="icon-minus.png" id="minus">
                        <input type="number" name="totalItems" id="totalItems" value="1">
                        <img src="icon-plus.png" id="plus">
                    </div>
                    <div class="callToAction">
                        <button id="btn" type="button">Add to Cart</button>
                    </div>
                </div>
                <input type="hidden" name="idp" value="' . $idp . '">
                </form>'; 
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <section class="bests-items" id="bests-items">
        <h2 class="section-title" style="font-size: 2rem;">Similaire Produits</h2>
        <div class="best-plants style-grid">
            <?php
            if (isset($style)) {
                $req2 = $con->query("SELECT product_id, name, price FROM products WHERE style='$style' AND category_id='$CATEGORY'");

                while ($res2 = $req2->fetch_assoc()) {
                    echo '<a href="fiche_produit.php" class="style-box style' . $res2['product_id'] . '">';
                    echo '<div class="style-details">';
                    echo '<p class="style-name">' . $res2['name'] . '</p>';
                    echo '<p class="style-price">' . $res2['price'] . '</p>';
                    echo '<form action="fiche_produit.php" method="POST">';
                    echo '<input type="submit" name="ok" value="voir">';
                    echo '<input type="hidden" name="idp" value="' . $res2['product_id'] . '">';
                    echo '</form>';
                    echo '</div>';
                    echo '</a>';
                }
            }

            $con->close();
            ?>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row3">
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; font-size: 5rem; margin-left: 2px;">OptiTrend</h4>
                    <ul></ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;">company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;">get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;">online shop</h4>
                    <ul>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">optic</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;">contact us</h4>
                    <ul>
                        <li><a href="#">hajrbouhali07@gmail.com</a></li>
                        <li><a href="#">0684912299</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;">follow us</h4>
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

    <script>
        // Ajoutez votre JavaScript ici
    </script>
</body>

</html>
