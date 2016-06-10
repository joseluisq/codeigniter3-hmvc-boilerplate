<?php

/**
 * MyAPI
 * 
 * Lite API handler for custom API interactions
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class MyAPI {

  private static $_instance = NULL;
  private static $_supported_formats = array(
    'json' => 'application/json',
    'xml' => 'application/xml'
  );
  private static $_options = array(
    'base_url' => '',
    'api_key' => '',
    'data_type' => 'json',
    'header' => array()
  );
  private static $_CURL_OPTS = array(
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_USERAGENT => 'myapi-php-1.0',
  );

  /**
   * Create API handler
   * @param array $options
   * 
   * Supported values:
   * 
   *    array(
   *      'base_url' => '',
   *      'api_key' => '',
   *      'data_type' => 'json',
   *      'header' => array()
   *    )
   * 
   * @return MyAPI MyAPI instance
   */
  static function create($options = array()) {
    $opts = array_merge(self::$_options, $options);

    $header = $opts['header'];
    $header['api-key'] = $opts['api_key'];

    $headers = array();

    foreach ($header as $key => $value) {
      $headers[] = "$key: $value";
    }

    $opts['header'] = $headers;

    self::$_options = $opts;

    if (static::$_instance === NULL) {
      static::$_instance = new static();
    }

    return static::$_instance;
  }

  /**
   * Makes an HTTP request. This method can be overridden by subclasses if
   * developers want to do fancier things or use something other than curl to
   * make the request.
   *
   * @param string $url The URL to make the request to
   * @param array $params The parameters to use for the POST body
   * @param string $method Request method: GET, POST, PUT, DELETE, etc
   * @param CurlHandler $ch Initialized curl handle
   *
   * @return string The response text
   */
  static function create_request($url, $params, $method = 'GET', $ch = NULL) {
    if (!$ch) {
      $ch = curl_init();
    }

    $opts = self::$_CURL_OPTS;
    $header = self::$_options['header'];
    $base_url = self::$_options['base_url'];
    $data_type = self::$_options['data_type'];
    $accept_types = self::$_supported_formats;
    $url = $base_url . $url;

    $header[] = 'Accept: ' . $accept_types[$data_type];

    $opts[CURLOPT_HTTPHEADER] = $header;
    $opts[CURLOPT_CUSTOMREQUEST] = strtoupper($method);

    if ($method === 'GET') {
      $url .= (empty($params) ? '' : '?' . http_build_query($params));
    } else {
      $opts[CURLOPT_POSTFIELDS] = $params;
    }

    $opts[CURLOPT_URL] = $url;

    curl_setopt_array($ch, $opts);

    $result = curl_exec($ch);

    if ($result === FALSE && empty($opts[CURLOPT_IPRESOLVE])) {
      $matches = array();
      $regex = '/Failed to connect to ([^:].*): Network is unreachable/';

      if (preg_match($regex, curl_error($ch), $matches)) {
        if (strlen(@inet_pton($matches[1])) === 16) {
          custom_error_log('Invalid IPv6 configuration on server, ' .
            'Please disable or get native IPv6 on your server.');
          self::$_CURL_OPTS[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
          curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
          $result = curl_exec($ch);
        }
      }
    }

    if ($result === FALSE) {
      $err = new \Exception(implode("\n", array(
          'error_code' => curl_errno($ch),
          'message' => curl_error($ch)
      )));

      curl_close($ch);

      throw $err;
    }

    curl_close($ch);

    if ($data_type === 'json') {
      $result = json_decode($result, TRUE);
    }

    if ($data_type === 'xml') {
      $result = json_decode(json_encode(simplexml_load_string($result)), TRUE);
    }

    return $result;
  }

  /**
   * Log data
   * @param mixed $msg
   */
  function custom_error_log($msg) {
    if (php_sapi_name() != 'cli') {
      error_log($msg);
    }
  }

  /**
   * GET request
   * @param string $url
   * @param array $params
   * @return mixed Response data
   */
  public static function get($url, $params = array(), $cn = NULL) {
    return self::create_request($url, $params, 'GET', $cn);
  }

  /**
   * POST request
   * @param string $url
   * @param array $params
   * @return mixed Response data
   */
  public static function post($url, $params = array(), $cn = NULL) {
    return self::create_request($url, $params, 'POST', $cn);
  }

  /**
   * PUT request
   * @param string $url
   * @param array $params
   * @return mixed Response data
   */
  public static function put($url, $params = array(), $cn = NULL) {
    return self::create_request($url, $params, 'PUT', $cn);
  }

  /**
   * DELETE request
   * @param string $url
   * @param array $params
   * @return mixed Response data
   */
  public static function delete($url, $params = array(), $cn = NULL) {
    return self::create_request($url, $params, 'DELETE', $cn);
  }

}
