<?php

namespace yii2mod\cart\tests;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the base class for all yii framework unit tests.
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->mockApplication();

        $this->setupTestDbData();
    }

    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     *
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'sqlite::memory:',
                ],
                'session' => [
                    'class' => 'yii\web\DbSession',
                ],
                'cart' => [
                    'class' => 'yii2mod\cart\Cart',
                ],
            ],
        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
    }

    /**
     * Setup tables for test ActiveRecord
     */
    protected function setupTestDbData()
    {
        $db = Yii::$app->getDb();

        // Structure :

        $db->createCommand()->createTable('cart', [
            'sessionId' => 'string primary key',
            'cartData' => 'text',
        ])->execute();

        $db->createCommand()->createTable('product', [
            'id' => 'pk',
            'name' => 'string',
            'price' => 'decimal',
        ])->execute();

        $db->createCommand()->createTable('session', [
            'id' => 'char(40) not null primary key',
            'expire' => 'integer',
            'data' => 'longblob',
        ])->execute();

        // Data :

        $db->createCommand()->insert('product', [
            'name' => 'Amazon Kindle',
            'price' => 100,
        ])->execute();
    }
}
