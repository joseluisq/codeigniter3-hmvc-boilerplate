<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model
 * 
 */
class User_model extends MY_Model {

  function find_all() {
    return array('users' => array(
        array('name' => 'joseluisq'),
        array('name' => 'daniel'),
        array('name' => 'lalo')
    ));
  }

}
