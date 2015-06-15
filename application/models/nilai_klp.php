<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nilai_klp extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('NILAI_KLP');
         $this->db->order_by('ID_KLP', 'ASC');
         $query=$this->db->get();
        return $query->result();
    }
    
    public function getIdDistinct(){
         $this->db->select('ID_PERUSAHAAN,ID_KLP');
         $this->db->distinct();
         $this->db->from('NILAI_MHS_PERUSAHAAN');
         $this->db->order_by('ID_PERUSAHAAN', 'ASC');
         $query=$this->db->get();
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
    
    public function getNilai($idklp){
        $this->db->select('*');
        $this->db->from('NILAI_KLP');
        $this->db->where('ID_KLP',$idklp);
        //$this->db->join('MAHASISWA', 'NILAI_MHS_PERUSAHAAN.NRP = MAHASISWA.NRP');
        $query = $this->db->get();
        return $query->row();
    }
    
    //fungsi menambah nilai_mhs_perusahaan
    public function addNilaiKlp($idklp){
        $data1=array(
            'ID_KLP'=>$idklp,
            'NILAI1_PENGUJI1'=>0,
            'NILAI2_PENGUJI1'=>0,
            'NILAI3_PENGUJI1'=>0,
            'NILAI4_PENGUJI1'=>0,
            'NILAI_AKHIR_PENGUJI1'=>0,
            'NILAI1_PENGUJI2'=>0,
            'NILAI2_PENGUJI2'=>0,
            'NILAI3_PENGUJI2'=>0,
            'NILAI4_PENGUJI2'=>0,
            'NILAI_AKHIR_PENGUJI2'=>0,
            'NILAI1_PEMBIMBING'=>0,
            'NILAI2_PEMBIMBING'=>0,
            'NILAI3_PEMBIMBING'=>0,
            'NILAI4_PEMBIMBING'=>0,
            'NILAI5_PEMBIMBING'=>0,
            'NILAI_AKHIR_PEMBIMBING'=>0,
            'NILAI_AKHIR'=>0
            );
        $this->db->insert('NILAI_KLP',$data1);
    }
    
    public function getAllNilai($idklp){
        $this->db->select('NILAI_AKHIR_PENGUJI1,NILAI_AKHIR_PENGUJI2,NILAI_AKHIR_PEMBIMBING');
        $this->db->from('NILAI_KLP');
        $this->db->where('ID_KLP',$idklp);
        $query = $this->db->get();
        return $query->row();
    }
    
   public function updateNilaiPembimbing(){
        $idklp = $this->input->post('idklp');
        $nilai = array();
        $total = 0;
        for( $i = 1; $i<=5; $i++){
            $nilai[$i] =  ($this->input->post($i))?$this->input->post($i):0;
            $total += $nilai[$i];
        }
        
        $data1=array(          
            'NILAI1_PEMBIMBING' => $nilai[1],
            'NILAI2_PEMBIMBING' => $nilai[2],
            'NILAI3_PEMBIMBING' => $nilai[3],
            'NILAI4_PEMBIMBING' => $nilai[4],
            'NILAI5_PEMBIMBING' => $nilai[5],
            'NILAI_AKHIR_PEMBIMBING'=> $total/5,
            'CATATAN_DOSBING'=>($this->input->post('catatan'))?$this->input->post('catatan'):''
          );
        
        $this->db->where('ID_KLP', $idklp);
        $this->db->update('NILAI_KLP', $data1); 
    }
    
    public function updateTotalNilai($nilaiPenguji1,$nilaiPenguji2, $nilaiPembimbing,$idklp){
        $nilaiTotal = (($nilaiPenguji1+$nilaiPenguji2)/2)*0.55 + $nilaiPembimbing*0.45;
                
        $data1 = array(
            'NILAI_AKHIR'=>($nilaiTotal*10)
        );
        $this->db->where('ID_KLP', $idklp);
        $this->db->update('NILAI_KLP', $data1); 
    }
    
    public function updateNilaiPenguji(){
        $temp = explode(',',$this->input->post('idklp'));
        $idklp = $temp[0];
        $jenis = $temp[1];
        
        $nilai = array();
        $total = 0;
        for( $i = 1; $i<=4; $i++){
            $nilai[$i] =  ($this->input->post($i))?$this->input->post($i):0;
            $total += $nilai[$i];
        }
        if($jenis == 'Penguji1'){
            $data1=array(          
                'NILAI1_PENGUJI1' => $nilai[1],
                'NILAI2_PENGUJI1' => $nilai[2],
                'NILAI3_PENGUJI1' => $nilai[3],
                'NILAI4_PENGUJI1' => $nilai[4],
                'NILAI_AKHIR_PENGUJI1'=> $total/4,
                'CATATAN_PENGUJI1'=>($this->input->post('catatan'))?$this->input->post('catatan'):''
              );
        }
        else{
            $data2=array(          
                'NILAI1_PENGUJI2' => $nilai[1],
                'NILAI2_PENGUJI2' => $nilai[2],
                'NILAI3_PENGUJI2' => $nilai[3],
                'NILAI4_PENGUJI2' => $nilai[4],
                'NILAI_AKHIR_PENGUJI2'=> $total/4,
                'CATATAN_PENGUJI2'=>($this->input->post('catatan'))?$this->input->post('catatan'):''
              );
        }
        $data = ($jenis == 'Penguji1')?$data1:$data2;
        $this->db->where('ID_KLP', $idklp);
        $this->db->update('NILAI_KLP', $data); 
    }
}
?>