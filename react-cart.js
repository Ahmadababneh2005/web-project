function CartItem(props) {
    return (
        <article className="cart-item">
            <img src={props.item.image} alt={props.item.name} />
            <div className="cart-item-main">
                <h2>{props.item.name}</h2>
                <p>${Number(props.item.price).toFixed(2)} each</p>
                <div className="quantity-control">
                    <button type="button" onClick={function () { props.changeQuantity(props.item.id, -1); }}>-</button>
                    <span>{props.item.quantity}</span>
                    <button type="button" onClick={function () { props.changeQuantity(props.item.id, 1); }}>+</button>
                </div>
            </div>
            <div className="cart-item-end">
                <strong>${(Number(props.item.price) * props.item.quantity).toFixed(2)}</strong>
                <button className="remove-button" type="button" onClick={function () { props.removeItem(props.item.id); }}>Remove</button>
            </div>
        </article>
    );
}

function CartApp() {
    const saved = localStorage.getItem('courseShopCart');
    const initialCart = saved ? JSON.parse(saved) : [];
    const [cart, setCart] = React.useState(initialCart);

    function store(nextCart) {
        setCart(nextCart);
        localStorage.setItem('courseShopCart', JSON.stringify(nextCart));
        updateCartBadges();
    }

    function changeQuantity(id, amount) {
        const nextCart = [];

        for (let i = 0; i < cart.length; i++) {
            const item = cart[i];
            let quantity = item.quantity;

            if (Number(item.id) === Number(id)) {
                quantity = quantity + amount;
                if (quantity < 1) {
                    quantity = 1;
                }
            }

            nextCart.push({
                id: item.id,
                name: item.name,
                price: item.price,
                image: item.image,
                quantity: quantity
            });
        }

        store(nextCart);
    }

    function removeItem(id) {
        const nextCart = [];

        for (let i = 0; i < cart.length; i++) {
            if (Number(cart[i].id) !== Number(id)) {
                nextCart.push(cart[i]);
            }
        }

        store(nextCart);
    }

    function clearCart() {
        store([]);
    }

    let total = 0;
    let itemCount = 0;

    for (let i = 0; i < cart.length; i++) {
        total = total + Number(cart[i].price) * cart[i].quantity;
        itemCount = itemCount + cart[i].quantity;
    }

    if (cart.length === 0) {
        return (
            <section className="empty-state">
                <h2>Your cart is empty</h2>
                <p>Add a product from the catalog to see it here.</p>
                <a className="primary-btn" href="products.php">Browse Products</a>
            </section>
        );
    }

    return (
        <section className="cart-layout">
            <div className="cart-list">
                {cart.map(function (item) {
                    return (
                        <CartItem
                            key={item.id}
                            item={item}
                            changeQuantity={changeQuantity}
                            removeItem={removeItem}
                        />
                    );
                })}
            </div>

            <aside className="order-summary">
                <p className="eyebrow">SUMMARY</p>
                <h2>Order Total</h2>
                <div className="summary-row">
                    <span>Items</span>
                    <strong>{itemCount}</strong>
                </div>
                <div className="summary-row total-row">
                    <span>Total</span>
                    <strong>${total.toFixed(2)}</strong>
                </div>
                <button className="secondary-btn full-btn" type="button" onClick={clearCart}>Clear Cart</button>
                <p className="muted small-note">Checkout is not included because it is outside the requested course pages.</p>
            </aside>
        </section>
    );
}

const cartRoot = ReactDOM.createRoot(document.getElementById('cartRoot'));
cartRoot.render(<CartApp />);
