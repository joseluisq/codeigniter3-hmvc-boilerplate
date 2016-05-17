<?php

/**
 * Response
 * Abstraction class for request operations
 *
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class Response {

  private $_default_format = 'json';

  /**
   * JSON format response
   * @param mixed $data
   */
  function json($data) {
    $json = json_encode($data);

    if ($json === FALSE) {
      $json = json_encode(array('jsonError', json_last_error_msg()));

      if ($json === FALSE) {
        $json = '{"jsonError": "unknown"}';
      }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo $json;
  }

  /**
   * XML format response
   * @param mixed $data
   */
  function xml($data) {
    header('Content-Type: application/xml; charset=utf-8');
    echo $this->to_xml($data);
  }

  function to_xml($data, $basenode = 'response', $xml = null) {
    // turn off compatibility mode as simple xml throws a wobbly if you don't.
    if (ini_get('zend.ze1_compatibility_mode') == 1) {
      ini_set('zend.ze1_compatibility_mode', 0);
    }

    if ($xml == null) {
      $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
    }

    // loop through the data passed in.
    foreach ($data as $key => $value) {
      // no numeric keys in our xml please!
      if (is_numeric($key)) {
        // make string key...
        $key = "item_" . (string) $key;
      }

      // replace anything not alpha numeric
      $key = preg_replace('/[^a-z]/i', '', $key);

      // if there is another array found recrusively call this function
      if (is_array($value)) {
        $node = $xml->addChild($key);
        // recrusive call.
        $this->to_xml($value, $basenode, $node);
      } else {
        // add single node.
        $value = htmlentities($value);
        $xml->addChild($key, $value);
      }
    }
    // pass back as string. or simple xml object if you want!
    return $xml->asXML();
  }

  /**
   * Send data by default format
   * @param array $data
   */
  function send($data) {
    $this->{$this->_default_format}($data);
    exit;
  }

  /**
   * Set the default output format
   * @param string $format json, xml and html
   * @param string $format
   */
  function set_default_format($format) {
    $this->_default_format = $format;
  }

  /**
   * Get the default output format
   * @param string $format
   */
  function get_default_format() {
    return $this->_default_format;
  }

  function forbidden() {
    $this->status(403, 'HTTP/1.1 403 Forbidden');
  }

  function not_found() {
    $this->status(404, 'HTTP/1.1 404 Not Found');
  }

  function ok() {
    $this->status(200, 'HTTP/1.1 200 OK');
  }

  function bad_request() {
    $this->status(400, 'HTTP/1.1 400 Bad Request');
  }

  function method_not_allowed() {
    $this->status(405, 'HTTP/1.1 405 Method Not Allowed');
  }

  function service_unavailable() {
    $this->status(503, 'HTTP/1.1 503 Service Unavailable');
  }

  function internal_server_error() {
    $this->status(500, 'HTTP/1.1 500 Internal Server Error');
  }

  function unauthorized() {
    $this->status(401, 'HTTP/1.1 401 Unauthorized');
  }

  function request_timeout() {
    $this->status(408, 'HTTP/1.1 408 Request Timeout');
  }

  private function status($code, $msg = '') {
    header($msg, TRUE, $code);
  }

}
