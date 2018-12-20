class UnsetCart extends React.Component {
    constructor() {
        super();               
    }
    
    unsetCart() {
        this.props.unsetCart();
    }

    render() {      
        const disabled = this.props.disabled;        
        return(
                <div className="unsetCartContainer">                   
                    <button className="btn btn-primary unsetCart" onClick={() => this.unsetCart()} disabled={disabled}>Unset Cart</button>
                </div>
                )
    }
}