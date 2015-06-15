<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jadwal_seminar extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
        $query=$this->db->get('JADWAL_SEMINAR');
        return $query->result();
    }
    
    public function count(){
        return  $this->db->count_all('KELOMPOK_KP');
    }
    
    public function last(){
         $this->db->select('ID_JADWAL');
         $this->db->from('JADWAL_SEMINAR');
         $this->db->order_by('ID_JADWAL', 'ASC');
         $query=$this->db->get();
         return $query->last_row();
    }
    
    public function getData(){
        $this->db->select('*');
        $this->db->from('JADWAL_SEMINAR');
        $this->db->join('RUANGAN', 'JADWAL_SEMINAR.ID_RUANG = RUANGAN.ID_RUANG');
        $this->db->join('PERIODE', 'JADWAL_SEMINAR.ID_PERIODE = PERIODE.ID_PERIODE');
        return $this->db->get()->result();
    }
    
    public function getDataJadwal($idjadwal){
        $this->db->select("*");
        $this->db->from("JADWAL_SEMINAR");
        $this->db->where('ID_JADWAL', $idjadwal);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getJadwal($idjadwal){
        $this->db->select("*");
        $this->db->from("JADWAL_SEMINAR");
        $this->db->where('ID_JADWAL', $idjadwal);
        $query = $this->db->get();
        return $query->last_row();
    }
    
    //fungsi menambah member
    public function addJadwal(){
        $data1=array(
                    'ID_PERIODE'=>$this->input->post('periode'),
                    'ID_RUANG'=>$this->input->post('ruangan'),
                    'TANGGAL'=>$this->input->post('tanggal'),
                    'JAM'=>$this->input->post('jam').'.'.$this->input->post('menit')
                );
        $this->db->insert('JADWAL_SEMINAR',$data1);
    }
    
    public function updateJadwal(){
        $temp = explode(',',$this->input->post('idjadwal'));
        $id = $temp[3];
        $data=array(          
            'ID_PERIODE'=>$this->input->post('periode'),
            'ID_RUANG'=>$this->input->post('ruangan'),
            'TANGGAL'=>$this->input->post('tanggal'),
            'JAM'=>$this->input->post('jam').'.'.$this->input->post('menit')
          );
        
        $this->db->where('ID_JADWAL', $id);
        $this->db->update('JADWAL_SEMINAR', $data); 
    }
    
    public function deleteJadwal(){
         $idjadwal = $this->input->post('idjadwal'); 
         $this->db->where('ID_JADWAL', $idjadwal);
         $this->db->delete('JADWAL_SEMINAR'); 
    }
}

?>