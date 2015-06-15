<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Public_Controller
{

  public function index()
  {
    $this->user_model->logout();
    redirect('/');
  }

}
