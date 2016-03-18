<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL: http://example.com/index.php/user
   *
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/user/<method_name>
   * 
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index() {
    $this->load->model('User_model');

    $users = $this->User_model->find_all();

    $this->parser->parse('User_view', array(
      'users' => $users
    ));
  }

}
