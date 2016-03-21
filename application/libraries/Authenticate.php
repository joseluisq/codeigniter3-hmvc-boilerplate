<?php

/**
 * Authenticate
 * 
 * @property Request $request Request
 * @property Response $response Response
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class Authenticate {

  protected $request;
  protected $response;

  function __construct($request, $response) {
    $this->request = $request;
    $this->response = $response;
  }

  function guard() {
//    Authentication stuff goes here
  }

}
