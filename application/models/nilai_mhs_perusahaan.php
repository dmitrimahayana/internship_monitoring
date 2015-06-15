<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nilai_mhs_perusahaan extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('NILAI_MHS_PERUSAHAAN');
         $this->db->order_by('ID_KLP', 'ASC');
         $query=$this->db->get();
        return $query->result();
    }
    
    public function count(){
        $query = $this->db->query('
            select count(ID_PERUSAHAAN) as ROWNUMBERR
            from (
              select DISTINCT ID_PERUSAHAAN from NILAI_MHS_PERUSAHAAN
              )'
        );
        return $query->row()->ROWNUMBERR;
    }
    
    public function getIdDistinct(){
         $this->db->select('ID_PERUSAHAAN,ID_KLP');
         $this->db->distinct();
         $this->db->from('NILAI_MHS_PERUSAHAAN');
         $this->db->order_by('ID_PERUSAHAAN', 'ASC');
         $query=$this->db->get();
         return $query->result();
    }
    
    public function getIdDistinctLimit($start, $perPage){
        $limit = $perPage +$start;
        $query = $this->db->query('
            select ID_PERUSAHAAN,ID_KLP
            from (
              select DISTINCT ID_PERUSAHAAN,ID_KLP,ROWNUM AS RNUM 
              from NILAI_MHS_PERUSAHAAN
              WHERE ROWNUM <='.$limit.'
            )
            WHERE RNUM > '.$start
          );
         return $query->result();
    }
    
    public function getData(){
        $this->db->select("*");
        $this->db->from("NILAI_MHS_PERUSAHAAN");
        $this->db->join('PERUSAHAAN', 'NILAI_MHS_PERUSAHAAN.ID_PERUSAHAAN = PERUSAHAAN.ID_PERUSAHAAN');
        $this->db->join('MAHASISWA', 'NILAI_MHS_PERUSAHAAN.NRP = MAHASISWA.NRP');
        $this->db->order_by('NILAI_MHS_PERUSAHAAN.ID_PERUSAHAAN','ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getNilai($nrp){
        $this->db->select('*');
        $this->db->from('NILAI_MHS_PERUSAHAAN');
        $this->db->where('NRP',$nrp);
        //$this->db->join('MAHASISWA', 'NILAI_MHS_PERUSAHAAN.NRP = MAHASISWA.NRP');
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getNilaiKlp($idklp){
        $this->db->select('*');
        $this->db->from('NILAI_MHS_PERUSAHAAN');
        $this->db->where('ID_KLP',$idklp);
        $this->db->join('MAHASISWA', 'NILAI_MHS_PERUSAHAAN.NRP = MAHASISWA.NRP');
        $query = $this->db->get();
        return $query->result();
    }
    
    //fungsi menambah nilai_mhs_perusahaan
    public function addNilaiPrsh($idprsh, $nrp,$idklp){
        $data1=array(
            'ID_KLP'=>$idklp,
            'ID_PERUSAHAAN'=>$idprsh,
            'NRP'=>$nrp,
            'NILAI_MHS_PERUSAHAAN'=>0,
            'NILAI1'=>0,
            'NILAI2'=>0,
            'NILAI3'=>0,
            'NILAI4'=>0,
            'NILAI5'=>0,
            'NILAI6'=>0,
            'NILAI7'=>0,
            'NILAI8'=>0,
            'NILAI9'=>0,
            'NILAI10'=>0,
            'NILAI11'=>0,
            'NILAI12'=>0,
            'NILAI13'=>0
            );
        $this->db->insert('NILAI_MHS_PERUSAHAAN',$data1);
    }
    
    public function updateNilai(){
        $nrp = $this->input->post('nrp');
        $nilai = array();
        $total = 0;
        for( $i = 1; $i<=13; $i++){
            $nilai[$i] =  $this->input->post($i);
            $total += $nilai[$i];
        }
        
        $data=array(          
            'NILAI1' => $nilai[1],
            'NILAI2' => $nilai[2],
            'NILAI3' => $nilai[3],
            'NILAI4' => $nilai[4],
            'NILAI5' => $nilai[5],
            'NILAI6' => $nilai[6],
            'NILAI7' => $nilai[7],
            'NILAI8' => $nilai[8],
            'NILAI9' => $nilai[9],
            'NILAI10'=> $nilai[10],
            'NILAI11'=> $nilai[11],
            'NILAI12'=> $nilai[12],
            'NILAI13'=> $nilai[13],
            'NILAI_MHS_PERUSAHAAN'=> $total/13,
          );
        
        $this->db->where('NRP', $nrp);
        $this->db->update('NILAI_MHS_PERUSAHAAN', $data); 
    }
}
?>