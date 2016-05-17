<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * OAuth2 Controller
 * @property  MyOAuth2 $oauth MyOAuth2
 */
class OAuth2_api_controller extends MY_Controller {

  public $oauth;

  /**
   * POST /v1/login/oauth
   * Client credentials
   */
  function client_credential_post() {
    $format = $this->response->get_default_format();
    $this->oauth->client_credentials($format);
  }

}
