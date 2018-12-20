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
                <div className="cartItem">{details.id} <span onClick={() => this.deleteFromCart(details.id, index)}>X</span></div>
                )
    }
}