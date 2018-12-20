<?php

namespace common\modules\order\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order_item".
 *
 * @property string $id
 * @property string $order_id
 * @property string $item_id
 * @property string $item_count
 * @property int $item_price
 * @property string $created_at
 * @property string $updated_at
 */
class OrderItem extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['order_id', 'item_id'], 'required'],
            [['order_id', 'item_id', 'item_count', 'item_price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
            'item_count' => 'Item Count',
            'item_price' => 'Item Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors() {
        return [ [
            'class' => \yii\behaviors\TimestampBehavior::className(),
            'attributes' => [
                \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
            'value' => new \yii\db\Expression('NOW()'),
        ],    
        ];
       
    }
    
    public function getOrder(){
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
    
    public function getItem(){
        return $this->hasOne(\common\models\Item::class,['id' => 'item_id']);
    }

}
