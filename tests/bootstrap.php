<?php

use Nip\Container\Container;

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

Container::setInstance(new Container());
Container::getInstance()->set('inflector', \Nip\Inflector\Inflector::instance());
Container::getInstance()->set('config', new \Nip\Config\Config());

require dirname(__DIR__) . '/vendor/autoload.php';
