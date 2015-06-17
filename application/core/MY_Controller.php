<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();

      // CI base resources
      $this->load->database();
      $this->load->library(array('alerts', 'user_agent', 'email'));
      $this->load->helper(array('form', 'security', 'url', 'cookie', 'string'));

      // MY model base resources
      $this->load->model('crud/user_model');
      $this->load->model('crud/file_model');

      // try reautenticate user via token
      if( ! $this->session->userdata('user_id')) { $this->user_model->login_by_cookie(); }

      // global user data
      $this->user = $this->user_model->get_full_userdata();
    }

}