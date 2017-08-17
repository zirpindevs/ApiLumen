<?php

namespace app;

use Yii;

/**
 * Class ApiApp
 * Facade class for decoupling api from the implementing framework
 * @package app
 */
class ApiApp
{
    const LUMEN_PATH = '../vendor/lumen/';
    const LUMEN_ENV_FILENAME = '.globalenv';

    /**
     * @return string
     */
    public static function getBaseUrl()
    {
        return Yii::$app->request->getBaseUrl();
    }
}