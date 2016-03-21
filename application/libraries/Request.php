<?php

/**
 * Request
 * Abstraction class for request operations
 *
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class Request {

  protected $load;
  protected $input;

  public function __construct($params) {
    $this->load = $params['load'];
    $this->input = $params['input'];
  }

  /**
   * Returns GET data
   * @param string $key
   * @return mixed
   */
  function get($key = NULL) {
    return $this->request_data('get', $key);
  }

  /**
   * Returns POST data
   * @param string $key
   * @return mixed
   */
  function post($key = NULL) {
    return $this->request_data('post', $key);
  }

  /**
   * Returns PUT data
   * @param string $key
   * @return mixed
   */
  function put($key = NULL) {
    return $this->request_data('put', $key);
  }

  /**
   * Returns DELETE data
   * @param string $key
   * @return mixed
   */
  function delete($key = NULL) {
    return $this->request_data('delete', $key);
  }

  /**
   * If GET request
   * @return bool
   */
  function is_get() {
    return ($this->method() === 'get');
  }

  /**
   * If POST request
   * @return bool
   */
  function is_post() {
    return ($this->method() === 'post');
  }

  /**
   * If PUT request
   * @return bool
   */
  function is_put() {
    return ($this->method() === 'put');
  }

  /**
   * If DELETE request
   * @return bool
   */
  function is_delete() {
    return ($this->method() === 'delete');
  }

  /**
   * Get HTTP data by specific methods
   * @param string $method GET, POST, PUT and DELETE 
   * @param mixed $key
   * @return mixed
   */
  private function request_data($method, $key = NULL) {
    $values = NULL;

    switch ($method) {
      case 'get':
        if ($this->is_get()) {
          $values = $this->input->get($key);
        }

        break;
      case 'post':
        if ($this->is_post()) {
          $values = $this->input->post($key);
        }

        break;
      case 'put':
        if ($this->is_put()) {
          $values = $this->raw_request_data();
          break;
        }

        break;
      case 'delete':
        if ($this->is_delete()) {
          $values = $this->raw_request_data($key);
        }

        break;
    }

    return $values;
  }

  /**
   * Get raw request data
   * @param mixed $key
   * @return mixed
   */
  private function raw_request_data($key) {
    $values = $this->parse_raw_http_request($key);

    if ($key) {
      $values = isset($values[$key]) ? $values[$key] : NULL;
    }

    return $values;
  }

  /**
   * Parse raw HTTP request data
   * http://www.chlab.ch/blog/archives/php/manually-parse-raw-http-data-php
   *
   * Pass in $a_data as an array. This is done by reference to avoid copying
   * the data around too much.
   *
   * Any files found in the request will be added by their field name to the
   * $data['files'] array.
   *
   * @param   array  Empty array to fill with data
   * @return  array  Associative array of request data
   */
  function parse_raw_http_request() {
    $a_data = array();
    // read incoming data
    $input = file_get_contents('php://input');

    $matches = array();
    // grab multipart boundary from content type header
    preg_match('/boundary=(.*)$/', $this->input->server('CONTENT_TYPE'), $matches);

    // content type is probably regular form-encoded
    if (!count($matches)) {
      // we expect regular puts to containt a query string containing data
      parse_str(urldecode($input), $a_data);
      return $a_data;
    }

    $boundary = $matches[1];

    // split content by boundary and get rid of last -- element
    $a_blocks = preg_split("/-+$boundary/", $input);
    array_pop($a_blocks);

    // loop data blocks
    foreach ($a_blocks as $block) {
      if (empty($block)) {
        continue;
      }

      // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char
      // parse uploaded files
      if (strpos($block, 'application/octet-stream') !== FALSE) {
        // match "name", then everything after "stream" (optional) except for prepending newlines
        preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
        $a_data['files'][$matches[1]] = $matches[2];
      }
      // parse all other fields
      else {
        if (strpos($block, 'filename') !== FALSE) {
          $mime = array();
          // match "name" and optional value in between newline sequences
          preg_match('/name=\"([^\"]*)\"; filename=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
          preg_match('/Content-Type: (.*)?/', $matches[3], $mime);

          // match the mime type supplied from the browser
          $image = preg_replace('/Content-Type: (.*)[^\n\r]/', '', $matches[3]);

          // get current system path and create tempory file name & path
          $path = sys_get_temp_dir() . '/php' . substr(sha1(rand()), 0, 6);

          // write temporary file to emulate $_FILES super global
          $err = file_put_contents($path, $image);

          $tmp = array();
          // Did the user use the infamous &lt;input name="array[]" for multiple file uploads?
          if (preg_match('/^(.*)\[\]$/i', $matches[1], $tmp)) {
            $a_data[$tmp[1]]['name'][] = $matches[2];
          } else {
            $a_data[$matches[1]]['name'][] = $matches[2];
          }

          // Create the remainder of the $_FILES super global
          $a_data[$tmp[1]]['type'][] = $mime[1];
          $a_data[$tmp[1]]['tmp_name'][] = $path;
          $a_data[$tmp[1]]['error'][] = ($err === FALSE) ? $err : 0;
          $a_data[$tmp[1]]['size'][] = filesize($path);
        } else {
          // match "name" and optional value in between newline sequences
          preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);

          if (preg_match('/^(.*)\[\]$/i', $matches[1], $tmp)) {
            $a_data[$tmp[1]][] = $matches[2];
          } else {
            $a_data[$matches[1]] = $matches[2];
          }
        }
      }
    }

    return $a_data;
  }

  /**
   * Get REQUEST_METHOD like GET, PUT, POST, DELETE, PATCH, etc.
   * @return string
   */
  function method() {
    return strtolower($this->input->server('REQUEST_METHOD'));
  }

}
