<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classification_model extends CI_Model {
    
     public function getClassi($member){
        $this->db->select('*');
        $this->db->from('classification');
        $this->db->where('ID_Member', $member);
       
        //$this->db->where("username = '$username' and password = 'sha1($password)'");
        
        $query = $this->db->get();
        return $query->result();
    }
    
    //buat ngambil data, biar bisa dilihat
    public function getData()
    {  
        $ambil = $this->db->get('classification');
        if($ambil->num_rows() > 0)
        {
        foreach($ambil->result() as $baris)
        {
            $hasil[] = $baris;
        }
            return $hasil;
        }
    }
    
    //buat insert
    public function insertClassification($member){
        $data=array(
            'ID_Member'=>$member
        );
        $this->db->insert('classification',$data);
    }
    
    //buat update
    public function updateclass($tabel,$data,$id,$field_id)
    {
        $this->db->where($field_id, $id);
        $this->db->update($tabel, $data); 
    }
    
    //fungsi update
    public function updateDataClass(){
          $session_data = $this->session->userdata('logged_in');       
            $idmem=$session_data['ID_Member'];
            $data_class=array(
            'total_pegawai'=>$this->input->post('total_pegawai'),
            'naval_architect'=>$this->input->post('naval_architect'),
            'marine_engineer'=>$this->input->post('marine_engineer'),
            'mechanical_engineer'=>$this->input->post('mechanical_engineer'),
            'electrical_engineer'=>$this->input->post('electrical_engineer'),
            'field_engineer'=>$this->input->post('field_engineer'),
            'forman_worker'=>$this->input->post('forman_worker'),
            'direksi_pimpinan'=>$this->input->post('direksi_pimpinan'),
            'manager'=>$this->input->post('manager'),
            'dock'=>$this->input->post('dock'),
            'kapasitas_crane'=>$this->input->post('kapasitas_crane'),
            'dermaga_terpanjang'=>$this->input->post('dermaga_terpanjang'),
            'reparasi'=>$this->input->post('reparasi'),
            'nilai_kontrak_tinggi'=>$this->input->post('nilai_kontrak_tinggi'),
            'total_aset'=>$this->input->post('total_aset'),
            'jumlah_equitas'=>$this->input->post('jumlah_equitas'),
            'jumlah_penjualan'=>$this->input->post('jumlah_penjualan'),  
            );
            $this->updateclass('classification',$data_class,$idmem,'ID_Member');
    }
    
    //fungsi tambah klasifikasi
    public function addClass(){
       
        $data=array(
            'ID_Member'=>$this->input->post('ID_Member'),
            'total_pegawai'=>$this->input->post('total_pegawai'),
            'naval_architect'=>$this->input->post('naval_architect'),
            'marine_engineer'=>$this->input->post('marine_engineer'),
            'mechanical_engineer'=>$this->input->post('mechanical_engineer'),
            'electrical_engineer'=>$this->input->post('electrical_engineer'),
            'field_engineer'=>$this->input->post('field_engineer'),
            'forman_worker'=>$this->input->post('forman_worker'),
            'direksi_pimpinan'=>$this->input->post('direksi_pimpinan'),
            'manager'=>$this->input->post('manager'),
            'dock'=>$this->input->post('dock'),
            'kapasitas_crane'=>$this->input->post('kapasitas_crane'),
            'dermaga_terpanjang'=>$this->input->post('dermaga_terpanjang'),
            'reparasi'=>$this->input->post('reparasi'),
            'nilai_kontrak_tinggi'=>$this->input->post('nilai_kontrak_tinggi'),
            'total_aset'=>$this->input->post('total_aset'),
            'jumlah_equitas'=>$this->input->post('jumlah_equitas'),
            'jumlah_penjualan'=>$this->input->post('jumlah_penjualan'),         
        );
         $this->db->insert('classification',$data);
    }
    
}

?>
