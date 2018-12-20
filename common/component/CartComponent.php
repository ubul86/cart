<?php

namespace common\component;

use Yii;
use yii\base\Component;
use yii\base\InvalidParamException;
use common\modules\cart\classes\CartItem;
use yii\helpers\ArrayHelper;
use common\helpers\ResponseHelper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartComponent
 *
 * @author ubul8
 */
class CartComponent extends Component {

    protected $cart;

    public function init() {
        $cart = \Yii::$app->session->get('cart');
        if (!$cart) {
            $cart = new \common\modules\cart\classes\Cart();
            \Yii::$app->session->set('cart', $cart);
        }
        $this->cart = Yii::$app->session->get('cart', null);
    }

    public function addItemToCart(CartItem $item) {
        $this->getCart()->addItem($item);
    }

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
    
    public function unsetCart() {
        \Yii::$app->session->remove('cart');        
        $this->cart = null;
    }

    /**
     * @param string $itemType If specified, only items of that type will be counted
     *
     * @return int
     */
    public function getCount() {
        return count($this->getItems());
    }

    /**
     * Returns all items of a given type from the cart
     * @return
     */
    public function getItems() {
        return $this->getCart()->getItems();
    }

    public function getItemByUniqueId($uniqueId){
        return $this->getCart()->getItem($uniqueId);
    }
    
    public function getItemByItemId($itemId){
        if(!$this->getCount()){
            return false;
        }
        $items=$this->getItems();
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
