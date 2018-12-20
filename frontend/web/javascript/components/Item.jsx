class Item extends React.Component {
    constructor() {
        super();
        this.state = {
            quantity: 0
        }        
    }
    handleChange(event) {
        this.setState({quantity: event.target.value})
    }

    addToCart(itemId, quantity) {
        this.props.addToCart(itemId,quantity);
        this.setState({
            quantity: 0
        });
    }

    render() {
        const {details, index} = this.props;
        return(
                <div className="item">
                    {details.name}
                    Mennyiség: <input type="text" pattern="[0-9]*" onChange={this.handleChange.bind(this)} value={this.state.quantity} />
                    <button className="btn btn-primary" onClick={() => this.addToCart(details.id, this.state.quantity)}>Add to cart</button>
                </div>
                )
    }
}