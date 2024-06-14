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
        .entete {
          background-image: url('portrait-belle-femme-maquillage-lumineux-chapeau-lunettes-soleil-fond-studio-vert-marque-coiffure-elegantes-mode-couleurs-ete-concept-beaute-mode-publicite-souriant_155003-25571.jpg'); 
          background-size: cover; 
          background-repeat: no-repeat; 
          background-position: center; 
          margin: 90px 0 0 20px; 
          height: 40rem; 
          transition: all 0.5s ease-in-out;
        }
      
        .entete.scrolled {
          margin: 50px 0 0 10px; 
          height: 30rem; 
        }
        
        .content {
          height: 2000px;
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
                                <div class="heading">
                                    <span>Cart</span>
                                </div>
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
    <div class="entete" id="entete"></div>

    <section class="bests-items" id="bests-items">
        <h2 class="section-title">Nos meilleures ventes</h2>
        <div class="best-plants">
        <?php
            $con = mysqli_connect("localhost", "root", "", "optitrend");

            $cat = $_GET['category'];

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $req = mysqli_query($con, "SELECT name, price, product_id FROM products WHERE category_id=$cat");

            while ($res = mysqli_fetch_array($req)) {
                $sh = '<a href="fiche_produit1.html?idpro=' . $res['product_id'] . '" class="style-box style1 no-grid">';
                $sh .= '<div class="style-details">';
                $sh .= '<p class="style-name">' . $res['name'] . '</p>';
                $sh .= '<p class="style-price">' . $res['price'] . '</p>';
                $sh .= '<form action="fiche_produit1.html" method="POST">
                            <input type="submit" name="ok" value="Ajouter">
                            <input type="hidden" name="idp" value="' . $res['product_id'] . '">
                        </form>
                    </div>
                    </a>';
                
                echo $sh;
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
