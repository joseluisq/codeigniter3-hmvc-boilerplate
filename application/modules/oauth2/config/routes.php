<?php

/*
  | ----------------------------
  | OAuth2 Module
  | ----------------------------
  |
 */

// Client Credentials
$route['oauth2/login/access_token'] = 'OAuth2_api_controller/client_credential_post';
