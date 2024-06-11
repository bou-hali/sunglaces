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
            const plus = document.getElementById('plus')
            const minus = document.getElementById('minus')
            const totalItems = document.getElementById('totalItems')

            plus.addEventListener('click', () => {
                totalItems.value++
            })

            minus.addEventListener('click', () => {
                totalItems.value--
                if (totalItems.value == 0 || totalItems.value < 0) {
                    totalItems.value = 1
                }
            })

            totalItems.addEventListener('change', () => {
                if (totalItems.value == 0 || totalItems.value < 0) {
                    totalItems.value = 1
                }
            })
            /** add product to cart **/

                document.querySelector('#btn').addEventListener('click', () => {
                let totalItems = document.getElementById('totalItems').value

                let Sunglasses = {
                    name: 'Fall Limited Edition Sneakers',
                    value: 125.00,
                    amount: totalItems,
                    src: 'b42a8df05cc65fe5d770b3b403c27b99.jpg',
                    id: 1
                }

                localStorage.setItem('cart', JSON.stringify(Sunglasses))

                showItemOnCart()


})
       function showItemOnCart() {

  let cart = localStorage.getItem("cart")

  if (cart !== null && cart !== "") {
    document.getElementById('cartDiv').classList.remove('empty')
    let cartBoxProducts = document.getElementById('products')
    cartBoxProducts.classList.remove('empty')
    cartBoxProducts.innerHTML = ''

    let checkout = document.getElementById('checkout')
    checkout.classList.remove('hide')
    let cartProduct = JSON.parse(localStorage.getItem("cart"))

    // product Div
    let productDiv = document.createElement('div')
    productDiv.className = 'product'

    // Description Div Start
    let descriptionDiv = document.createElement('div')
    descriptionDiv.className = 'description'

    let img = document.createElement('img')
    img.className = 'productImg'
    img.src = cartProduct.src

    // info Div Start

    let infoDiv = document.createElement('div')
    infoDiv.className = 'info'

    let productTitle = document.createElement('h3')
    productTitle.innerHTML = cartProduct.name

    let singleValue = document.createElement('span')
    singleValue.className = 'singleValue'
    singleValue.innerHTML = `$${cartProduct.value.toFixed(2)} `

    let amount = document.createElement('span')
    amount.className = 'amount'
    amount.innerHTML = `x ${cartProduct.amount} `

    let finalValue = document.createElement('span')
    finalValue.className = 'finalValue'
    finalValue.innerHTML = `$${(cartProduct.value * cartProduct.amount).toFixed(2)}`

    infoDiv.appendChild(productTitle)
    infoDiv.appendChild(singleValue)
    infoDiv.appendChild(amount)
    infoDiv.appendChild(finalValue)

    // info Div end

    // remove Div start

    let removeDiv = document.createElement('div')
    removeDiv.className = 'remove'
    removeDiv.innerHTML = '<img src="icon-delete.svg">'

    removeDiv.addEventListener('click', () => {
      localStorage.setItem("cart", "")
      document.getElementById('products').innerHTML = ''
      showItemOnCart()
    })
     
  
  descriptionDiv.appendChild(img)
    descriptionDiv.appendChild(infoDiv)
    descriptionDiv.appendChild(removeDiv)


    // Description Div End

    productDiv.appendChild(descriptionDiv)

    cartBoxProducts.appendChild(productDiv)

    document.querySelector('#cartDiv').setAttribute('data-content', cartProduct.amount)

    productDiv.appendChild(descriptionDiv)

    cartBoxProducts.appendChild(productDiv)

    document.querySelector('#cartDiv').setAttribute('data-content', cartProduct.amount)


  } else {

    document.getElementById('cartDiv').classList.add('empty')

    let cartBoxProducts = document.getElementById('products')
    cartBoxProducts.classList.add('empty')
    cartBoxProducts.innerHTML = ''
    let checkout = document.getElementById('checkout')
    checkout.classList.add('hide')

    let span = document.createElement('span')
    span.className = 'emptyCart'

    span.innerHTML = 'Your cart is empty.'

    cartBoxProducts.appendChild(span)
  }

}
let cart = document.getElementById('cartIcon')

cart.addEventListener('click', () => {
  let cartBox = document.getElementById('cart-box')
  cartBox.classList.toggle('hide')
  cartBox.addEventListener('mouseleave', () => {
    cartBox.classList.add('hide')
  })
  showItemOnCart()
})

window.addEventListener('load', () => {
  showItemOnCart()
})

/** mobile menu **/

document.getElementById('hamburger').addEventListener('click', () => {
  document.getElementById('navItems').classList.add('show')
})

document.getElementById('closeIcon').addEventListener('click', () => {
  document.getElementById('navItems').classList.remove('show')
})
