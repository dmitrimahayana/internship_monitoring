<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
        $this->db->select('*');
        $this->db->from('MAHASISWA');
        $this->db->order_by('NRP','ASC');
        $query=$this->db->get();
        return $query->result();
    }
    
    public function getSyarat(){
        $query = $this->db->query('
              SELECT MAX(a.TAHUN)-1 AS BARU              
              FROM(
              SELECT DISTINCT 
                    CASE WHEN SUBSTR(NRP,0,1)=7
                    THEN
                      SUBSTR(NRP,3,2)
                    ELSE
                      SUBSTR(NRP,5,2)
                    END
                    AS TAHUN
              FROM MAHASISWA
              ) a
        ');
        return $query->row()->BARU;
    }
    
    public function getJenjangD4($syaratTahun){
        $query = $this->db->query('
            SELECT *
            FROM(
              SELECT NRP,NAMA_MHS, 
                CASE WHEN SUBSTR(NRP,0,1)=7
                THEN
                  CASE WHEN SUBSTR(NRP,6,1)=4
                  THEN \'D4\'
                  WHEN substr(NRP,6,1)=3
                  THEN \'D3\'
                  END 
                ELSE
                   CASE WHEN substr(NRP,4,1)=3
                   THEN \'D3\'
                   ELSE \'D4\'
                   END 
                END
                AS JENJANG,
                CASE WHEN SUBSTR(NRP,0,1)=7
                  THEN
                    SUBSTR(NRP,3,2)
                  ELSE
                    SUBSTR(NRP,5,2)
                  END
                  AS TAHUN
              FROM MAHASISWA
            )a
            WHERE a.JENJANG = \'D4\' AND 
            a.TAHUN <= '.$syaratTahun
        );
        return $query->result();
    }
    
    public function getJenjangD3($syaratTahun){
        $query = $this->db->query('
            SELECT *
            FROM(
              SELECT NRP,NAMA_MHS, 
                CASE WHEN SUBSTR(NRP,0,1)=7
                THEN
                  CASE WHEN substr(NRP,6,1)=4
                  THEN \'D4\'
                  WHEN substr(NRP,6,1)=3
                  THEN \'D3\'
                  END 
                ELSE
                   CASE WHEN substr(NRP,4,1)=3
                   THEN \'D3\'
                   ELSE \'D4\'
                   END 
                END
                AS JENJANG,
                CASE WHEN SUBSTR(NRP,0,1)=7
                  THEN
                    SUBSTR(NRP,3,2)
                  ELSE
                    SUBSTR(NRP,5,2)
                  END
                  AS TAHUN
              FROM MAHASISWA
            )a
            WHERE a.JENJANG = \'D3\' AND 
            a.TAHUN <= '.$syaratTahun
        );
        return $query->result();
    }
    
    public function getData(){
        $query = $this->db->query('
                SELECT *
                FROM 
                    MAHASISWA M
                WHERE NOT EXISTS(
                    SELECT * 
                    FROM
                        DETAIL_MHS DM
                    WHERE DM.NRP = M.NRP
                )
        ');
        return $query->result();
    }
    
    public function getMhs($nrp){
        $this->db->select("*");
        $this->db->from("MAHASISWA");
        $this->db->where('NRP', $nrp);

        $query = $this->db->get();
        return $query->row();
    }
}
?>
