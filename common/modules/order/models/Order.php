<?php

namespace common\modules\order\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\helpers\ResponseHelper;
use Exception;
use common\modules\order\models\OrderItem;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $user_id
 * @property string $session_id
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors() {
        return [[
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * Save the order
     * @param Cart $cart
     * @return boolean
     * @throws Exception
     */
    public function saveOrder($cart) {
        if ($this->validate()) {
            $transaction = $this->getDb()->beginTransaction();
            $this->save();
            foreach ($cart->getItems() as $item) {
                try {
                    $this->saveOrderItem($item);
                } catch (\Exception $ex) {                    
                    $transaction->rollBack();
                    throw new Exception($ex->getMessage());
                }
            }
            $transaction->commit();
        }
        return true;
    }
    
    /**
     * Save Order Item
     * @param CartItem $item
     * @throws Exception
     */
    private function saveOrderItem($item){
        try{
            $orderItem = new OrderItem();
            $orderItem->order_id = $this->id;
            $orderItem->item_id = $item->itemId;
            $orderItem->quantity = $item->quantity;
            $orderItem->save();
        } catch (Exception $ex) {            
            throw new Exception($ex->getMessage());
        }        
    }

}
