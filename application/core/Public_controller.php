<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_controller extends MY_Controller
{

    public function __construct()
    {
      parent::__construct();

      define('THEME', 'public');
    }

}