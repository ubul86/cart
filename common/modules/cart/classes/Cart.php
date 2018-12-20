<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\modules\cart\classes;

use common\modules\cart\classes\CartItem;

/**
 * Description of Cart
 *
 * @author ubul8
 */
class Cart {
    private $items;
    
    
    public function getItems(){
        return $this->items;
    }
    
    public function getItem($itemId){
        return $this->items[$itemId];
    }
    
    public function getItemsToList(){
        $output['items']=[];
        if($this->items){
            foreach($this->items as $item){
                $output['items'][]=$item->getContent();
            }
        }
        return $output;
    }
    
    public function addItem(CartItem $item){
        $uniqueId = $item->getUniqueId();
        $this->items[$uniqueId] = $item;
        return $item;
    }
    
    public function removeItem($uniqueId){
        unset($this->items[$uniqueId]);
        return $this;
    }
    
    public function updateItem($uniqueId,$quantity){     
        $this->items[$uniqueId]->quantity=$quantity;
        return $this;
    }
    
}
