<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dosen extends CI_Model {
    //fungsi login
    public function login($username,$password){
        $this->db->select('*');
        $this->db->from('DOSEN');
        
        $this->db->where('NIP_DSN', $username);
        $this->db->where('PASSWORD',sha1($password));
        $query = $this->db->get();
        return $query->row();
    }
    
    //fungsi untuk tampilkan data member
    public function tampil(){
        $this->db->select('*');
        $this->db->from('DOSEN');
        $this->db->order_by('NIP_DSN','ASC');
        $query=$this->db->get();
        return $query->result();
    }
    
    public function getAllPembimbing(){
        $query = $this->db->query('
                SELECT * 
                FROM
                    DOSEN D
                WHERE EXISTS(
                    SELECT *
                    FROM
                        KELOMPOK_KP K
                    WHERE K.NIP_DSN=D.NIP_DSN
                ) AND D.KOORDINATOR = 0
                    
        ');
        return $query->result();
    }
    
    public function updateDsn(){
        $this->db->query('
                UPDATE DOSEN D 
                SET PEMBIMBING = 1
                WHERE EXISTS(
                    SELECT *
                    FROM
                        KELOMPOK_KP K
                    WHERE K.NIP_DSN=D.NIP_DSN
                )  
        ');
        
        $this->db->query('
                UPDATE DOSEN D 
                SET PEMBIMBING = 0
                WHERE NOT EXISTS(
                    SELECT *
                    FROM
                        KELOMPOK_KP K
                    WHERE K.NIP_DSN=D.NIP_DSN
                ) 
        ');
    }
    
    public function updatePass($password){
        $data=array(          
            'PASSWORD'=>sha1($password)
          );
        $this->db->where('NIP_DSN',$this->session->userdata('nipDsn'));
        $this->db->update('DOSEN', $data);
    }
    
    public function setPenguji($nip,$tipe){
        $data=array(          
            'PENGUJI'=>($tipe=='reset')?0:1
          );
        $this->db->where('NIP_DSN', $nip);
        $this->db->update('DOSEN', $data); 
    }
    
    public function getNotPenguji(){
            $query = $this->db->query('
                SELECT * 
                FROM
                    DOSEN D
                WHERE NOT EXISTS(
                    SELECT *
                    FROM
                        DETAIL_DOSEN_SEMINAR DDS, DOSEN
                    WHERE DDS.NIP_DSN=DOSEN.NIP_DSN
                ) AND D.KOORDINATOR = 0

        ');
        return $query->result();
    }
}
?>
