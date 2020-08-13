<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DesaController extends CI_Controller {
	function __construct() {
		parent::__construct();
        $this->load->model('DesaModel');
        $this->load->model('LoginModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
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
            $data['desa']         = $this->DesaModel->desa(); 
            $data['title']        = "Kelola data Desa";
            $data['sidebar']      = $this->load->view("Sidebar", $data, true);
            $data['content']      = $this->load->view("desa/index", $data, true);
            $this->load->view("UserTemplate", $data); 
        }
    } 

    public function tambah_desa()
    {
        $this->form_validation->set_rules('nama_desa', 'Nama desa', 'required|is_unique[tb_desa.nama_desa]');
        $this->form_validation->set_rules('alamat_desa', 'Alamat desa', 'required');
        $this->form_validation->set_rules('alamat_website', 'Alamat website', 'required');
        $this->form_validation->set_rules('telp_desa', 'No Telepone', 'required');
        $this->form_validation->set_rules('nama_kepala_desa', 'Nama Kepala desa', 'required|is_unique[tb_desa.nama_kepala_desa]');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        

        $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
        $this->form_validation->set_message('is_unique' , ' %s sudah ada');
        $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

        if($this->form_validation->run() == FALSE){
            $posisi=($this->session->userdata('posisi'));
            if($posisi=='1'){
                $idUser=($this->session->userdata('username'));
                $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
                $data['title']        = "Tambah data Desa";
                $data['sidebar']      = $this->load->view("Sidebar", $data, true);
                $data['content']      = $this->load->view("desa/tambah", $data, true);
                $this->load->view("UserTemplate", $data); 
            }
        } else {
            $nama             = $this->input->post('nama_desa');
            $nama_kepala_desa = $this->input->post('nama_kepala_desa');
            $kecamatan        = $this->input->post('kecamatan');
            $provinsi         = $this->input->post('provinsi');
            $kabupaten        = $this->input->post('kabupaten');
            $alamat_desa      = $this->input->post('alamat_desa');
            $alamat_website   = $this->input->post('alamat_website');
            $telp_desa        = $this->input->post('telp_desa');
            

            //$myFileName = str_replace(' ','-',strtolower('desa')).'-'.$nama;
            $config['upload_path'] = './assets/image/logo_desa';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '5048';  //4MB max
            $config['file_name'] = $_FILES['logo']['name'];

            $this->upload->initialize($config);
            if (!empty($_FILES['logo']['name'])) {
              $this->upload->do_upload('logo');
              $logo=$this->upload->data();
          }

          $data = array(
            'nama_desa'       => $nama,
            'nama_kepala_desa'=> $nama_kepala_desa,
            'kecamatan'       => $kecamatan,
            'kabupaten'       => $kabupaten,
            'provinsi'        => $provinsi,
            'alamat_desa'     => $alamat_desa,
            'alamat_website'  => $alamat_website,
            'telp_desa'       => $telp_desa,
            'logo'            => $logo['file_name'],
            'date_created'    => date("Y-m-d H:i:s")
        );
        //print_r($data);
          $this-> session->set_flashdata('sukses', "Data Berhasil Ditambahkan");
          $this->DesaModel->input_data($data);
          redirect('kelola-data-desa');
          
      }
      
  }

  public function update_desa($id)
  {
    $this->form_validation->set_rules('nama_desa', 'Nama desa', 'required|is_unique[tb_desa.nama_desa]');
    $this->form_validation->set_rules('alamat_desa', 'Alamat desa', 'required');
    $this->form_validation->set_rules('alamat_website', 'Alamat website', 'required');
    $this->form_validation->set_rules('telp_desa', 'No Telepone', 'required');
    $this->form_validation->set_rules('nama_kepala_desa', 'Nama Kepala desa', 'required|is_unique[tb_desa.nama_kepala_desa]');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
     $this->form_validation->set_rules('id_user', 'User', 'required');

    $this->form_validation->set_message('required' , ' %s tidak boleh kosong , silakan isi');
    $this->form_validation->set_message('is_unique' , ' %s sudah ada');
    $this->form_validation->set_error_delimiters('<span class="form-control-feedback">' , '</span>');

    if($this->form_validation->run() == FALSE){
        $posisi=($this->session->userdata('posisi'));
        if($posisi=='1'){
            $idUser=($this->session->userdata('username'));
            $data['myProfil']     = $this->LoginModel->admin($idUser)->result();
            $data['desa']         = $this->DesaModel->spesifik_data($id);
            $data['groups']       = $this->DesaModel->level_user3();
            $data['title']        = "Edit data Desa";
            $data['sidebar']      = $this->load->view("Sidebar", $data, true);
            $data['content']      = $this->load->view("desa/update", $data, true);
            $this->load->view("UserTemplate", $data); 
        }
    } else{
        $id               = $this->input->post('id_desa');
        $nama_desa        = $this->input->post('nama_desa');
        $nama_kepala_desa = $this->input->post('nama_kepala_desa');
        $alamat_desa      = $this->input->post('alamat_desa');
        $alamat_website   = $this->input->post('alamat_website');
        $no_telp          = $this->input->post('telp_desa');
        $logo             = $this->input->post('logo');
        $kecamatan        = $this->input->post('kecamatan');
        $provinsi         = $this->input->post('provinsi');
        $kabupaten        = $this->input->post('kabupaten');
        $id_user          = $this->input->post('id_user');

        $path             = './assets/image/logo_desa/';
        $kondisi          = array('id_desa' => $id );

        //$myFileName              = str_replace(' ','-',strtolower('desa')).'-'.$nama_desa;
        $config['upload_path']   = './assets/image/logo_desa';
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '5048';  //3MB max
        $config['file_name']     = $_FILES['logo']['name'];
        
        $this->upload->initialize($config);

        if (!empty($_FILES['logo']['name'])) {
            if ( $this->upload->do_upload('logo') ) {
                $logo= $this->upload->data();
                $data = array(
                    'nama_desa'       => $nama_desa,
                    'nama_kepala_desa'=> $nama_kepala_desa,
                    'kecamatan'       => $kecamatan,
                    'kabupaten'       => $kabupaten,
                    'provinsi'        => $provinsi,
                    'alamat_desa'     => $alamat_desa,
                    'alamat_website'  => $alamat_website,
                    'telp_desa'       => $no_telp,
                    'logo'            => $logo['file_name'],
                    'id_user'         => $id_user,
                    'date_update'     => date("Y-m-d H:i:s")
                );
                @unlink($path.$this->input->post('ganti_gambar'));
            //    print_r($data);
                $this->DesaModel->update_data($data,$kondisi);
                redirect('kelola-data-desa');
            }else {
                $this-> session->set_flashdata('sukses', "Data Gagal Diubah");
                redirect('kelola-data-desa');
            }
        }elseif ($id =$this->input->post('id_desa')) {
            $data = array(
                'nama_desa'       => $nama_desa,
                'nama_kepala_desa'=> $nama_kepala_desa,
                'kecamatan'       => $kecamatan,
                'kabupaten'       => $kabupaten,
                'provinsi'        => $provinsi,
                'alamat_desa'     => $alamat_desa,
                'alamat_website'  => $alamat_website,
                'telp_desa'       => $no_telp,
                'logo'            => $logo,
                'id_user'         => $id_user,
                'date_update'     => date("Y-m-d H:i:s")
            );
       // print_r($data);
            $this-> session->set_flashdata('sukses', "Data Berhasil Diubah");
            $this->DesaModel->ganti_data($data, $id);
            redirect('kelola-data-desa');
        }else {
           $this-> session->set_flashdata('sukses', "Data Tidak Masuk");
           redirect('kelola-data-desa');
       }

   }

}


function hapus($id)
{
    $data = $this->DesaModel->hapus_data($id);
    $path = './assets/image/logo_desa/';
    @unlink($path.$data->logo);
    if ($this->DesaModel->delete_gambar($id) == TRUE) {
        $where = array('id_desa' => $id );
        $this->DesaModel->delete_gambar($where);
    }
    $this-> session->set_flashdata('eror', "Data Berhasil Dihapus");
    redirect('kelola-data-desa');
}

function hapus_data($id)
{
    $this->db->where('id_desa', $id);
    $this->db->delete($this->table);
}     

public function monitoring()
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Data";
        $data['total']        = $this->DesaModel->total1();
        $data['total2']       = $this->DesaModel->total2();
        $data['total3']       = $this->DesaModel->total3();
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/index", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
}

