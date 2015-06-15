<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ruangan extends CI_Model {
    //fungsi untuk tampilkan data Ruangan
    public function tampil(){
         $this->db->select('*');
         $this->db->from('RUANGAN');
         $this->db->order_by('ID_RUANG','ASC');
         $query=$this->db->get();
         return $query->result();
    }
}
?>