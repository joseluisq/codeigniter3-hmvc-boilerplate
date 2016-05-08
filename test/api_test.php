<?php

require '../application/libraries/MyAPI.php';

$api = MyAPI::create(array(
    'base_url' => 'http://localhost:8001',
    'api_key' => '32563b81ec7288ef87bbe39c3b7001a7bff35395eec1eac906a580e6a12d189e',
    'data_type' => 'json'
  ));

$json = $api::get('/user/1');
$data = json_decode($json, TRUE);
print_r($data);
