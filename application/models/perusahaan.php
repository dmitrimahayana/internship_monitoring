<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perusahaan extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('PERUSAHAAN');
         $this->db->order_by('ID_PERUSAHAAN', 'ASC');
         $query=$this->db->get();
         return $query->result();
    }
    
    public function getDataPrsh($idprsh){
        $this->db->select("*");
        $this->db->from("PERUSAHAAN");
        $this->db->where('ID_PERUSAHAAN', $idprsh);
        $query = $this->db->get();
        return $query->row();
    }
    
    //fungsi menambah member
    public function addPrsh(){
        $data1=array(
            'NAMA_PERUSAHAAN'=>$this->input->post('nama'),
            'ALAMAT_PERUSAHAAN'=>$this->input->post('alamat'),
            'TELP_PERUSAHAAN'=>$this->input->post('telp'),
            'KODE_POS'=>$this->input->post('kode_pos'),
            'BIDANG'=>$this->input->post('bidang'),
            'EMAIL'=>$this->input->post('email'),
            'KETERANGAN'=>$this->input->post('keterangan')
            );
        $this->db->insert('PERUSAHAAN',$data1);
    }
    
    public function updatePrsh(){
        $id = $this->input->post('idprsh');
        $data=array(          
            'NAMA_PERUSAHAAN'=>$this->input->post('nama'),
            'ALAMAT_PERUSAHAAN'=>$this->input->post('alamat'),
            'TELP_PERUSAHAAN'=>$this->input->post('telp'),
            'KODE_POS'=>$this->input->post('kode_pos'),
            'BIDANG'=>$this->input->post('bidang'),
            'EMAIL'=>$this->input->post('email'),
            'KETERANGAN'=>$this->input->post('keterangan')
          );
        
        $this->db->where('ID_PERUSAHAAN', $id);
        $this->db->update('PERUSAHAAN', $data); 
    }
    
    public function findPerusahaan(){
         $cari = $this->input->post('cari');
         $this->db->select('*');
         $this->db->from('PERUSAHAAN');
         $this->db->like('UPPER(BIDANG)',  strtoupper($cari));
         $this->db->order_by('ID_PERUSAHAAN', 'ASC');
         $query=$this->db->get();
         return $query->result();
    }
}
?>