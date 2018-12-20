class Menu extends React.Component {
    constructor() {
        super();
        this.state = {
            items: {},
            cart: {},
            message: '',
        };
        this.notify = this.notify.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.deleteFromCart = this.deleteFromCart.bind(this);
        this.unsetCart = this.unsetCart.bind(this);
        this.saveCart = this.saveCart.bind(this);
        this.emptyMessage = this.emptyMessage.bind(this);


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

    unsetCart() {
        if (this.state.cart.length > 0) {
            this.serverRequest = $.post("/api/unset-cart", function (response) {
                this.setState({
                    cart: {}
                });
            }.bind(this));
        } else {
            this.notify("Cart is empty");
        }
    }

    saveCart() {
        if (this.state.cart.length > 0) {
            this.serverRequest = $.post("/api/save-cart", function (response) {
                this.setState({
                    cart: {}
                });
            }.bind(this));
        } else {
            this.notify("Cart is empty");
        }
    }

    notify(message) {
        this.setState({
            "message": message
        });
        var me = this;
        setTimeout(function () {
            me.emptyMessage()
        }, 3000);
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

    emptyMessage() {
        this.setState({
            "message": ""
        })
    }

    render() {
        const {items, cart, message} = this.state;
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
                    <div className="row">
                        <div className="col-xs-12 col-sm-6">
                            <SaveCart saveCart={this.saveCart} />
                        </div>
                        <div className="col-xs-12 col-sm-6">
                            <UnsetCart unsetCart={this.unsetCart} disabled={(cart.length <= 0 || typeof cart === undefined)}/>
                        </div>
                    </div>
                    <SnackBar message={message}/>
                </div>
                );
    }
}