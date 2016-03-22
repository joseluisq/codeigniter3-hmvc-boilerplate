<?php

/**
 * RESTfull
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
    'xml' => 'text/xml'
  );

  function __construct($params) {
    $this->load = $params['load'];
    $this->input = $params['input'];
    $this->router = $params['router'];
    $this->request = $params['request'];
    $this->response = $params['response'];

    $this->validate_request();
  }

  private function validate_request() {
    $method = $this->validate_route_method();

    if ($method) {
      $format = $this->content_type_format();

      if (!$format) {
        $format = 'json';
        $uri_format = $this->content_type_query_format();

        if ($uri_format) {
          $format = $uri_format;
        }
      }

      $this->response->set_default_format($format);

      if ($this->request->method() !== $method) {
        $this->response->method_not_allowed();
        $this->response->output(array(
          'message' => 'Method Not Allowed'
        ));;
      }
    }
  }

  function content_type_query_format() {
    $format = NULL;
    $uri_format = trim($this->request->get('format'));
    $query_format = filter_var($uri_format, FILTER_SANITIZE_STRING);

    if (!empty($query_format) && array_key_exists($query_format, $this->_supported_formats)) {
      $format = $query_format;
    }

    return $format;
  }

  function validate_route_method() {
    $match = array();
    $method = $this->router->fetch_method();
    $request_method = NULL;

    preg_match('/(.+)\_(get|post|put|delete)$/', $method, $match);

    if (!empty($match)) {
      $request_method = $match[2];
    }

    return $request_method;
  }

  private function content_type_format() {
    $content_type = $this->input->server('CONTENT_TYPE');

    foreach ($this->_supported_formats as $key => $value) {
      $content_type = (strpos($content_type, ';') !== FALSE ? current(explode(';', $content_type)) : $content_type);

      if ($content_type === $value) {
        return $key;
      }
    }

    return NULL;
  }

}
