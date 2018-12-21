class Main extends React.Component {
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

        let me = this;
        this.serverRequest = $.get("/api/list-available-items", function (response) {
            if (response.result == 1) {
                me.setState({
                    items: response.message
                });
            } else {
                me.notify(response.message);
            }
        }.bind(this)).fail(function (error) {
            me.notify("Internal server error");
        });

        this.serverRequest = $.get("/api/list-cart-items", function (response) {
            if (response.result == 1) {
                me.setState({
                    cart: response.message.items
                });
            } else {
                this.notify(response.message);
            }
        }.bind(this)).fail(function (error) {
            me.notify("Internal server error");
        });
    }

    unsetCart() {
        if (this.state.cart.length > 0) {
            this.serverRequest = $.post("/api/unset-cart", function (response) {
                if (response.result == 1) {
                    this.setState({
                        cart: []
                    });
                } else {
                    this.notify(response.message);
                }
            }.bind(this));
        } else {
            this.notify("Cart is empty");
        }
    }

    saveCart() {
        if (this.state.cart.length > 0) {
            this.serverRequest = $.post("/api/save-cart", function (response) {
                this.setState({
                    cart: []
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
                if (response.result == 1) {
                    cart.push(response.message.item);
                    this.setState({
                        cart: cart
                    });
                } else {
                    this.notify(response.message);
                }
            }.bind(this));
        }
    }

    deleteFromCart(uniqueId, index) {
        let cart = this.state.cart;
        if (uniqueId) {
            this.serverRequest = $.post("/api/delete-item-from-cart", {uniqueId: uniqueId}, function (response) {
                if (response.result == 1) {
                    cart.splice(index, 1);
                    this.setState({
                        cart: cart
                    });
                } else {
                    this.notify(response.message);
                }
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
                <div>  
                    <Cart items={items} cart={cart} deleteFromCart={this.deleteFromCart} unsetCart={this.unsetCart} saveCart={this.saveCart}/>                 
                    <Items items={items} addToCart={this.addToCart} />
                    <SnackBar message={message}/>
                </div>



                );
    }
}