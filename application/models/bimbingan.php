<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bimbingan extends CI_Model {
   public function getBbg($idklp){
        $this->db->select('*');
        $this->db->from('BIMBINGAN');
        $this->db->where('ID_KLP',$idklp);
        $this->db->order_by('TANGGAL_BIMBINGAN','DESC');
        return $this->db->get()->result();
    }
    
    public function getIdBimbing($dateNow){
        $this->db->select("*");
        $this->db->from("BIMBINGAN");
        $this->db->where( 'ID_KLP', ($this->session->userdata('jenis'))?$this->session->userdata('idklp'):$this->session->userdata('username') );
        $this->db->where('TANGGAL_BIMBINGAN',$dateNow);
        $query = $this->db->get();
        return $query->row()->ID_BIMBINGAN;
    }
    
    public function getIdBimbinganNew(){
        $this->db->select("*");
        $this->db->from("BIMBINGAN");
        $this->db->where( 'ID_KLP', ($this->session->userdata('jenis'))?$this->session->userdata('idklp'):$this->session->userdata('username') );
        $this->db->order_by('ID_BIMBINGAN','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row()->ID_BIMBINGAN; 
    }
    
    public function getJumlahBimbing(){
        $query = $this->db->query('
            SELECT ID_KLP,COUNT(ID_KLP) AS JUMLAH
            FROM 
              BIMBINGAN
            GROUP BY ID_KLP
            ');
        return $query->result();
    }
    
    //fungsi menambah bimbingan
    public function addBimbing($dateNow){
        $idklp = $this->input->post('idklp');
        echo ' '.$idklp.' ';
        $data2=array(
                    'ID_KLP'=>$idklp,
                    'TANGGAL_BIMBINGAN'=>$dateNow
                );
        $this->db->insert('BIMBINGAN',$data2);
    }
}
?>