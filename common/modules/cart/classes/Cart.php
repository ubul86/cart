<?php
namespace common\modules\cart\classes;

use common\modules\cart\classes\CartItem;

/**
 * Description of Cart
 *
 * @author Gabor Sores
 */
class Cart {
    private $items;
    
    /**
     * Return all items from Cart
     * @return array
     */
    public function getItems(){
        return $this->items;
    }
    
    /**
     * Return one item from cart
     * @param integer $itemId
     * @return CartItem
     */
    public function getItem($itemId){
        return $this->items[$itemId];
    }
    
    /**
     * Return cart items to list
     * @return array
     */
    public function getItemsToList(){
        $output['items']=[];
        if($this->items){
            foreach($this->items as $item){
                $output['items'][]=$item->getContent();
            }
        }
        return $output;
    }
    
    /**
     * Add a net item into a cart
     * @param CartItem $item
     * @return CartItem
     */
    public function addItem(CartItem $item){
        $uniqueId = $item->getUniqueId();
        $this->items[$uniqueId] = $item;
        return $item;
    }
    
    /**
     * Remove an item from a cart by its uniqueid
     * @param integer $uniqueId
     * @return $this
     */
    public function removeItem($uniqueId){
        unset($this->items[$uniqueId]);
        return $this;
    }
    
    /**
     * Update an existing item by its uniqueid
     * @param integer $uniqueId
     * @param integer $quantity
     * @return $this
     */
    public function updateItem($uniqueId,$quantity){     
        $this->items[$uniqueId]->quantity=$quantity;
        return $this;
    }
    
}
