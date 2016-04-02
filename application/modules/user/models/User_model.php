<?php

use Propel\Runtime\Exception\PropelException;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model
 * 
 */
class User_model {

  /**
   * Find all users
   * @return array
   */
  function find_all() {
    try {
      return UserQuery::create()->find()->toArray();
    } catch (PropelException $e) {
      return;
    }
  }

  /**
   * Find one user by primary key
   * @return array
   */
  function find_one_by_id($id) {
    try {
      return UserQuery::create()->findPk($id)->toArray();
    } catch (PropelException $e) {
      return;
    }
  }

}
