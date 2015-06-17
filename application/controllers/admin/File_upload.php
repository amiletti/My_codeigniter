<?php defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload extends Admin_Controller
{

  public function index()
  {
    $data['files'] = $this->file_model->do_upload();
    $this->load->view('themes/admin/file_upload/index', $data);
  }

}
