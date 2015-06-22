<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    if( ! $this->user)
    {
      $this->alerts->add('Login non effettuato', 'error');
      redirect('/login');
    }

    if( ! $this->user_model->has_permission_by_uri())
    {
      $this->alerts->add("You have not right to see '/".uri_string()."'", 'error');
      redirect('/');
    }
  }

}
