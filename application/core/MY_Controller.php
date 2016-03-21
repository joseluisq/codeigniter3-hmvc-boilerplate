<?php

/**
 * MY_Controller
 * A smallest abstraction class for CI Controller.
 * @property  Middleware $middleware Middleware
 * @property  Request $request Request
 * @property  Response $response Response
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class MY_Controller extends CI_Controller {

  public $request;
  public $response;

  public function __construct() {
    parent::__construct();

    $load = $this->load;

    $this->load->library('Response', $load);
    $this->load->library('Request', array(
      'load' => $load,
      'input' => $this->input
    ));

    $this->load->library('Middleware', array(
      'load' => $load,
      'request' => $this->request,
      'response' => $this->response
    ));
  }

}
