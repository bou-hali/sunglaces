<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="fich.js" defer></script> 
    <link rel="stylesheet" type="text/css" href="stylecart.css">
    <link rel="stylesheet" href="product.css">
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
                            <img src="icon-cart.svg" class="icon" id="cartIcon"><div class="cart-box hide" id="cart-box">
                            <div class="heading">
                              <span>Cart</span>
                            </div>
                            <div class="products" id="products">
                            </div>
                            <div class="checkout" id="checkout">
                             <a href="panier.html"> <button>Checkout</button></a>
                            </div>
                          </div>
                    </li>
                          </div>
                          
                </ul>
            </div>
        </nav>
    </header>
    <div class="container5">

        <h1>Shopping Cart</h1>
    
        <div class="cart">
    
            <div class="products5">
    
                <div class="product5">
    
                    <img src="74d30f180108c83db65637b1db424b02.jpg">
    
                    <div class="product5-info">
    
                        <h3 class="product5-name">white sunglasses</h3>
    
                        <h4 class="product5-price">250</h4>
    
                        <h4 class="product5-offer">50%</h4>
    
                        <p class="product5-quantity">Qnt: <input value="1" name="">
    
                        <p class="product5-remove">
    
                            <i class="fa fa-trash" aria-hidden="true"></i>
    
                            <span class="remove">Remove</span>
    
                        </p>
    
                    </div>
    
                </div>
    
                <div class="product5">
    
                    <img src="b42a8df05cc65fe5d770b3b403c27b99.jpg">
    
                    <div class="product5-info">
    
                        <h3 class="product5-name">black sunglasses</h3>
    
                        <h4 class="product5-price">200</h4>
    
                        <h4 class="product5-offer">40%</h4>
    
                        <p class="product5-quantity">Qnt: <input value="1" name="">
    
                        <p class="product5-remove">
    
                            <i class="fa fa-trash" aria-hidden="true"></i>
    
                            <span class="remove">Remove</span>
    
                        </p>
    
                    </div>
    
                </div>
    
            </div>
    
            <div class="cart-total">
    
                <p>
    
                    <span>Total Price</span>
    
                    <span>250</span>
    
                </p>
    
                <p>
    
                    <span>Number of Items</span>
    
                    <span>2</span>
    
                </p>
    
                <p>
    
                    <span>You Save</span>
    
                    <span>120</span>
    
                </p>
    
                <a href="#">Proceed to Checkout</a>
    
            </div>
    
        </div>
    
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row3">
                <div class="footer-col">
                <h4 style="text-align: left; padding-left: 0; font-size: 5rem; margin-left: 2px;margin-bottom: 5%;">OptiTrend</h4> 
                    <ul>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0; margin-bottom: 5%;">company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 5%;">get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 5%;">online shop</h4>
                    <ul>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">optic</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="text-align: left; padding-left: 0;margin-bottom: 5%;">contact us</h4>
                    <ul>
                        <li><a href="#">hajrbouhali07@gmail.com</a></li>
                        <li><a href="#">0684912299</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4   style="text-align: left; padding-left: 0;margin-bottom: 5%;">follow us</h4>
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
