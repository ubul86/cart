class Menu extends React.Component {
    constructor() {
        super();
        this.state = {
            items: {},
            cart: {},
        };
        this.addToCart = this.addToCart.bind(this);
        this.deleteFromCart = this.deleteFromCart.bind(this);
    }
    componentDidMount() {
        this.serverRequest = $.get("/api/list-available-items", function (items) {
            this.setState({
                items: items.message
            });
        }.bind(this));

        this.serverRequest = $.get("/api/list-cart-items", function (cartItems) {
            this.setState({
                cart: cartItems.message.items
            });
        }.bind(this));
    }

    addToCart(itemId, quantity) {
        let cart = this.state.cart;
        if (quantity > 0) {
            this.serverRequest = $.post("/api/add-item-to-cart", {item_id: itemId, quantity: quantity}, function (response) {
                cart.push(response.message.item);
                this.setState({
                    cart: cart
                });
            }.bind(this));
        }
    }

    deleteFromCart(uniqueId, index) {
        let cart = this.state.cart;
        if (uniqueId) {
            this.serverRequest = $.post("/api/delete-item-from-cart", {uniqueId: uniqueId}, function (response) {
                cart.splice(index, 1);
                this.setState({
                    cart: cart
                });
            }.bind(this));
        }
    }

    render() {
        const {items, cart} = this.state;
        return (
                <div className="Cart">
                    <div className="row">
                        <div className="col-xs-12 col-sm-6">
                            <div>
                                <h2>Items</h2>
                                <ul>
                                    {Object.keys(items).map(key => <Item key={key} index={key} details={items[key]} addToCart={this.addToCart} />)}
                                </ul>
                            </div>
                        </div>
                        <div className="col-xs-12 col-sm-6">
                            <div className="orders">
                                <h2>Your cart</h2>
                                <ul>
                                    {Object.keys(cart).map(key => <CartItem key={key} index={key} details={cart[key]} deleteFromCart={this.deleteFromCart} />)}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                );
    }
}