<?php

namespace yii2mod\cart\tests\data;

use yii\db\ActiveRecord;
use yii2mod\cart\models\CartItemInterface;

/**
 * Class ProductModel
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 */
class ProductModel extends ActiveRecord implements CartItemInterface
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'Product';
    }


    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUniqueId()
    {
        return $this->id;
    }
}