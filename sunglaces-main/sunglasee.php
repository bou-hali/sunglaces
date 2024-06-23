<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css"> 
    <link rel="stylesheet" href="stylessun.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="product.css">
    <title>OptiTrend</title>
    <style>
        

        <?php
        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "optitrend");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Récupérer la catégorie des produits à afficher
        $cat = isset($_GET['category']) ? (int)$_GET['category'] : 0;

        // Requête pour récupérer les produits de la catégorie
        $req = mysqli_query($con, "SELECT product_id, name, price FROM products WHERE category_id=$cat");

        while ($res = mysqli_fetch_array($req)) {
            $product_id = $res['product_id'];
            $req1 = mysqli_query($con, "SELECT path_image FROM product_images WHERE product_id='$product_id'");
            $images = [];
            while ($res1 = mysqli_fetch_array($req1)) {
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

        mysqli_close($con);
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
                                        <li><a href="#" class="dropdown__link">ronde</a></li>
                                        <li><a href="#" class="dropdown__link">carre</a></li>
                                        <li><a href="#" class="dropdown__link">ovale</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-palette-line"></i>
                                    </div>
                                    <span class="dropdown__title">color</span>
                                    <ul class="dropdown__list">
                                        <li><a href="#" class="dropdown__link">noir</a></li>
                                        <li><a href="#" class="dropdown__link">marron</a></li>
                                        <li><a href="#" class="dropdown__link">blanc </a></li>
                                    </ul>
                                </div>
                                <div class="dropdown__group">
                                    <div class="dropdown__icon">
                                        <i class="ri-user-3-line"></i>
                                    </div>
                                    <span class="dropdown__title">sex</span>
                                    <ul class="dropdown__list">
                                        <li><a href="#" class="dropdown__link">homme </a></li>
                                        <li><a href="#" class="dropdown__link">femme</a></li>
                                        <li><a href="#" class="dropdown__link">enfant</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown__item">
                        <div class="cartDiv empty" id="cartDiv" style="margin-top: 33px; margin-right: 20px;">
                            <img src="icon-cart.svg" class="icon" id="cartIcon">
                            <div class="cart-box hide" id="cart-box">
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="entete" id="entete"></div>
        <section class="bests-items" id="bests-items">
    <h2 class="section-title">Nos meilleures ventes</h2>
    <div class="best-plants style-grid">
    <?php
            $con = mysqli_connect("localhost", "root", "", "optitrend");

            $cat = isset($_GET['category']) ? (int)$_GET['category'] : 0;

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $req = mysqli_query($con, "SELECT product_id, name, price FROM products WHERE category_id=$cat");

            while ($res = mysqli_fetch_array($req)) {
                echo '<a href="fiche_produit.php" class="style-box style' . $res['product_id'] . '">';
                echo '<div class="style-details">';
                echo '<p class="style-name">' . $res['name'] . '</p>';
                echo '<p class="style-price">' . $res['price'] . '</p>';
                echo '<form action="fiche_produit.php" method="POST">';
                echo '<input type="submit" name="voir" value="voir">';
                echo '<input type="hidden" name="idp" value="' . $res['product_id'] . '">';
                echo '</form>';
                echo '</div>';
                echo '</a>';
            }

            mysqli_close($con);
            ?>
    </div>
</section>
    <footer class="footer">
        <div class="container">
            <div class="row3">
                <div class="footer-col">
                <h4 style="text-align: left; padding-left: 0; font-size: 5rem; margin-left: 2px;margin-bottom: 5%;">OptiTrend</h4> 
                    <ul>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 9%;">company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 9%;">get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 9%;">online shop</h4>
                    <ul>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">optic</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom:9%;">contact us</h4>
                    <ul>
                        <li><a href="#">hajrbouhali07@gmail.com</a></li>
                        <li><a href="#">0684912299</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 9%;">follow us</h4>
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
        window.addEventListener('scroll', function() {
            var header = document.querySelector('.entete');
            header.classList.toggle('scrolled', window.scrollY > 100);
        });
    </script>
</body>
</html>
