const addButtons = document.querySelectorAll('.add-cart-button');

addButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        const saved = localStorage.getItem('courseShopCart');
        const cart = saved ? JSON.parse(saved) : [];
        const id = Number(button.getAttribute('data-id'));
        let found = false;

        for (let i = 0; i < cart.length; i++) {
            if (Number(cart[i].id) === id) {
                cart[i].quantity = cart[i].quantity + 1;
                found = true;
                break;
            }
        }

        if (!found) {
            cart.push({
                id: id,
                name: button.getAttribute('data-name'),
                price: Number(button.getAttribute('data-price')),
                image: button.getAttribute('data-image'),
                quantity: 1
            });
        }

        localStorage.setItem('courseShopCart', JSON.stringify(cart));
        updateCartBadges();

        const message = button.nextElementSibling;
        message.textContent = 'Added to cart';
        message.classList.add('success-text');
    });
});
