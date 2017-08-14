<?php

namespace yii2mod\cart\tests\data;

use yii\db\ActiveRecord;
use yii2mod\cart\models\CartItemInterface;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $price
 */
class Product extends ActiveRecord implements CartItemInterface
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'product';
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUniqueId(): int
    {
        return $this->id;
    }
}
