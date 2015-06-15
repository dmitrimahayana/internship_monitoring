<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('KELOMPOK_KP');
         $this->db->order_by('ID_KLP', 'ASC');
         $query=$this->db->get();
        return $query->result();
    }
    
    public function getPeriode($idklp){
        $this->db->select("*");
        $this->db->from("KELOMPOK_KP");
        $this->db->where('ID_KLP', $idklp);
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $query = $this->db->get();
        return $query->row();
    }
    public function getAllDataKlp($idklp){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('ID_KLP',$idklp);
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->join('DOSEN','DOSEN.NIP_DSN = KELOMPOK_KP.NIP_DSN');
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getDataKlp($idklp){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('ID_KLP',$idklp);
        $this->db->where('ID_PERUSAHAAN IS NOT NULL');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $query = $this->db->get();
        return ($query->num_rows()>0)?$query->row():null;
    }
    
    public function getPembimbing(){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->join('DOSEN', 'DOSEN.NIP_DSN = KELOMPOK_KP.NIP_DSN');
        $this->db->order_by('ID_KLP', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getDataPembimbing(){
        $nip = $this->session->userdata('nipDsn');
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('NIP_DSN',$nip);
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->order_by('ID_KLP', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getData(){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->order_by('ID_KLP', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getKLP($idklp){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('ID_KLP',$idklp);
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        //$this->db->join('DOSEN','DOSEN.NIP_DSN = KELOMPOK_KP.NIP_DSN');
        $this->db->order_by('ID_KLP', 'ASC');
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getDataPrsh(){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('SETUJU_DOSEN','Approve');
        $this->db->where('SETUJU_PERUSAHAAN','Approve');
        
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getIdPrsh($idklp){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        $this->db->where('KELOMPOK_KP.ID_KLP', $idklp);
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $query = $this->db->get();
        return $query->row()->ID_PERUSAHAAN;
        
    }
    
    //fungsi menambah project
    public function addProject($idklp){
        $data1=array(
            'ID_KLP'=>$idklp
            );
        $this->db->insert('PROJECT',$data1);
    }
    
    public function updateProject($pathBuku,$nama,$pathProject){
        $id = $this->session->userdata('username');
         $dateNow = str_replace("-","/",date("m-d-Y"));
        if($pathBuku!=''){
            $data=array(
                'BUKU_KP'=>$pathBuku,
                'TGL_UPLOAD_PROJECT'=>$dateNow
              );
        }else if($nama!=''){
            $data=array(
                'NAMA_PROJECT'=>$nama,
                'TGL_UPLOAD_PROJECT'=>$dateNow
              );
        }else if($pathProject!=''){
            $data=array(
                'FINAL_UPLOAD_PROJECT'=>$pathProject,
                'TGL_UPLOAD_PROJECT'=>$dateNow
              );
        }
        $this->db->where('ID_KLP', $id);
        $this->db->update('PROJECT', $data); 
    }
    
    public function updateProposal($path){
        $id = $this->session->userdata('username');
       $data=array(          
            'PROPOSAL_KP'=>$path
          );
        $this->db->where('ID_KLP', $id);
        $this->db->update('KELOMPOK_KP', $data); 
    }
}
?>