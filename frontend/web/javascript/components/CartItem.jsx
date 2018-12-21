class CartItem extends React.Component {
    constructor() {
        super()
    }

    deleteFromCart(uniqueId, index) {
        this.props.deleteFromCart(uniqueId, index);
    }

    render() {
        const {details, index} = this.props;        
        return (
                <div className="row">
                    <div className="itemDescription">
                        <div className="col-xs-4 itemName">{details.item_name}</div>
                        <div className="col-xs-4 quantity text-right">{details.quantity}</div>
                        <div className="col-xs-4 deleteItem text-right"><i className="fa fa-trash" aria-hidden="true" onClick={() => this.deleteFromCart(details.id, index)}></i></div>
                    </div>     
                </div>
                )
    }
}