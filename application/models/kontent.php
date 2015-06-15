<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class kontent extends CI_Model {
    
    public function getKontent($member,$type){
        $this->db->select('*');
        $this->db->from('kontent_page');    
        $this->db->where('ID_Member', $member); 
        $this->db->where('type', $type);       
        $query = $this->db->get();
        return $query->result();
    }
    
   //untuk insert kontent
    public function insertKontent($type,$member){
       $data=array(
        'ID_Member'=>$member,
        'type'=>$type
        );
        $this->db->insert('kontent_page',$data);
    }
    
    //fungsi untuk update
    public function updatekontent($tabel,$data,$id,$field_id,$id2,$field_id2)
    {
        $this->db->where($field_id, $id);
        $this->db->where($field_id2, $id2);
        $this->db->update($tabel, $data); 
    }
    
    //fungsi untuk update data fasilitas
    public function updateDatafas(){
        $session_data = $this->session->userdata('logged_in');       
          $idmem=$session_data['ID_Member'];

          $data_class=array(          
          'kontent'=>$this->input->post('kontent'),  
          );
          $this->updatekontent('kontent_page',$data_class,$idmem,'ID_Member',"fasilitas","type");
    }
      
    //fungsi untuk updatee data home
    public function updateDatahome(){
        $session_data = $this->session->userdata('logged_in');       
        $idmem=$session_data['ID_Member'];
        $data_class=array(          
        'kontent'=>$this->input->post('kontent'),  
        );
        $this->updatekontent('kontent_page',$data_class,$idmem,'ID_Member',"home","type");
    }
}

?>
