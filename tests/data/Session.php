<?php

namespace yii2mod\cart\tests\data;

class Session extends \yii\web\Session
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // blank, override, preventing shutdown function registration
    }

    /**
     * @inheritdoc
     */
    public function open()
    {
        // blank, override, preventing session start
    }
}
