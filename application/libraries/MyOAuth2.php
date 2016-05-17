<?php

/**
 * Extended class for OAuth2
 * Inpirated on https://github.com/grasses/codeigniter-oauth2-server
 *
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class MyOAuth2 {

  /**
   * Create authentication server
   * @param array $config
   */
  function __construct($config) {
    if (!class_exists('OAuth2\Autoloader')) {
      require_once APP_VENDOR . DS . 'bshaffer/oauth2-server-php/src/OAuth2/Autoloader.php';
      OAuth2\Autoloader::register();
    }

    if (empty($config)) {
      die('OAuth2 Storage settings is not defined');
    }

    $this->storage = new OAuth2\Storage\Pdo(array(
      'dsn' => $config['dsn'],
      'username' => $config['username'],
      'password' => $config['password']
    ));
    $this->server = new OAuth2\Server($this->storage, array('allow_implicit' => TRUE));
    $this->request = OAuth2\Request::createFromGlobals();
    $this->response = new OAuth2\Response();
  }

  /**
   * Return OAuth2\Server
   * @return OAuth2\Server
   */
  function server() {
    return $this->server;
  }

  /**
   * Authentication for resources
   * http://bshaffer.github.io/oauth2-server-php-docs/controllers/resource/
   *
   * @param string $format Data format
   */
  function authentication_resource($format) {
    if (!$this->server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
      $response = $this->server->getResponse();
      $response->setParameters(array(
        'message' => 'Requires authentication'
      ));
      $response->send($format);
      exit;
    }
  }

  /**
   * The client uses their credentials to retrieve an access token directly,
   * which allows access to resources under the client’s control.
   * http://bshaffer.github.io/oauth2-server-php-docs/grant-types/client-credentials/
   */
  public function client_credentials() {
    $this->request->request['grant_type'] = 'client_credentials';
    $this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($this->storage, array(
      'allow_credentials_in_request_body' => FALSE
    )));
    $this->server->handleTokenRequest($this->request)->send();
  }

  /**
   * A Resource Owner’s username and password are submitted as part of
   * the request, and a token is issued upon successful authentication.
   * http://bshaffer.github.io/oauth2-server-php-docs/grant-types/user-credentials/
   */
  public function password_credentials() {
    $users = array('user' => array('password' => '1234', 'first_name' => 'John', 'last_name' => 'Doe'));
    $storage = new OAuth2\Storage\Memory(array('user_credentials' => $users));
    $this->server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
    $this->server->handleTokenRequest($this->request)->send();
  }

  /**
   * The client can submit a refresh token and recieve
   * a new access token if the access token had expired.
   * http://bshaffer.github.io/oauth2-server-php-docs/grant-types/refresh-token/
   */
  public function refresh_token() {
    $this->server->addGrantType(new \OAuth2\GrantType\RefreshToken($this->storage, array(
      'always_issue_new_refresh_token' => TRUE,
      'unset_refresh_token_after_use' => TRUE,
      'refresh_token_lifetime' => 2419200,
    )));
    $this->server->handleTokenRequest($this->request)->send();
  }

  /**
   * Limit scpoe here
   * @param $scope = "node file userinfo"
   */
  public function require_scope($scope = '') {
    if (!$this->server->verifyResourceRequest($this->request, $this->response, $scope)) {
      $this->server->getResponse()->send();
      exit;
    }
  }

  public function check_client_id() {
    if (!$this->server->validateAuthorizeRequest($this->request, $this->response)) {
      $this->response->send();
      exit;
    }
  }

  public function authorize($is_authorized) {
    $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($this->storage));
    $this->server->handleAuthorizeRequest($this->request, $this->response, $is_authorized);
    if ($is_authorized) {
      $code = substr($this->response->getHttpHeader('Location'), strpos($this->response->getHttpHeader('Location'), 'code=') + 5, 40);
      header("Location: " . $this->response->getHttpHeader('Location'));
    }
    $this->response->send();
  }

  public function authorization_code() {
    $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($this->storage));
    $this->server->handleTokenRequest($this->request)->send();
  }

}
