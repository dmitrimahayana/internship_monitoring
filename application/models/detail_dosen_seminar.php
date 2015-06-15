<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Detail_dosen_seminar extends CI_Model {
    //fungsi untuk tampilkan data member
    public function tampil(){
        $query=$this->db->get('DETAIL_DOSEN_SEMINAR');
        return $query->result();
    }
    
    public function getDataKlp(){
        $query = $this->db->query('
            SELECT DISTINCT R.NAMA_RUANGAN, P.PERIODE, JS.TANGGAL, JS.JAM, DDS.ID_KLP   
            FROM
                JADWAL_SEMINAR JS,PERIODE P,RUANGAN R,DETAIL_DOSEN_SEMINAR DDS
            WHERE
                JS.ID_RUANG = R.ID_RUANG AND 
                JS.ID_PERIODE = P.ID_PERIODE AND
                DDS.ID_JADWAL = JS.ID_JADWAL AND
                DDS.ID_KLP = '.$this->session->userdata('username')
        );
        return ($query->num_rows()>0)?$query->row():'';
        
    }
    
    public function getAllData(){
        $query = $this->db->query('
            SELECT DISTINCT `JS`.`ID_JADWAL`, `JS`.`ID_PERIODE`, `JS`.`ID_RUANG`,
`JS`.`JAM`, `JS`.`TANGGAL`, `P`.`PERIODE`, `P`.`TAHUN`, 
`R`.`NAMA_RUANGAN`, `NKLP`.`ID_KLP`, `NKLP`.`NILAI_AKHIR_PENGUJI1`, `NKLP`.`NILAI_AKHIR_PENGUJI2`, `DDS`.`JENIS_DOSEN`
            FROM
                JADWAL_SEMINAR JS,PERIODE P,RUANGAN R,DETAIL_DOSEN_SEMINAR DDS,NILAI_KLP NKLP
            WHERE
                JS.ID_RUANG = R.ID_RUANG AND 
                JS.ID_PERIODE = P.ID_PERIODE AND
                DDS.ID_JADWAL = JS.ID_JADWAL AND
                DDS.NIP_DSN = '.$this->session->userdata('nipDsn').' AND
                DDS.ID_KLP = NKLP.ID_KLP'
        );
        return $query->result();
    }
    
    public function getAllDataPembimbing(){
         $query = $this->db->query('
            SELECT DISTINCT R.NAMA_RUANGAN, P.PERIODE, JS.TANGGAL, JS.JAM, DDS.ID_KLP, NK.NILAI_AKHIR_PEMBIMBING   
            FROM
                JADWAL_SEMINAR JS,PERIODE P,RUANGAN R,DETAIL_DOSEN_SEMINAR DDS,KELOMPOK_KP KP, NIlAI_KLP Nk
            WHERE
                JS.ID_RUANG = R.ID_RUANG AND 
                JS.ID_PERIODE = P.ID_PERIODE AND
                DDS.ID_JADWAL = JS.ID_JADWAL AND
                DDS.ID_KLP = KP.ID_KLP AND 
                NK.ID_KLP = KP.ID_KLP AND
                KP.NIP_DSN = '.$this->session->userdata('nipDsn')
                
        );
        return $query->result();
    }
    
    public function getPeriode(){
        $this->db->select('*');
        $this->db->distinct();
        $this->db->from('DETAIL_DOSEN_SEMINAR');
        $this->db->join('JADWAL_SEMINAR', 'DETAIL_DOSEN_SEMINAR.ID_JADWAL = JADWAL_SEMINAR.ID_JADWAL');
        $this->db->join('RUANGAN', 'JADWAL_SEMINAR.ID_RUANG = RUANGAN.ID_RUANG');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = JADWAL_SEMINAR.ID_PERIODE');
        return $this->db->get()->result();
    }
    
    public function getData(){
        $this->db->select('*');
        $this->db->from('DETAIL_DOSEN_SEMINAR');
        $this->db->join('JADWAL_SEMINAR', 'DETAIL_DOSEN_SEMINAR.ID_JADWAL = JADWAL_SEMINAR.ID_JADWAL');
        $this->db->join('DOSEN', 'DETAIL_DOSEN_SEMINAR.NIP_DSN = DOSEN.NIP_DSN');
        $this->db->join('RUANGAN', 'JADWAL_SEMINAR.ID_RUANG = RUANGAN.ID_RUANG');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = JADWAL_SEMINAR.ID_PERIODE');
        $this->db->order_by('DETAIL_DOSEN_SEMINAR.ID_DETAIL_SEMINAR', 'ASC');
        //$this->db->order_by('PERIODE.ID_PERIODE','ASC');
        
        return $this->db->get()->result();
    }
    
    public function getDataMhs(){
        $this->db->select('*');
        $this->db->from('DETAIL_MHS');
        $this->db->join('MAHASISWA', 'DETAIL_MHS.NRP = MAHASISWA.NRP');
        return $this->db->get()->result();
    }
    
    public function getJadwal(){
        $this->db->distinct('ID_JADWAL');
        $query = $this->db->get('DETAIL_DOSEN_SEMINAR');
        return $query->result();
    }
    
    public function getDosen($idsmr,$jenis){
        $this->db->select("*");
        $this->db->from("DETAIL_DOSEN_SEMINAR");
        $this->db->where('ID_DETAIL_SEMINAR', $idsmr);
        $this->db->where('JENIS_DOSEN',$jenis);

        $query = $this->db->get();
        return $query->row();
    }
    
    public function getPenguji1($idjadwal){
         
        $this->db->select('NIP_DSN');
        $this->db->distinct();
        $this->db->from('DETAIL_DOSEN_SEMINAR');
        $this->db->where('ID_JADWAL',$idjadwal);
        $this->db->where('JENIS_DOSEN','Penguji1');
        $query = $this->db->get();
        //  if($query->num_rows()<1)return '';
        return $query->row()->NIP_DSN;
    }
    
    public function getPenguji2($idjadwal){
        $this->db->select("NIP_DSN");
        $this->db->distinct();
        $this->db->from('DETAIL_DOSEN_SEMINAR');
        $this->db->where('ID_JADWAL',$idjadwal);
        $this->db->where('JENIS_DOSEN','Penguji2');
        $query = $this->db->get();
        return $query->row()->NIP_DSN;
    }
    
    //fungsi menambah member
    public function addDtlDosen($idjadwal){
        $data1=array(
                    'NIP_DSN'=>$this->input->post('penguji1'),
                    'ID_JADWAL'=>$idjadwal,
                    'JENIS_DOSEN'=>'Penguji1'
                );
        $this->db->insert('DETAIL_DOSEN_SEMINAR',$data1);
        
        $data2=array(
                    'NIP_DSN'=>$this->input->post('penguji2'),
                    'ID_JADWAL'=>$idjadwal,
                    'JENIS_DOSEN'=>'Penguji2'
                );
        $this->db->insert('DETAIL_DOSEN_SEMINAR',$data2); 
    }
    
    public function addCopyDtlDosen($idjadwal,$penguji1,$penguji2){
        $data1=array(
                    'NIP_DSN'=>$penguji1,
                    'ID_JADWAL'=>$idjadwal,
                    'JENIS_DOSEN'=>'Penguji1'
                );
        $this->db->insert('DETAIL_DOSEN_SEMINAR',$data1);
        
        $data2=array(
                    'NIP_DSN'=>$penguji2,
                    'ID_JADWAL'=>$idjadwal,
                    'JENIS_DOSEN'=>'Penguji2'
                );
        $this->db->insert('DETAIL_DOSEN_SEMINAR',$data2); 
    }
    
    public function deleteDtlDsn(){
         $table = 'DETAIL_DOSEN_SEMINAR';
         $idjadwal = $this->input->post('idjadwal'); 
         $this->db->where('ID_JADWAL', $idjadwal);
         $this->db->delete($table); 
         
         $table = 'JADWAL_SEMINAR';
         $this->db->where('ID_JADWAL', $idjadwal);
         $this->db->delete($table);
    }
    
    public function updatePenguji(){
        $this->db->query('
            UPDATE DOSEN DSN
            SET PENGUJI = 1
            WHERE EXISTS (
                SELECT DISTINCT NIP_DSN
                FROM DETAIL_DOSEN_SEMINAR SMR
                WHERE SMR.NIP_DSN = DSN.NIP_DSN
                )
            ');
        $this->db->query('
            UPDATE DOSEN DSN
            SET PENGUJI = 0
            WHERE NOT EXISTS (
                SELECT DISTINCT NIP_DSN
                FROM DETAIL_DOSEN_SEMINAR SMR
                WHERE SMR.NIP_DSN = DSN.NIP_DSN
                )
            ');
    }
    
   public function updateDtlDosen($jenis){
        $temp = explode(',',$this->input->post('idjadwal'));
        $id = ($jenis=='Penguji1')?$temp[0]:$temp[1];
        
        $data=array(          
            'NIP_DSN'=>$this->input->post($jenis)
          );
        
        $this->db->where('ID_DETAIL_SEMINAR', $id);
        $this->db->where('JENIS_DOSEN', $jenis);
        $this->db->update('DETAIL_DOSEN_SEMINAR', $data); 
    }
    
    public function getPeriodeJadwal(){
        $query = $this->db->query('
        SELECT DISTINCT ID_PERIODE,DDS.ID_JADWAL 
        FROM DETAIL_DOSEN_SEMINAR DDS,JADWAL_SEMINAR JS
        WHERE DDS.ID_JADWAL = JS.ID_JADWAL
        ');
        return $query->result();
    }
    
    public function updateKLP($idklp,$id){
        
            $this->db->start_cache();
            $this->db->select('*');
            $this->db->from('DETAIL_DOSEN_SEMINAR');
            $this->db->where('ID_JADWAL', $id);
            $this->db->where('ID_KLP IS NULL');
            $query = $this->db->get();
            $this->db->stop_cache();
            $this->db->flush_cache();
            if($query->num_rows()<1){
                return false;
            }
            
            $data=array(          
                'ID_KLP'=>$idklp
              );
            $this->db->where('ID_JADWAL', $id);
            $this->db->where('ID_KLP IS NULL');
            $this->db->update('DETAIL_DOSEN_SEMINAR', $data); 
            return true;
    }
    
     public function getIdjadwal($idklp){
        $query = $this->db->query('
                SELECT DISTINCT DDS.ID_JADWAL
                FROM 
                  DETAIL_DOSEN_SEMINAR DDS, KELOMPOK_KP K, JADWAL_SEMINAR JS
                WHERE 
                  JS.ID_JADWAL = DDS.ID_JADWAL AND
                  JS.ID_PERIODE = K.ID_PERIODE AND
                  K.ID_KLP = '.$idklp
        );
        return $query->row()->ID_JADWAL;
     }
     
     public function isExist(){
         $query = $this->db->query('
               SELECT DISTINCT DDS.ID_KLP
               FROM
                    DETAIL_DOSEN_SEMINAR DDS, KELOMPOK_KP KP
               WHERE
                    DDS.ID_KLP = KP.ID_KLP'
        );
        return $query->result();
     }
}
?>