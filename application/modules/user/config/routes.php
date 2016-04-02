<?php

/*
  | ----------------------------
  | URI ROUTING - User Module
  | ----------------------------
  |
  | Example:  $route['module_name'] = 'controller_name'
  |
 */

// Type: RESTful
$route['user'] = 'User_controller/index_get';

// Type: RESTful + API
$route['user/([0-9]+)'] = 'User_api_controller/user_get/$1';
