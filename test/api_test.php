<?php

require '../application/libraries/MyAPI.php';

$api = MyAPI::create(array(
  'base_url' => 'http://localhost:8001/api/v1',
  'api_key' => '120bc909efd51088ae509b2b099688a9f05324c0',
  'data_type' => 'json'
));

$data = $api::get('/user/all');

print_r( json_decode($data, TRUE) );
