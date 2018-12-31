<?php

namespace api\component;

use Yii;
use yii\base\Component;
use \api\modules\cart\classes\Cart;
use api\modules\cart\classes\CartItem;
use yii\helpers\ArrayHelper;
use common\helpers\ResponseHelper;


/**
 * Cart component to handle cart with session
 *
 * @author Gabor Sores
 */
class CartComponent extends Component {

    protected $cart;

    public function init() {
        $cart = \Yii::$app->session->get('cart');
        if (!$cart) {
            $cart = new \api\modules\cart\classes\Cart();
            \Yii::$app->session->set('cart', $cart);            
        }
        $this->cart = Yii::$app->session->get('cart', null);
    }

    /**
     * Add an item to a cart
     * @param CartItem $item
     */
    public function addItemToCart(CartItem $item) {
        $this->getCart()->addItem($item);
    }

    /**
     * Delete an existing item from cart
     * @param string $uniqueId
     * @return $this
     * @throws \Exception
     */
    public function deleteItemFromCart($uniqueId) {
        if(!$this->getCount()){
            throw new \Exception(ResponseHelper::MESSAGE_CART_EMPTY_CART);
        }
        if (!ArrayHelper::keyExists($uniqueId, $this->getItems())) {
            throw new \Exception('Item not found');
        }
        $this->getCart()->removeItem($uniqueId);
        return $this;
    }

    /**
     * Update an existing item quantity
     * @param string $uniqueId
     * @param integer $quantity
     * @return $this
     * @throws \Exception
     */
    public function updateItemFromCart($uniqueId,$quantity){    
        if(!$this->getCount()){
            throw new \Exception(ResponseHelper::MESSAGE_CART_EMPTY_CART);
        }
        if (!ArrayHelper::keyExists($uniqueId, $this->getItems())) {
            throw new \Exception('Item not found');
        }        
        $this->getCart()->updateItem($uniqueId,$quantity);
        return $this;
    }
    
    /**
     * Unset the cart, and session
     */
    public function unsetCart() {
        \Yii::$app->session->remove('cart');        
        $this->cart = null;
    }

    /**
     * Get The item count from cart     
     * @return int
     */
    public function getCount() {
        return count($this->getItems());
    }

    /**
     * Returns all items of a given type from the cart
     * @return Cart
     */
    public function getItems() {
        return $this->getCart()->getItems();
    }

    /**
     * Return a Cart Item by its uniqueid
     * @param string $uniqueId
     * @return CartItem
     */
    public function getItemByUniqueId($uniqueId){
        return $this->getCart()->getItem($uniqueId);
    }
    
    /**
     * Return a Cart Item by item_id
     * @param integer $itemId
     * @return boolean
     */
    public function getItemByItemId($itemId){
        if(!$this->getCount()){
            return false;
        }        
        foreach($this->getItems() as $uniqueId => $cartItem){
            if($cartItem->itemId==$itemId){                
                return $this->getItemByUniqueId($uniqueId);
            }
        }        
        return false;
    }
    
    public function getCart() {
        return $this->cart;
    }

}
