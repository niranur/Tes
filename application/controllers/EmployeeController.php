<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {
	function __construct() {
		parent::__construct();
    $this->load->model('EmployeModel');
    date_default_timezone_set("Asia/Jakarta"); 
     $this->dateToday = date("Y-m-d H:i:s");


        
    }
    
    public function index(){

    $data['title']    = "TES";
   // $data['lokasi']   = $this->HomeModel->lokasi(); 
    $data['sidebar']  = $this->load->view("Sidebar", $data, true);
    $data['content']  = $this->load->view("employee", $data, true);
    $this->load->view("UserTemplate", $data); 
  }


}


  




     
  

