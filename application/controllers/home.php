<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('detail_mhs');
        $this->load->model('kp');
        $this->load->model('member');
        $this->load->model('dosen');
    }
    
    public function view($page){
        $this->load->view('template/header');
        $this->load->view($page);
        $this->load->view('template/footer');
    }
    
    public function cek_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if( strtoupper(substr($username,0,3))=="KLP"){
            $login = $this->kp->login( substr($username,3), $password );
            if($login){
                $sess_array=array(
                        'username'=>    substr($username,3)
                    );
                $this->session->set_userdata($sess_array);
                redirect(base_url().'mhs/show/beranda');
            }
            else {
                $this->session->set_userdata(array('error'=>'Username atau Password salah'));
                redirect(base_url());
            }  
        }
        else if(is_numeric($username)){ 
            $login = $this->dosen->login($username, $password);
            
            if($login){
                $this->session->set_userdata(array(
                        'username'=>    $login->NAMA_DSN,
                        'nipDsn'=>      $login->NIP_DSN
                    )); 
                if($login->KOORDINATOR){
                    $this->session->set_userdata(array(
                        'jenis'=> 'koor'
                    ));
                    redirect(base_url().'koor/show/beranda');
                }
                else if($login->PEMBIMBING){
                    $this->session->set_userdata(array(
                        'jenis'=> 'pembimbing'
                    ));
                    redirect(base_url().'pembimbing/show/beranda');
                }
                else if($login->PENGUJI){
                    $this->session->set_userdata(array(
                        'jenis'=> 'penguji'
                    ));
                    redirect(base_url().'penguji/show/beranda');
                }
            } 
            else {
                $this->session->set_userdata(array('error'=>'Username atau Password salah'));
                redirect(base_url());
            }
        }
        else {
                $this->session->set_userdata(array('error'=>'Username atau Password salah'));
                redirect(base_url());
            }   
    }
    
    public function UpdatePassword($idUser){
        $data['ID']=$idUser;
        $data['username'] = $this->session->userdata('username');
        if( $this->session->userdata('nipDsn') ){
            $data['nipDsn'] = $this->session->userdata('nipDsn');
            $data['jenis'] = $this->session->userdata('jenis');
        }
        $this->load->view('template/header');
        $this->load->view('updatePassword',$data);
        $this->load->view('template/footer');
    }
    
    public function getNewPassword(){
        if($this->input->post('nomor_induk')){
            $data['ID']=  $this->input->post('nomor_induk');
        }
        $data['nama_User']=  $this->input->post('nama_user');
        
        if($this->input->post('nomor_induk')){
        $confirm = $this->dosen->login($data['ID'], $this->input->post('password_lama'));
        }else{
        $confirm = $this->kp->login(substr($data['nama_User'],3), $this->input->post('password_lama'));
        }
        
        
        if($confirm and $this->input->post('password_baru')==$this->input->post('konfirmasi_password')){
            $data['new_Pass']=$this->input->post('password_baru');
            if($this->input->post('nomor_induk')){
                $this->dosen->updatePass($data['new_Pass']);
                $data['nipDsn'] = $this->session->userdata('nipDsn');
                $data['jenis'] = $this->session->userdata('jenis');
            }else{
                $this->kp->updatePass($data['new_Pass']);
            }
            $data['username'] =  $this->session->userdata('username');
            
            $this->load->view('template/header');
            $this->load->view('successUpdatePassword',$data);
            $this->load->view('template/footer');
        }else{
            redirect(base_url().'home/UpdatePassword/'.((isset($data['ID']))?$data['ID']:$data['nama_user']) );
        }
    }
    
    public function getNrpFromPendidikan(){
        $jenjangPendidikan=$this->input->post('input');
        //echo $jenjangPendidikan;
        //die();
        if($jenjangPendidikan=="D3"){
            /*query D3 disini*/
            $syaratTahun = $this->member->getSyarat();
            //echo '<script>alert("'.$syaratTahun.'");</script>';
            $data['mhs'] = $this->member->getJenjangD3($syaratTahun);
        }
        else if($jenjangPendidikan=="D4"){
            /*query D4 disini*/
            $syaratTahun = $this->member->getSyarat();
            $data['mhs'] = $this->member->getJenjangD4($syaratTahun);
        }
        $this->load->view('memberFilter',$data);
    }
}    
?>