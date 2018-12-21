<?php
namespace common\modules\cart\classes;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartItem
 *
 * @author ubul8
 */
class CartItem {
    public $id;
    public $itemId;
    public $itemName;
    public $quantity;
    
    public function __construct($itemId,$quantity) {        
        $this->id= \Yii::$app->security->generateRandomString();
        $this->itemId=$itemId;
        $this->quantity=$quantity;
        
        if($itemId){
            $model= \common\models\Item::findOne($this->itemId);
            $this->itemName=$model->name;
        }
    }
    
    public function getUniqueId()
    {
        return $this->id;
    }
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function getItemId(){
        return $this->item_id;
    }
    
    public function getItem(){
        return ['id' => $this->id,'item_id' => $this->itemId, 'quantity' => $this->quantity, 'item_name' => $this->itemName];
    }    
    
    public function getContent(){
        return $this->getItem();
    }
    
}
