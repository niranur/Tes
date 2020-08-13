<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class DesaModel extends CI_Model {

  public function __construct()
  {
    $this->table = 'tb_desa';

    parent::__construct();
  }


  public function input_data($data)
  {
    $this->db->insert($this->table, $data);
  }

  public function desa()
  {
    $this->db->select(['a.*']);
    $this->db->from('tb_desa a');
    $this->db->order_by("a.id_desa DESC");
    $return = $this->db->get();
    return $return->result();
  }

  
  public function hapus_data($id)
  {
    $this->db->where('id_desa',$id);
    $this->db->from('tb_desa');
    $result = $this->db->get('');

    if ($result->num_rows() > 0) {
      return $result->row();
    }
  }

  public function delete_gambar($where)
  {
    $this->db->where($where);
    $this->db->delete('tb_desa');
    return TRUE;
  }

  public function spesifik_data($id)
  {
    $query = $this->db->get_where($this->table,array('id_desa'=> $id));
    return $query->row();
  }

  function update_data($data, $kondisi)
  {
    $this->db->update('tb_desa',$data,$kondisi);
    return TRUE;
  }

  function ganti_data($data, $id)
  {
    $this->db->where('id_desa', $id);
    $this->db->update($this->table, $data);
  }

  function total1(){
    $this->db->select([
      'COUNT(a.id_dasawisma) as total', 'a.*'
    ]);
    $this->db->from('tb_dasawisma a');
    $return = $this->db->get();
    return $return->result();
  }

  function total2(){
    $this->db->select([
      'COUNT(a.id_kk) as total'
    ]);
    $this->db->from('tb_kk a');
    $this->db->where("a.status_keluarga ='kepala rumah tangga' ");
    $return = $this->db->get();
    return $return->result();
  }

  function total3(){
    $this->db->select([
      'COUNT(a.id_registrasi) as total'
    ]);
    $this->db->from('tb_tppk a');
    $return = $this->db->get();
    return $return->result();
  }

  function detail_1(){
    $this->db->select(['a.*', 'b.status', 'c.nama'
  ]);
    $this->db->from('tb_dasawisma a');
    $this->db->join('tb_akses b', 'b.id_user=a.id_user', 'left');
    $this->db->join('level_user c', 'c.id_level_user = b.level_user', 'left');
    $this->db->order_by("a.id_dasawisma DESC");
    $return = $this->db->get();
    return $return->result();
  }

  function detail_2(){
    $this->db->select(['a.*', 'b.nama_dawis', 'c.*', 'd.*'
  ]);
    $this->db->from('tb_kk a');
    $this->db->join('tb_dasawisma b', 'b.id_dasawisma=a.id_dasawisma', 'left');
    $this->db->join('tb_rt c', 'c.id_rt=a.id_rt', 'left');
    $this->db->join('tb_rw d', 'd.id_rw=c.id_rw', 'left');
    $this->db->where("a.status_keluarga='kepala rumah tangga'");
    $return = $this->db->get();
    return $return->result();
  }

  function spesifik_data_dt($id){
    $this->db->select([
      'a.*', 'b.nama_dawis', 'c.*', 'd.*','f.*', 'e.*',
      'g.komoditi as km','g.volume as vol','g.satuan as sat','g.foto as foto_p','g.kategori as k','h.*'
    ]);
    $this->db->from('tb_kk a');
    $this->db->join('tb_dasawisma b', 'b.id_dasawisma=a.id_dasawisma', 'left');
    $this->db->join('tb_rt c', 'c.id_rt=a.id_rt', 'left');
    $this->db->join('tb_rw d', 'd.id_rw=c.id_rw', 'left');
    $this->db->join('tb_detail_kk f', 'f.id_kk = a.id_kk', 'left');
    $this->db->join('tb_pekarangan e', 'e.id_kk = a.id_kk', 'left');
    $this->db->join('tb_industri g', 'g.id_kk = a.id_kk', 'left');
    $this->db->join('tb_tppk h', 'h.id_anggota_kk = a.id_kk', 'left');
    $this->db->where("a.id_kk='$id'");
    $return = $this->db->get();
    return $return->result();
  }

  // function detail_3(){
  //   $this->db->select(['a.*', 'b.nama_dawis', 'c.*', 'd.*','e.*'
  // ]);
  //   $this->db->from('tb_kk a');
  //   $this->db->join('tb_dasawisma b', 'b.id_dasawisma=a.id_dasawisma', 'left');
  //   $this->db->join('tb_rt c', 'c.id_rt=a.id_rt', 'left');
  //   $this->db->join('tb_rw d', 'd.id_rw=c.id_rw', 'left');
  //   $this->db->join('tb_tppk e', 'e.id_anggota_kk = a.id_kk', 'left');

  //   $this->db->order_by("a.id_kk DESC");
  //   $return = $this->db->get();
  //   return $return->result();
  // }

  function detail_3(){
    $this->db->select(['a.*', 'e.nama_dawis', 'c.*', 'd.*','e.*', 'b.*'
  ]);
    $this->db->from('tb_tppk a');
    $this->db->join('tb_kk b', 'b.id_kk=a.id_anggota_kk', 'left');
     $this->db->join('tb_dasawisma e', 'e.id_dasawisma=b.id_dasawisma', 'left');
    $this->db->join('tb_rt c', 'c.id_rt=b.id_rt', 'left');
    $this->db->join('tb_rw d', 'd.id_rw=c.id_rw', 'left');
    
    $this->db->order_by("a.id_kk DESC");
    $return = $this->db->get();
    return $return->result();
  }

  function spesifik_data_tp($id){
    $this->db->select(['a.*', 'b.nama_dawis', 'd.*','e.*','c.*'
  ]);
     $this->db->from('tb_kk a');
    $this->db->join('tb_dasawisma b', 'b.id_dasawisma=a.id_dasawisma', 'left');
    $this->db->join('tb_rt c', 'c.id_rt=a.id_rt', 'left');
    $this->db->join('tb_rw d', 'd.id_rw=c.id_rw', 'left');
    $this->db->join('tb_tppk e', 'e.id_anggota_kk = a.id_kk', 'left');
    $this->db->where("e.id_registrasi='$id'");
    $return = $this->db->get();
    return $return->result();
  }

  public function level_user3()
  {
    $this->db->order_by('tb_akses.id_user','ASC');
    $this->db->join('level_user', 'level_user.id_level_user = tb_akses.level_user' ,'LEFT');
    $this->db->where("level_user.id_level_user='3'");
    $listdataa=$this->db->get('tb_akses');
    return $listdataa->result_array();
  }
}
?>