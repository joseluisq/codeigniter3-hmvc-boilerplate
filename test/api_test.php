<?php

require '../application/libraries/MyAPI.php';

$api = MyAPI::create(array(
    'base_url' => 'http://localhost:8001',
    'api_key' => '7ded2bfab2c85907b0e788412bebc6b224c46c7c',
    'data_type' => 'json'
  ));

$json = $api::get('/user/1');
$data = json_decode($json, TRUE);
print_r($data);
