class Items extends React.Component {
    constructor(props) {
        super(props)
    }

    render() {
        const {items, addToCart} = this.props;
        return (
                <div className="row">                    
                    <div className="col-xs-12">
                        <div>
                            <h3>Items</h3>
                            <div className="row">                                        
                                {Object.keys(items).map(key => <Item key={key} index={key} details={items[key]} addToCart={addToCart} />)}                                        
                            </div>
                        </div>
                    </div>
                </div>
                )
    }
}