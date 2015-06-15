<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Detail_mhs extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
        $query=$this->db->get('DETAIL_MHS');
        return $query->result();
    }
    
    public function getDataMhs(){
        $this->db->select('*');
        $this->db->from('DETAIL_MHS');
        
        $this->db->join('MAHASISWA', 'DETAIL_MHS.NRP = MAHASISWA.NRP');
        $this->db->join('KELOMPOK_KP', 'KELOMPOK_KP.ID_KLP = DETAIL_MHS.ID_KLP');
        
        $this->db->order_by('KELOMPOK_KP.ID_KLP', 'ASC');
        return $this->db->get()->result();
    }
    
    public function getData(){
        $this->db->select('*');
        $this->db->from('DETAIL_MHS');
        $this->db->join('KELOMPOK_KP', 'DETAIL_MHS.ID_KLP = KELOMPOK_KP.ID_KLP');
        $this->db->join('MAHASISWA', 'DETAIL_MHS.NRP = MAHASISWA.NRP');
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->order_by('MAHASISWA.NRP','ASC');
        return $this->db->get()->result();
    }
    
    public function getMHS($idklp){
        $this->db->select("*");
        $this->db->from("DETAIL_MHS");
        $this->db->where('ID_KLP', $idklp);
        $this->db->join('MAHASISWA', 'DETAIL_MHS.NRP = MAHASISWA.NRP');
        $query = $this->db->get();
        return $query->result();
    }
    
    //fungsi menambah member
    public function addDTL($nrp,$idklp){
        $data2=array(
                    'NRP'=>$nrp,
                    'ID_KLP'=>$idklp
                );
        $this->db->insert('DETAIL_MHS',$data2);
    }
}

?>