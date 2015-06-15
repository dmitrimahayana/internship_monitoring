<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Periode extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('PERIODE');
         $this->db->order_by('ID_PERIODE', 'ASC');
         $query=$this->db->get();
         return $query->result();
    }
    
    public function getID($prd){
         $this->db->select('ID_PERIODE');
         $this->db->from('PERIODE');
         $this->db->where('PERIODE', $prd);
         $this->db->limit(1, 1);
         $query=$this->db->get();
         return $query->result();
    }
}
?>