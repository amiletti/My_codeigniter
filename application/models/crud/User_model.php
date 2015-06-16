<?php

class User_model extends MY_Model {

  public $_table      = 'users';
  public $primary_key = 'user_id';

  public $before_create = array('created_at');
  public $before_update = array('updated_at');

  function has_permission_by_uri($user_id = FALSE, $uri = FALSE)
  {
    if( ! $this->user) { return FALSE; }

    if( ! $user_id) { $user_id = $this->user->user_id; }
    if( ! $uri) { $uri = uri_string(); }

    foreach($this->user->permissions as $k => $v)
    {
      if(preg_match("/^".$v."$/", $uri)) { return TRUE; }
    }
    return FALSE;
  }

  function login_by_cookie()
  {
    $token = get_cookie('token');
    if($token && strlen($token)) { $this->login_by_token($token); }
    return;
  }

  function login_by_token($token)
  {
    $user = $this->get_by('token', $token);
    if($user)
    {
      $data = array(
        'user_id' => $user->user_id, 
        'logged_at' => $user->logged_at
      );
      $this->session->set_userdata($data);

      $user->token = '';
      $user->logged_at = date('Y-m-d H:i:s');
      $this->update($user->user_id, $user);
      return TRUE;
    }
    return FALSE;
  }

  function get_full_userdata($user_id = FALSE)
  {
    if( ! $user_id) { $user_id = $this->session->userdata('user_id'); }

    $user = ($user_id) ? $this->get($user_id) : FALSE;

    if($user)
    {
      $q = "SELECT r.* FROM users_x_roles ur JOIN roles r USING(role_id) WHERE ur.user_id = ?";
      $roles = $this->db->query($q, array($user->user_id))->result();
      
      foreach($roles as $k => $v)
      {
        $user->roles[$v->role_id] = $v->name;
        $permissions = json_decode($v->permissions);
        foreach($permissions as $k2 => $v2)
        {
          $user->permissions[] = str_replace(array(':any', ':num', '/'), array('[^/]+', '[0-9]+', '\/'), $v2);
        }
      }
    }

    return $user;
  }

  function login($email, $password, $remember)
  {
    $user = $this->get_by('email', $email);
    if( ! $user) {$user =  $this->get_by('username', $email); }

    if( ! $user)
    {
      $this->alerts->add("User {$email} not found", "error");
      return FALSE;
    }

    if($user->status != 1)
    {
      $this->alerts->add("User {$username} is currently disabled", "error");
      return FALSE;
    }

    if( ! $user->password || $user->password != do_hash($password))
    {
      $this->alerts->add("Wrong password", "error");
      return FALSE;
    }
    
    $this->session->set_userdata(array('logged_at' => $user->logged_at));
    $user->logged_at = date('Y-m-d H:i:s');
    if($remember)
    {
      $user->token = random_string('alnum', 255);
      $cookie = array(
        'name'   => 'token',
        'value'  => $user->token,
        'expire' => '62000000' // two years
      );
      set_cookie($cookie);
    }

    $this->update($user->user_id, $user);
    $this->session->set_userdata(array('user_id' => $user->user_id));
    
    return TRUE;
  }

  // logout
  function logout()
  {
    if($this->user)
    {
      $user = $this->get($this->user->user_id);
      $user->token = '';
      $this->update($user->user_id, $user);
      delete_cookie('token');
    }

    $this->session->sess_destroy();
    return TRUE;
  }

  // generate a temporary password and send it via mail
  function change_password($email)
  {
    $user = $this->get_by('email', $email);

    if( ! $user)
    {
      $this->alerts->add("Email {$email} not found", "error");
      return FALSE;
    }

    if($user->status != 1)
    {
      $this->alerts->add("User {$username} is currently disabled", "error");
      return FALSE;
    }

    $user->token = random_string('alnum', 99);
    $this->update($user->user_id, $user);

    $link = site_url('/login/'.$user->token);
    $this->email->from(EMAIL_FROM_EMAIL, EMAIL_FROM_NAME);
    $this->email->to($email);
    $this->email->subject("Edit password request");
    $this->email->message("Hi ".$email.".\r\n\r\nTo change your password click on the link above\r\n\r\n".$link."\r\n\r\nIn this way you can change your password with new one\r\n\r\n".EMAIL_FROM_NAME);

    if( ! $this->email->send())
    {
      $this->alerts->add("An error occured when I try to send mail to {$email}", "error");
      return FALSE;
    }

    return TRUE;
  }
  
}