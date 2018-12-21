class Cart extends React.Component {
    constructor(props) {
        super(props)
    }
    
    render() {
        const {cart,deleteFromCart,unsetCart,saveCart} = this.props;
        return (
                <div className="header">
                    <div className="row">  
                        <div className="col-xs-12">
                            <h3>Your cart</h3>
                        </div>
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
                                    {cart.length > 0 ? Object.keys(cart).map(key => <CartItem key={key} index={key} details={cart[key]} deleteFromCart={deleteFromCart} />) : "Cart is empty"}                                
                                </div>
                                <div className="cart-footer">
                                    <div className="row">     
                                        <div className="col-xs-12">
                                            <div className="row">
                                                <div className="col-xs-6 pull-left">
                                                    <UnsetCart unsetCart={unsetCart} disabled={(cart.length <= 0 || typeof cart === undefined)}/>
                                                </div>
                                                <div className="col-xs-6">
                                                    <SaveCart saveCart={saveCart} disabled={(cart.length <= 0 || typeof cart === undefined)} />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        </div>                
                    </div>
                </div>
                )
    }
}