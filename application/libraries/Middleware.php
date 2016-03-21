<?php

/**
 * Middleware
 * A smallest Middleware class.
 *
 * @property  Request $request Request
 * @property  Response $response Response
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class Middleware {

  protected $load;

  function __construct($params) {
    $this->load = $params['load'];
    $this->request = $params['request'];
    $this->response = $params['response'];

//    Authentication stuff
//    $this->authentication();
  }

  function authentication() {
    $this->load->library('Authenticate');

    $authenticate = new Authenticate($this->request, $this->response);
    $authenticate->guard();
  }

}
