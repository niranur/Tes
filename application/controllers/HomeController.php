<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
	function __construct() {
		parent::__construct();
    $this->load->model('HomeModel');
    date_default_timezone_set("Asia/Jakarta"); 
     $this->dateToday = date("Y-m-d H:i:s");


        
    }

    public function index(){

    $data['title']    = "TES";
    $data['lokasi']   = $this->HomeModel->lokasi(); 
    $data['sidebar']  = $this->load->view("Sidebar", $data, true);
    $data['content']  = $this->load->view("lokasi", $data, true);
    $this->load->view("UserTemplate", $data); 
  }


   public function tambah_data()
    {
        $data['title']        = "Tambah data ";
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("tambah_lokasi", $data, true);
         $this->load->view("UserTemplate", $data); 
   }

 public function simpan()
    {
      
       $code  = $this->input->post('code');
       $name = $this->input->post('name');
          
          $data = array(
            'code' => $code,
            'name'=> $name
        );
        // //print_r($data);
          $this-> session->set_flashdata('sukses', "Data Berhasil Ditambahkan");
          $this->HomeModel->input_data($data);
          redirect('');
          }

      }


  function update_data($id)
    {
                $data['title']        = "Update data ";
                $data['update_lokasi']  = $this->HomeModel->spesifik_data($id);
                $data['sidebar']      = $this->load->view("Sidebar", $data, true);
                $data['content']      = $this->load->view("update_lokasi", $data, true);
                $this->load->view("UserTemplate", $data); 

  }


function hapus($id)
{
  $this->HomeModel->hapus_data($id);
  $this-> session->set_flashdata('eror', "Data Berhasil Dihapus");
  redirect('');
}


function hapus_data($id)
{
  $this->db->where('id', $id);
  $this->db->delete($this->location);
}




     
  