public function detail_jml_dasa()
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Jumlah Data Dasa Wisma";
        $data['detail']       = $this->DesaModel->detail_1();
            //print_r( $data['detail'] );
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/detail_dasa", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
} 

public function detail_jml_krt()
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Jumlah Data Kepala Rumah Tangga";
        $data['detail']       = $this->DesaModel->detail_2();
            //print_r( $data['detail'] );
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/detail_krt", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
} 

public function detail_krt($id)
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Jumlah Data Kepala Rumah Tangga";
        $data['detail']       = $this->DesaModel->spesifik_data_dt($id);
         //  print_r( $data['detail'] );
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/dtkp", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
}

public function detail_jml_tppk()
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Jumlah Data TP -PKK";
        $data['detail']       = $this->DesaModel->detail_3();
           // print_r( $data['detail'] );
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/detail_tppk", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
} 

public function detail_tppk($id)
{
    $posisi=($this->session->userdata('posisi'));
    if($posisi=='3'){
        $posisi=($this->session->userdata('posisi'));
        $idUser=($this->session->userdata('username'));
        $data['myProfil']     = $this->LoginModel->admin2($idUser)->result();
        $data['title']        = "Monitoring Jumlah Data TP - PKK";
        $data['detail']       = $this->DesaModel->spesifik_data_tp($id);
            //print_r( $data['detail'] );
        $data['sidebar']      = $this->load->view("Sidebar", $data, true);
        $data['content']      = $this->load->view("desa/mon/dtppk", $data, true);
        $this->load->view("UserTemplate", $data); 
    }
}

}