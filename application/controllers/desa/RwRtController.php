<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RwRtController extends CI_Controller {
	function __construct() {
		parent::__construct();
        $this->load->model('RwRtModel');
        $this->load->model('LoginModel');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Jakarta"); 
        $this->dateToday = date("Y-m-d H:i:s");

        if ($this->session->userdata('status') !="login") {	
            redirect(base_url());
        }
    }
    

    public function index()
    {
        $posisi=($this->session->userdata('posisi'));
        if($posisi=='1'){
            $posisi=($this->session->userdata('posisi'));
            $idUser=($this->session->userdata('username'));
            $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
            $data['rw']           = $this->RwRtModel->data_rw(); 
            $data['title']        = "Kelola Data Rw ";
            $data['sidebar']      = $this->load->view("Sidebar", $data, true);
            $data['content']      = $this->load->view("desa/rw/index", $data, true);
            $this->load->view("UserTemplate", $data); 
        }
    }

    public function tambah_rw()
    {
        $this->form_validation->set_rules('nama_rw', 'Nama RW', 'required|is_unique[tb_rw.nama_rw]');
        $this->form_validation->set_rules('ketua_rw', 'Nama Ketua RW', 'required|is_unique[tb_rw.ketua_rw]');
        $this->form_validation->set_rules('id_desa', 'Desa', 'required');

        $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
        $this->form_validation->set_message('is_unique' , ' %s sudah ada');
        $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

        if($this->form_validation->run() == FALSE){
            $posisi=($this->session->userdata('posisi'));
            if($posisi=='1'){
                $idUser=($this->session->userdata('username'));
                $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
                $data['groups']       = $this->RwRtModel->desa();
                $data['title']        = "Tambah data RW";
                $data['sidebar']      = $this->load->view("Sidebar", $data, true);
                $data['content']      = $this->load->view("desa/rw/tambah", $data, true);
                $this->load->view("UserTemplate", $data); 
            }
        } else {
            
            $nama_rw      = $this->input->post('nama_rw');
            $ketua_rw     = $this->input->post('ketua_rw');
            $id_desa      = $this->input->post('id_desa');

            $data = array(
                'nama_rw'       => $nama_rw,
                'ketua_rw'      => $ketua_rw,
                'id_desa'       => $id_desa,
                'date_created'    => date("Y-m-d H:i:s")
            );
            $this-> session->set_flashdata('sukses', "Data Berhasil Ditambahkan");
            $this->RwRtModel->input_data($data);
            redirect('kelola-data-rw');
        }
    }

    public function update_rw($id)
    {
        $this->form_validation->set_rules('nama_rw', 'Nama RW', 'required');
        $this->form_validation->set_rules('ketua_rw', 'Nama Ketua RW', 'required');

        $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
        $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

        if($this->form_validation->run() == FALSE){
            $posisi=($this->session->userdata('posisi'));
            if($posisi=='1'){
                $idUser=($this->session->userdata('username'));
                $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
                $data['groups']       = $this->RwRtModel->desa2();
                $data['rw']           = $this->RwRtModel->spesifik_data($id);
                $data['title']        = "Edit data RW";
                $data['sidebar']      = $this->load->view("Sidebar", $data, true);
                $data['content']      = $this->load->view("desa/rw/update", $data, true);
                $this->load->view("UserTemplate", $data); 
            }
        } else {
            $id           = $this->input->post('id_rw');
            $nama_rw      = $this->input->post('nama_rw');
            $ketua_rw     = $this->input->post('ketua_rw');
            $id_desa      = $this->input->post('id_desa');

            $data = array(
                'nama_rw'       => $nama_rw,
                'ketua_rw'      => $ketua_rw,
                'id_desa'       => $id_desa,
                'date_update'    => date("Y-m-d H:i:s")
            );
            $this-> session->set_flashdata('sukses', "Data Berhasil Diubah");
            $this->RwRtModel->update_data($data,$id);
            redirect('kelola-data-rw');
        }
    }

    function hapus($id)
    {
      $this->RwRtModel->hapus_data($id);
      $this-> session->set_flashdata('eror', "Data Berhasil Dihapus");
      redirect('kelola-data-rw');
  }

  function hapus_data($id)
  {
      $this->db->where('id_rw', $id);
      $this->db->delete($this->table);
  }

  public function rt()
  {
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='1'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
        $data['rt']           = $this->RwRtModel->data_rt(); 
        $data['title']        = "Kelola Data RT ";
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/rt/index", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
}

public function tambah_rt()
{
    $this->form_validation->set_rules('nama_rt', 'Nama RT', 'required|is_unique[tb_rt.nama_rt]');
    $this->form_validation->set_rules('ketua_rt', 'Nama Ketua RT', 'required|is_unique[tb_rt.ketua_rt]');
    $this->form_validation->set_rules('id_rw', 'Nama RW', 'required');

    $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
    $this->form_validation->set_message('is_unique' , ' %s sudah ada');
    $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

    if($this->form_validation->run() == FALSE){
        $posisi=($this->session->userdata('posisi'));
        if($posisi=='1'){
            $idUser=($this->session->userdata('username'));
            $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
            $data['groups']       = $this->RwRtModel->desa_rw();
            $data['title']        = "Tambah data RT";
            $data['sidebar']      = $this->load->view("Sidebar", $data, true);
            $data['content']      = $this->load->view("desa/rt/tambah", $data, true);
            $this->load->view("UserTemplate", $data); 
        }
    } else {
        
        $nama_rt      = $this->input->post('nama_rt');
        $ketua_rt     = $this->input->post('ketua_rt');
        $id_rw      = $this->input->post('id_rw');

        $data = array(
            'nama_rt'       => $nama_rt,
            'ketua_rt'      => $ketua_rt,
            'id_rw'       => $id_rw,
            'date_created'    => date("Y-m-d H:i:s")
        );
        $this-> session->set_flashdata('sukses', "Data Berhasil Ditambahkan");
        $this->RwRtModel->input_data_rt($data);
        redirect('kelola-data-rt');
    }
}

public function update_rt($id)
{
    $this->form_validation->set_rules('nama_rt', 'Nama RT', 'required');
    $this->form_validation->set_rules('ketua_rt', 'Nama Ketua RT', 'required');

    $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
    $this->form_validation->set_message('is_unique' , ' %s sudah ada');
    $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

    if($this->form_validation->run() == FALSE){
        $posisi=($this->session->userdata('posisi'));
        if($posisi=='1'){
            $idUser=($this->session->userdata('username'));
            $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
            $data['groups']       = $this->RwRtModel->desa_rw2();
            $data['rt']           = $this->RwRtModel->spesifik_data_rt($id);
            $data['title']        = "Edit data RT";
            $data['sidebar']      = $this->load->view("Sidebar", $data, true);
            $data['content']      = $this->load->view("desa/rt/update", $data, true);
            $this->load->view("UserTemplate", $data); 
        }
    } else {
        $id           = $this->input->post('id_rt');
        $nama_rt      = $this->input->post('nama_rt');
        $ketua_rt     = $this->input->post('ketua_rt');
        $id_rw        = $this->input->post('id_rw');

        $data = array(
            'nama_rt'       => $nama_rt,
            'ketua_rt'      => $ketua_rt,
            'id_rw'         => $id_rw,
            'date_created'  => date("Y-m-d H:i:s")
        );

        $this-> session->set_flashdata('sukses', "Data Berhasil Diubah");
        $this->RwRtModel->update_data_rt($data , $id);
        redirect('kelola-data-rt');
    }
}

function hapus_rt($id)
{
  $this->RwRtModel->hapus_data_rt($id);
  
  $this-> session->set_flashdata('eror', "Data Berhasil Dihapus");
  redirect('kelola-data-rt');
}

function hapus_data_rt($id)
{
  $this->db->where('id_rt', $id);
  $this->db->delete($this->table_rt);
}

}