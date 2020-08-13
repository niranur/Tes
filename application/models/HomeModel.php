<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class HomeModel extends CI_Model {

 public function __construct()
  {
    $this->table = 'location';

    parent::__construct();
  }


  public function input_data($data)
  {
    $this->db->insert($this->table, $data);
  }

   public function lokasi()
    {
        $this->db->select([	'a.*']);
        $this->db->from('location a');
        $this->db->order_by("a.id DESC");
        $return = $this->db->get();
        return $return->result();
    }

    public function hapus_data($id)
  {
    $this->db->where('id',$id);
    $this->db->from('location');
    $result = $this->db->get('');

    if ($result->num_rows() > 0) {
      return $result->row();
    }
  }

  public function spesifik_data($id)
  {
    $query = $this->db->get_where($this->table,array('id'=> $id));
    return $query->row();
  }
    
}
?>