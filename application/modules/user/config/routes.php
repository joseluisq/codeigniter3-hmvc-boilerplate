<?php

/*
  | ----------------------------
  | URI ROUTING - User Module
  | ----------------------------
  |
  | Example:  $route['module_name'] = 'controller_name'
  |
 */

// Type 1: RESTful only
$route['user/all'] = 'User_controller/index_get';

// Type: 2 RESTful + API + OAuth2
$route['user'] = 'User_api_controller/all_get';
$route['user/([0-9]+)'] = 'User_api_controller/one_get/$1';
