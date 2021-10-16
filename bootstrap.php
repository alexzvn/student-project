<?php

const BASE_PATH = __DIR__;

require_once 'autoload.php';
require_once 'core/helper.php';

$app = new \App\Application;

$app->container()->singleton(Core\Contracts\ApplicationContract::class, $app);
