<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catatan_bimbingan extends CI_Model {
    public function getCttnBimbing($idklp){
        $query = $this->db->query('
            SELECT *
            FROM 
                CATATAN_BIMBINGAN CB, BIMBINGAN B
            WHERE 
                CB.ID_BIMBINGAN = B.ID_BIMBINGAN AND
                B.ID_KLP = '.$idklp
        );
        return $query->result();
    }
    
    public function getCttn(){
        $this->db->select('*');
        $this->db->from('CATATAN_BIMBINGAN');
        $this->db->join('BIMBINGAN', 'CATATAN_BIMBINGAN.ID_BIMBINGAN = BIMBINGAN.ID_BIMBINGAN');
        $this->db->order_by('CATATAN_BIMBINGAN.ID_CATATAN','ASC');
        return $this->db->get()->result();
    }
    
    public function getIdBimbing($dateNow){
        $this->db->select("*");
        $this->db->from("BIMBINGAN");
        $this->db->where('ID_KLP', $username);
        $this->db->where('TANGGAL_BIMBINGAN',$dateNow);
        $query = $this->db->get();
        return $query->row()->ID_BIMBINGAN;
    }
    
    public function addCttnBimbing($jenis,$idbimbing){
        //$idbimbing = $this->input->post('idBimbingan');
        $username = $this->session->userdata('username');
        $data2=array(
                    'ID_BIMBINGAN'=>(isset($idbimbing))?$idbimbing:$this->input->post('idBimbingan'),
                    'TEXT_CATATAN'=>($this->input->post('catatan'))?$this->input->post('catatan'):'',
                    'USER'=>($jenis ==  'klp')?'KLP'.$username:$username
                );
        $this->db->insert('CATATAN_BIMBINGAN',$data2);
    }
}

?>