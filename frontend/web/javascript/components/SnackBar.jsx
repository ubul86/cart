/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class SnackBar extends React.Component {
    render() {
        return (
                <div id="snackbar" className={this.props.message ? "show" : ""}>{this.props.message}</div>
                );
    }
}
;
