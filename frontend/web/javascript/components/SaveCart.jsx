class SaveCart extends React.Component {
    constructor() {
        super();               
    }
    
    saveCart() {
        this.props.saveCart();
    }

    render() {      
        const disabled = this.props.disabled;        
        return(
                <div className="saveCartContainer pull-right">                   
                    <button className="btn btn-primary saveCart" onClick={() => this.saveCart()} disabled={disabled} >Save Cart</button>
                </div>
                )
    }
}