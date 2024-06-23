const smallpictures = document.querySelectorAll('.smallpictures')
const emphasisPicture = document.getElementById('emphasisPicture')

smallpictures.forEach(picture => {
    picture.addEventListener('click', (e) => {
        const src = picture.src.replace('-thumbnail', '')
        const currentActivePicture = document.querySelector('.active')

        currentActivePicture.classList.remove('active')
        picture.classList.add('active')


        emphasisPicture.src = src
    })
})
document.addEventListener('DOMContentLoaded', () => {
    // Elements
    const minusButton = document.getElementById('minus');
    const plusButton = document.getElementById('plus');
    const totalItemsInput = document.getElementById('totalItems');
    const addToCartButton = document.getElementById('btn');
    const cartIcon = document.getElementById('cartIcon');
    const cartBox = document.getElementById('cart-box');
    const productsContainer = document.getElementById('products');
    const checkoutButton = document.getElementById('checkout');

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Update the cart icon
    const updateCartIcon = () => {
        cartIcon.classList.toggle('empty', cart.length === 0);
        cartIcon.classList.toggle('filled', cart.length > 0);
    };

    // Update cart UI
    const updateCartUI = () => {
        productsContainer.innerHTML = '';
        cart.forEach(product => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('product');
            productDiv.innerHTML = `
                <div class="product-details">
                    <span class="product-name">${product.name}</span>
                    <span class="product-price">${product.price} x ${product.quantity}</span>
                </div>
                <button class="remove-btn" data-id="${product.id}">Remove</button>
            `;
            productsContainer.appendChild(productDiv);
        });
    };

    // Add to cart functionality
    const addToCart = (id, name, price) => {
        const existingProduct = cart.find(product => product.id === id);
        if (existingProduct) {
            existingProduct.quantity += parseInt(totalItemsInput.value);
        } else {
            cart.push({
                id,
                name,
                price,
                quantity: parseInt(totalItemsInput.value)
            });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartUI();
        updateCartIcon();
    };

    // Increment and decrement buttons
    minusButton.addEventListener('click', () => {
        if (totalItemsInput.value > 1) {
            totalItemsInput.value = parseInt(totalItemsInput.value) - 1;
        }
    });

    plusButton.addEventListener('click', () => {
        totalItemsInput.value = parseInt(totalItemsInput.value) + 1;
    });

    // Add to cart button
    addToCartButton.addEventListener('click', () => {
        const productId = document.querySelector('input[name="idp"]').value;
        const productName = document.querySelector('.companyName').textContent;
        const productPrice = document.querySelector('.productValue').textContent;
        addToCart(productId, productName, productPrice);
    });

    // Cart icon toggle
    cartIcon.addEventListener('click', () => {
        cartBox.classList.toggle('hide');
    });

    // Remove product from cart
    productsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-btn')) {
            const productId = event.target.dataset.id;
            cart = cart.filter(product => product.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
            updateCartIcon();
        }
    });

    // Initial UI update
    updateCartUI();
    updateCartIcon();
});

