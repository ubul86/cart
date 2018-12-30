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

        axios.get("/api/list-available-items")
                .then(response => {
                    if (response.data.result == 1) {
                        me.setState({
                            items: response.data.message
                        });
                    } else {
                        me.notify(response.data.message);
                    }
                }).catch(function (error) {
            me.notify("Internal server error");
        });

        axios.get("/api/list-cart-items")
                .then(response => {
                    if (response.data.result == 1) {
                        me.setState({
                            cart: response.data.message.items
                        });
                    } else {
                        me.notify(response.data.message);
                    }
                }).catch(function (error) {
            me.notify("Internal server error");
        });

    }

    unsetCart() {
        if (this.state.cart.length > 0) {
            axios.delete("/api/unset-cart")
                    .then(response => {
                        if (response.data.result == 1) {
                            this.setState({
                                cart: []
                            });
                        }
                        this.notify(response.data.message);
                    }).catch(function (error) {
                this.notify("Internal server error");
            });
        } else {
            this.notify("Cart is empty");
        }
    }

    saveCart() {
        if (this.state.cart.length > 0) {
            axios.post("/api/save-cart")
                    .then(response => {
                        if (response.data.result == 1) {
                            this.setState({
                                cart: []
                            });
                        }
                        this.notify(response.data.message);
                    }).catch(function (error) {
                this.notify("Internal server error");
            });
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
            axios.post("/api/add-item-to-cart", Qs.stringify({item_id: itemId, quantity: quantity}))
                    .then(response => {
                        if (response.data.result == 1) {
                            let update = false;
                            cart.map((cartData, index) => {
                                if (cartData.id === response.data.message.item.id) {
                                    update = true;
                                    cart[index].quantity = response.data.message.item.quantity;
                                }
                            });
                            if (update == false) {
                                cart.push(response.data.message.item);
                            }
                            this.setState({
                                cart: cart
                            });
                            this.notify("You successfully add an item to your cart.");
                        } else {
                            this.notify(response.data.message);
                        }
                    }).catch(function (error) {
                this.notify("Internal server error");
            });
        }
    }

    deleteFromCart(uniqueId, index) {
        let cart = this.state.cart;
        if (uniqueId) {
            axios.delete("/api/delete-item-from-cart", {params: {uniqueId: uniqueId}})
                    .then(response => {
                        if (response.data.result == 1) {
                            cart.splice(index, 1);
                            this.setState({
                                cart: cart
                            });
                        } else {
                            this.notify(response.data.message);
                        }
                    }).catch(function (error) {
                this.notify("Internal server error");
            });
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