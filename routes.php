<?php

use Laravel\Lumen\Application;

/** @var Application $app */

$app->get('/', 'MyController@index');

$app->get('/ajax', 'MyController@ajax');