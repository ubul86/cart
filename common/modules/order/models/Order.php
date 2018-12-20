<?php

namespace common\modules\order\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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

    public function getOrderItems(){
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
    
}
