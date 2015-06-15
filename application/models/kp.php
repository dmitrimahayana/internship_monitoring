<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kp extends CI_Model {
    //fungsi login
    public function login($idklp,$password){
        $this->db->select('*');
        $this->db->from('KELOMPOK_KP');
        
        $this->db->where('ID_KLP', $idklp);
        $this->db->where('PASSWORD',sha1($password));
    
        $query = $this->db->get();
        return $query->result();
    }

    //fungsi untuk tampilkan data member
    public function tampil(){
         $this->db->select('*');
         $this->db->from('KELOMPOK_KP');
         $this->db->order_by('ID_KLP', 'ASC');
         $query=$this->db->get();
        return $query->result();
    }
    
    public function count(){
        return  $this->db->count_all('KELOMPOK_KP');
    }
    
    public function last(){
         $this->db->select('ID_KLP');
         $this->db->from('KELOMPOK_KP');
         $this->db->order_by('ID_KLP', 'ASC');
         $query=$this->db->get();
         return $query->last_row();
    }
    
    public function getSyaratKlp(){
        $query = $this->db->query('
                SELECT 
                    DISTINCT KP.ID_KLP,PH.NAMA_PERUSAHAAN,PR.PERIODE,
                    JB.JUMLAH,P.FINAL_UPLOAD_PROJECT AS FP
                FROM
                    KELOMPOK_KP KP, PERIODE PR, PERUSAHAAN PH,
                    (
                        SELECT ID_KLP,COUNT(ID_KLP) AS JUMLAH
                        FROM 
                          BIMBINGAN
                        GROUP BY ID_KLP
                    ) JB,
                    NILAI_MHS_PERUSAHAAN NMP, PROJECT P
                WHERE
                    KP.ID_PERIODE = PR.ID_PERIODE AND
                    KP.ID_PERUSAHAAN = PH.ID_PERUSAHAAN AND
                    KP.ID_KLP = JB.ID_KLP AND
                    KP.ID_KLP = P.ID_KLP
         ');
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
        $this->db->where('KELOMPOK_KP.ID_PERUSAHAAN IS NOT NULL');
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
        //$this->db->select('*');
        $this->db->select('`KELOMPOK_KP`.`ID_KLP`, `perusahaan`.`NAMA_PERUSAHAAN` ,`PERIODE`.`PERIODE`, `PERIODE`.`TAHUN`, `kelompok_kp`.`ID_KLP`, `project`.`NAMA_PROJECT`, `project`.`FINAL_UPLOAD_PROJECT`, `project`.`BUKU_KP`, `project`.`TGL_UPLOAD_PROJECT`');
        $this->db->distinct();
        $this->db->from('KELOMPOK_KP');
        $this->db->where('NIP_DSN',$nip);
        $this->db->join('PERUSAHAAN', 'PERUSAHAAN.ID_PERUSAHAAN = KELOMPOK_KP.ID_PERUSAHAAN');
        $this->db->join('PERIODE', 'PERIODE.ID_PERIODE = KELOMPOK_KP.ID_PERIODE');
        $this->db->join('PROJECT','PROJECT.ID_KLP = KELOMPOK_KP.ID_KLP');
        $this->db->order_by('KELOMPOK_KP.ID_KLP', 'ASC');
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
    
    //fungsi menambah member
    public function addKP(){
        $data1=array(
            'PASSWORD'=>sha1($this->input->post('password')),
            'ID_PERIODE'=>$this->input->post('periode_kp')
            );
        $this->db->insert('KELOMPOK_KP',$data1);
        
        /*$query = $this->db->query('
                    SELECT 
                        KP_SEQ.CURRVAL
                    FROM 
                        DUAL
            ');
        return $query->row()->CURRVAL;
         */
        
    }
    
    public function getCurrIdKp(){
        $query = $this->db->query('
                    SELECT `ID_KLP` FROM `kelompok_kp` LIMIT 1
            ');
        return $query->row()->ID_KLP;   
    }

    public function updatePass($password){
         $data=array(          
            'PASSWORD'=>sha1($password)
          );
        $this->db->where('ID_KLP',$this->session->userdata('username'));
        $this->db->update('KELOMPOK_KP', $data);
    }
    
    public function updateKlp($jenis){if($this->input->post('Approve')){
            $id = $this->input->post('Approve');
            $verifikasi = 'Approve';
            $pembimbing = $this->input->post('pembimbing');
        }
        else{
            $id = $this->input->post('Reject');
            $verifikasi = 'Reject';
            
        }
        if($jenis=='proposal'){
        $data=array(          
            'SETUJU_DOSEN'=>$verifikasi,
            'CATATAN_PROPOSAL'=>($this->input->post('catatanProposal')) ? $this->input->post('catatanProposal'):''
          );
        }else if($jenis=='perusahaan'){
        $data=array(          
            'SETUJU_PERUSAHAAN'=>$verifikasi,
            'NIP_DSN'=>(isset($pembimbing)?$pembimbing:null),
            'CATATAN_PERUSAHAAN'=>($this->input->post('catatanPerusahaan')) ? $this->input->post('catatanPerusahaan'):''
          );
        }
        $this->db->where('ID_KLP', $id);
        $this->db->update('KELOMPOK_KP', $data); 
     }
    
    public function updatePrsh($date){
        $id = $this->input->post('idklp');
        $perusahaan = explode('+',$this->input->post('perusahaan'));
        $data=array(          
            'ID_PERUSAHAAN'=>$perusahaan[0],
            'TGL_UPLOAD_PROPOSAL'=>$date
          );
        $this->db->where('ID_KLP', $id);
        $this->db->update('KELOMPOK_KP', $data); 
    }
    
    public function updateDosenLap(){
        $id = $this->input->post('idklp');
        $data=array(          
            'NAMA_DSN_LAPANGAN'=>$this->input->post('nama')
          );
        $this->db->where('ID_KLP', $id);
        $this->db->update('KELOMPOK_KP', $data); 
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