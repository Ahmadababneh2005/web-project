const detailAddButton = document.getElementById('detailAddButton');
const detailMessage = document.getElementById('detailMessage');

if (detailAddButton) {
    detailAddButton.addEventListener('click', function () {
        const saved = localStorage.getItem('courseShopCart');
        const cart = saved ? JSON.parse(saved) : [];
        const productId = Number(detailAddButton.getAttribute('data-id'));
        let found = false;

        for (let i = 0; i < cart.length; i++) {
            if (Number(cart[i].id) === productId) {
                cart[i].quantity = cart[i].quantity + 1;
                found = true;
                break;
            }
        }

        if (!found) {
            cart.push({
                id: productId,
                name: detailAddButton.getAttribute('data-name'),
                price: Number(detailAddButton.getAttribute('data-price')),
                image: detailAddButton.getAttribute('data-image'),
                quantity: 1
            });
        }

        localStorage.setItem('courseShopCart', JSON.stringify(cart));
        updateCartBadges();
        detailMessage.textContent = 'Product added to cart.';
        detailMessage.classList.add('success-text');
    });
}
