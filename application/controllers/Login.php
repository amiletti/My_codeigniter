<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller
{

  public function index($token = FALSE)
  {
    if($this->user)
    {
      $this->alerts->add("You are currently logged in", 'info');
      redirect("/");
    }

    if($this->input->post())
    {
      $email    = $this->input->post('email');
      $password = $this->input->post('password');
      $remember = $this->input->post('remember');
      if($this->user_model->login($email, $password, $remember))
      {
        redirect("/admin");
      }
    }

    if($token)
    {
      if($this->user_model->login_by_token($token))
      {
        redirect("/change_password");
      }
      $this->alerts->add("Invalid token", "info");
    }
    
    $this->load->view('themes/public/login/index');
  }

  public function recover_password()
  {
    if($email = $this->input->post('email'))
    {
      if($this->user_model->change_password($email))
      {
        $this->alerts->add("We had sent you an email with a link to change your password", 'info');
        redirect('/');
      }
    }

    $this->load->view('themes/public/login/recover_password');
  }

}
