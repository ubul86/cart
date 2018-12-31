<?php
namespace api\modules\cart\classes;

/**
 * Description of CartItem
 *
 * @author Gabor Sores
 */
class CartItem {
    public $id;
    public $itemId;
    public $itemName;
    public $quantity;
    
    public function __construct($itemId,$quantity) {     
        //Generate a random string to an unique id
        $this->id= \Yii::$app->security->generateRandomString();
        $this->itemId=$itemId;
        $this->quantity=$quantity;
        
        if($itemId){
            $model= \common\models\Item::findOne($this->itemId);
            $this->itemName=$model->name;
        }
    }
    
    /**
     * Get the CartItem unique Id
     * @return string
     */
    public function getUniqueId()
    {
        return $this->id;
    }
    
    /**
     * Get the Cart Item quantity
     * @return integer
     */
    public function getQuantity(){
        return $this->quantity;
    }
    
    /**
     * Get the CartItem ItemId
     * @return integer
     */
    public function getItemId(){
        return $this->item_id;
    }
    
    /**
     * Get an array of the properties
     * @return array
     */
    public function getItem(){
        return ['id' => $this->id,'item_id' => $this->itemId, 'quantity' => $this->quantity, 'item_name' => $this->itemName];
    }    
    
    
    public function getContent(){
        return $this->getItem();
    }
    
}
