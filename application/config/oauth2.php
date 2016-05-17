<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | OAuth2 Settings
  |--------------------------------------------------------------------------
  |
 */

/**
 * Storage PDO settings
 */
$config['storage'] = array(
  'dsn' => 'mysql:dbname=dboauth;host=localhost',
  'username' => 'root',
  'password' => 'root'
);

/**
 * Ignore OAuth2 authorization request.
 *
 * Example:
 *  Class_api_controller/method_post
 */
$config['ignore'] = array(
  'OAuth2_api_controller/client_credential_post'
);
