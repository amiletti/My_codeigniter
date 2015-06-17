<?php

class File_model extends MY_Model {

  public $_table      = 'files';
  public $primary_key = 'file_id';

  public $before_create = array('created_at', 'created_by');
  public $after_get     = array('set_full_path');
  public $before_delete = array('delete_file');

  public $upload_dir = 'assets/files/uploads';

  function created_by($row)
  {
    $user_id = ($this->user) ? $this->user->user_id : NULL;
    if(is_object($row)) { $row->created_by = $user_id; } else { $row['created_by'] = $user_id; }
    return $row;
  }

  function set_full_path($row)
  {
    if(is_object($row))
    {
      $row->full_path = $row->path.$row->name;
    }
    else
    {
      $row['full_path'] = $row['path'].$row['name'];
    }
    
    return $row;
  }

  function delete_file($file_id)
  {
    $file = $this->get($file_id);
    if(file_exists('./'.$file->full_path)) { unlink('./'.$file->full_path); }
    return $file_id;
  }

  function do_upload($name = 'file', $allowed_types = 'gif|jpg|png', $max_size = 2048)
  {
    if( ! isset($_FILES[$name])) { return FALSE; }

    if(is_array($_FILES[$name]['name']))
    {
      $data = $_FILES[$name];
      $files = array();
      foreach($data as $k => $v) { foreach($v as $k2 => $v2) { $files[$k2][$k] = $v2; } }

      $ret = array();
      foreach($files as $k => $v)
      {
        $_FILES[$name] = $v;
        $ret[] = $this->upload($name, $allowed_types, $max_size);
      }

      return $ret;
    }
    else
    {
      return $this->upload($name, $allowed_types, $max_size);
    }

    return FALSE;
  }

  function upload($name, $allowed_types, $max_size)
  {
    if( ! isset($_FILES[$name]) || (isset($_FILES[$name]) && $_FILES[$name]['error'] != 0)) { return FALSE; }
    $file = $_FILES[$name];

    $upload_dir = $this->upload_dir.date('/Y/m/d/');
    if( ! is_dir('./'.$upload_dir)) { mkdir('./'.$upload_dir, 0755, TRUE); }

    $filename = preg_replace('/[^\da-z]/i', '_', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));

    $config['upload_path']      = './'.$upload_dir;
    $config['allowed_types']    = $allowed_types;
    $config['max_size']         = $max_size;
    $config['file_name']        = $filename;
    $config['file_ext_tolower'] = TRUE;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if( ! $this->upload->do_upload($name))
    {
      $this->alerts->add($this->upload->display_errors(FALSE, FALSE), "error");
      return FALSE;
    }
    else
    {
      $detail = $this->upload->data();
      $data = array(
        'size' => $file['size'],
        'name' => $detail['file_name'],
        'path' => $upload_dir,
        'type' => $detail['file_type']
      );
      
      return $this->insert($data);
    }
    return FALSE;
  }

}