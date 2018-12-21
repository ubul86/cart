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
        this.props.addToCart(itemId, quantity);
        this.setState({
            quantity: 0
        });
    }

    render() {
        const {details, index} = this.props;
        return(
                <div className="col-xs-12 col-sm-4">
                    <div className="item">
                        <div className="item-name">
                            {details.name}
                        </div>
                        <div className="item-details">
                            <div className="item-quantity text-center">
                                <div>Quantity: </div>
                                <div>
                                    <input type="text" pattern="[0-9]*" onChange={this.handleChange.bind(this)} value={this.state.quantity} />
                                </div>                
                            </div>
                            <div className="item-add-btn text-center">
                                <button className="btn btn-primary" onClick={() => this.addToCart(details.id, this.state.quantity)}>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                )
    }
}