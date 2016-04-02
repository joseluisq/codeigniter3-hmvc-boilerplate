<?php

/**
 * RESTfull
 * Lite class for RESTful interactions
 * 
 * @property Request $request Request
 * @property Response $response Response
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class RESTful {

  protected $request;
  protected $response;
  private $_supported_formats = array(
    'json' => 'application/json',
    'xml' => 'application/xml'
  );

  function __construct($params) {
    $this->load = $params['load'];
    $this->input = $params['input'];
    $this->router = $params['router'];
    $this->request = $params['request'];
    $this->response = $params['response'];

    $this->process_restful_request();
  }

  /**
   * Process incoming RESTful request
   */
  private function process_restful_request() {
    $method = $this->validate_restful_method();

    if ($method) {
      $format = $this->get_content_type_format();

      if (!$format) {
        $format = 'json';
        $uri_format = $this->get_content_type_query_format();

        if ($uri_format) {
          $format = $uri_format;
        }
      }

      $this->response->set_default_format($format);

      $this->process_api_request();

      if ($this->request->method() !== $method) {
        $this->response->method_not_allowed();
        $this->response->output(array(
          'message' => 'Method not allowed.'
        ));
      }
    }
  }

  /**
   * Process incoming API request
   */
  private function process_api_request() {
    if ($this->validate_api_class()) {
      if (!defined('RESTFUL_API_KEY')) {
        $this->response->unauthorized();
        $this->response->output(array(
          'message' => 'API key is not exists.'
        ));
      }

      if (!$this->is_valid_api_key()) {
        $this->response->unauthorized();
        $this->response->output(array(
          'message' => 'API key is not valid.'
        ));
      }
    }
  }

  /**
   * Checks if API-KEY is valid
   * @return bool
   */
  private function is_valid_api_key() {
    $api_key = $this->input->server('HTTP_API_KEY');
    return ($api_key === RESTFUL_API_KEY);
  }

  /**
   * Validate if incoming function is a valid RESTful method.
   * @return string | NULL
   */
  function validate_restful_method() {
    $match = array();
    $method = $this->router->fetch_method();
    $request_method = NULL;

    preg_match('/(.+)\_(get|post|put|delete)$/', $method, $match);

    if (!empty($match)) {
      $request_method = $match[2];
    }

    return $request_method;
  }

  /**
   * Validate if incoming controller is a valid API Controller.
   * @return string | NULL
   */
  function validate_api_class() {
    $match = array();
    $class = $this->router->fetch_class();
    $request_method = NULL;

    preg_match('/(.+)\_(api\_controller)$/', $class, $match);

    if (!empty($match)) {
      $request_method = $match[2];
    }

    return $request_method;
  }

  /**
   * Get the format value in query string.
   * @return string | NULL
   */
  function get_content_type_query_format() {
    $format = NULL;
    $uri_format = trim($this->request->get('format'));
    $query_format = filter_var($uri_format, FILTER_SANITIZE_STRING);

    if (!empty($query_format) && array_key_exists($query_format, $this->_supported_formats)) {
      $format = $query_format;
    }

    return $format;
  }

  /**
   * Get incoming Content-Type value in header.
   * @return string | NULL
   */
  private function get_content_type_format() {
    $content_type = $this->input->server('HTTP_ACCEPT');

    foreach ($this->_supported_formats as $key => $value) {
      if (strpos($content_type, ';') !== FALSE) {
        $content_type = current(explode(';', $content_type));
      }

      if ($content_type === $value) {
        return $key;
      }
    }

    return NULL;
  }

}
