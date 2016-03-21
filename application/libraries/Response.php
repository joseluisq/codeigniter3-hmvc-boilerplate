<?php

/**
 * Response
 * Abstraction class for request operations
 *
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class Response {

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

    header('Content-Type: application/json');
    echo $json;
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
