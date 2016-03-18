<?php

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('development', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array(
  'dsn' => 'mysql:host=localhost;dbname=dbname',
  'user' => 'root',
  'password' => '',
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'attributes' =>
  array(
    'ATTR_EMULATE_PREPARES' => false,
  ),
  'settings' =>
  array(
    'charset' => 'utf8',
    'queries' =>
    array(
    ),
  ),
));
$manager->setName('development');
$serviceContainer->setConnectionManager('development', $manager);
$serviceContainer->setAdapterClass('production', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array(
  'dsn' => 'mysql:host=localhost;dbname=dbname',
  'user' => 'root',
  'password' => '',
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'attributes' =>
  array(
    'ATTR_EMULATE_PREPARES' => false,
  ),
  'settings' =>
  array(
    'charset' => 'utf8',
    'queries' =>
    array(
    ),
  ),
));
$manager->setName('production');
$serviceContainer->setConnectionManager('production', $manager);
$serviceContainer->setDefaultDatasource('development');
