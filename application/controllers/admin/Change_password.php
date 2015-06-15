<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends Admin_Controller
{

  public function index()
  {
    $password        = $this->input->post('password');
    $repeat_password = $this->input->post('repeat_password');

    if($password && $repeat_password && $password == $repeat_password)
    {
      $user = $this->user_model->get($this->user->user_id);
      $user->password = do_hash($password);
      $this->user_model->update($user->user_id, $user);
      $this->alerts->add("Your password has changed", "info");
      redirect('admin');
    }
    elseif($this->input->post())
    {
      $this->alerts->add("Password not match", "error");
    }

    $this->load->view('themes/admin/change_password/index');
  }

}
