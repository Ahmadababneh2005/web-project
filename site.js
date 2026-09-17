function readCart() {
    const saved = localStorage.getItem('courseShopCart');
    return saved ? JSON.parse(saved) : [];
}

function countCartItems() {
    const cart = readCart();
    let total = 0;

    cart.forEach(function (item) {
        total += item.quantity;
    });

    return total;
}

function updateCartBadges() {
    const total = countCartItems();
    const badge = document.getElementById('cartCount');
    const dashboardCount = document.getElementById('dashboardCartCount');

    if (badge) {
        badge.textContent = total;
    }

    if (dashboardCount) {
        dashboardCount.textContent = total;
    }
}

updateCartBadges();
