<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property User_model $User_model User_model class
 */
class User_api_controller extends MY_Controller {

  public $User_model;

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
  function user_get($id) {
    $this->load->model('User_model');

    $user = $this->User_model->find_one_by_id($id);
    
    $this->response->output($user);
  }

}
