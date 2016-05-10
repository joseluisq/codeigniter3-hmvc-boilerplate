<?php

/**
 * MY_Controller
 * A smallest abstraction class for CI Controller.
 * @property  Middleware $middleware Middleware
 * @property  Request $request Request
 * @property  Response $response Response
 * @property  RESTful $restful RESTful
 * @property  MyOAuth2 $oauth MyOAuth2
 * 
 * @version   1.0.0
 * @author    José Luis Quintana <http://git.io/joseluisq>
 */
class MY_Controller extends CI_Controller {

  public $request;
  public $response;
  public $restful;
  public $oauth;

  public function __construct() {
    parent::__construct();

    $load = $this->load;
    $input = $this->input;

    $this->load->library('Response', $load);
    $this->load->library('Request', array(
      'load' => $load,
      'input' => $input
    ));

    $request = $this->request;
    $response = $this->response;

    $this->load->library('Middleware', array(
      'load' => $load,
      'request' => $request,
      'response' => $response
    ));

    $this->load->library('RESTful', array(
      'load' => $load,
      'input' => $input,
      'request' => $request,
      'response' => $response,
      'router' => $this->router
      ), 'restful');

    $this->oauth = $this->restful->get_oauth();
  }

}
