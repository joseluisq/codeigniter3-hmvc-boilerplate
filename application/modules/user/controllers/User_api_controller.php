<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property User_model $User_model User_model class
 */
class User_api_controller extends MY_Controller {

  public $User_model;

  public function __construct() {
    parent::__construct();

    $this->load->model('User_model');
  }

  /**
   * Get one specific user by id.
   * GET /v1/user/[:id]
   * @param int $id
   */
  function one_get($id) {
    $user = $this->User_model->find_one_by_id($id);
    $this->response->send($user);
  }

  /**
   * Get all users.
   * GET /v1/user
   */
  function all_get() {
    $users = $this->User_model->find_all();
    $this->response->send($users);
  }

}
