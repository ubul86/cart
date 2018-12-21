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
                        cart: {}
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
        const {items, cart, message}
        = this.state;
        return (
                <div>  
                    <div className="header">
                        <div className="row">                            
                            <div className="col-xs-12 cart-wrapper">                
                                <div className="cart">                                      
                                    <div className="cart-header">
                                        <div className="row">
                                            <div className="col-xs-4">
                                                Item name
                                            </div>
                                            <div className="col-xs-4 text-right">
                                                Quantity
                                            </div>
                                            <div className="col-xs-4 text-right">
                                                Delete
                                            </div>
                                        </div>      
                                    </div>
                                    <div className="cart-body">
                                        {cart.length > 0 ? Object.keys(cart).map(key => <CartItem key={key} index={key} details={cart[key]} deleteFromCart={this.deleteFromCart} />) : "Cart is empty"}                                
                                    </div>
                                    <div className="cart-footer">
                                        <div className="row">     
                                            <div className="col-xs-12">
                                                <div className="row">
                                                    <div className="col-xs-6 pull-left">
                                                        <UnsetCart unsetCart={this.unsetCart} disabled={(cart.length <= 0 || typeof cart === undefined)}/>
                                                    </div>
                                                    <div className="col-xs-6">
                                                        <SaveCart saveCart={this.saveCart} disabled={(cart.length <= 0 || typeof cart === undefined)} />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>            
                            </div>                
                        </div>
                    </div>                    
                    <div className="cart-items">
                        <div className="row">                    
                            <div className="col-xs-12">
                                <div>
                                    <h2>Items</h2>
                                    <div className="row">                                        
                                        {Object.keys(items).map(key => <Item key={key} index={key} details={items[key]} addToCart={this.addToCart} />)}                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <SnackBar message={message}/>
                </div>



                );
    }
}