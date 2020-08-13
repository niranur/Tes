<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class EmployeModel extends CI_Model {

 public function __construct()
  {
    $this->table = 'employee';

    parent::__construct();
  }


  public function input_data($data)
  {
    $this->db->insert($this->table, $data);
  }

    
}
?>