<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Debugging</title>
</head>
<body>
    <h2 data-product-name="Product Name" data-product-price="100" data-product-id="1" data-product-image="product.jpg">Product</h2>
    <input type="number" id="totalItems" value="1" min="1">
    <button id="btn" type="button">Add to Cart</button>
    <div id="cart-box">
        <div id="products"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addToCartButton = document.querySelector('#btn');
            const totalItemsInput = document.getElementById('totalItems');
            const cartProductsContainer = document.getElementById('products');

            addToCartButton.addEventListener('click', () => {
                const totalItems = parseInt(totalItemsInput.value);
                const productName = document.querySelector('h2[data-product-name]').getAttribute('data-product-name');
                const productPrice = parseFloat(document.querySelector('h2[data-product-price]').getAttribute('data-product-price'));
                const productId = document.querySelector('h2[data-product-id]').getAttribute('data-product-id');
                const productImage = document.querySelector('h2[data-product-image]').getAttribute('data-product-image');

                const product = { name: productName, value: productPrice, amount: totalItems, src: productImage, id: productId };

                console.log('Adding product to cart:', product);

                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.push(product);
                localStorage.setItem('cart', JSON.stringify(cart));

                console.log('Updated cart:', cart);

                showCartItems();
            });

            function showCartItems() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                console.log('Cart items:', cart);

                if (cart.length > 0) {
                    cartProductsContainer.innerHTML = '';
                    cart.forEach(cartProduct => {
                        const productDiv = document.createElement('div');
                        productDiv.className = 'product';

                        const productTitle = document.createElement('h3');
                        productTitle.textContent = cartProduct.name;

                        const productAmount = document.createElement('span');
                        productAmount.textContent = ` x ${cartProduct.amount} `;

                        const productPrice = document.createElement('span');
                        productPrice.textContent = `$${(cartProduct.value * cartProduct.amount).toFixed(2)}`;

                        productDiv.append(productTitle, productAmount, productPrice);
                        cartProductsContainer.appendChild(productDiv);
                    });
                } else {
                    cartProductsContainer.innerHTML = '<span>Your cart is empty.</span>';
                }
            }

            // Initial load
            showCartItems();
        });
    </script>
</body>
</html>
