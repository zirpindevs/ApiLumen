<?php

use Laravel\Lumen\Application;

/** @var Application $app */

$app->get('/', 'MyController@index');

$app->get('/get_query_string', 'MyController@get_query_string');

$app->get('/foundStringCaseInsensitive', 'MyController@foundStringCaseInsensitive');
;