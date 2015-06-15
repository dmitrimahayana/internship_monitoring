<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
      //  $this->load->library('form_validation');
        $this->load->model('member');
       
    }
    
    //register login
    public function reg_validation()
    {
        //untuk  validasi
        $this->form_validation->set_rules('username','username','trim|required|is_unique[member.username]|xss_clean');
        $this->form_validation->set_rules('email','email','trim|required|is_unique[member.email]|xss_clean|valid_email');

        if($this->form_validation->run()==FALSE){
            $this->load->view('template/header');
            $this->load->view('signup');
            $this->load->view('template/footer');
        }
        else
        {
            $this->member->add_member($data);
            $data=$this->member->getReg($this->input->post('username'));
            $id_mem="";
            foreach ($data as $value) {
                $id_mem=$value->ID_Member;
            };
            $this->classification_model->insertClassification($id_mem);
            $this->kontent->insertKontent("home",$id_mem);
            $this->kontent->insertKontent("fasilitas",$id_mem);
            redirect(base_url().'page/home');
        }
    }
    
    function log_validaton()
    {
        
        //untuk  validasi
        $this->form_validation->set_rules('username','username','trim|required|xss_clean|callback_check_regex');
        $this->form_validation->set_rules('password','password','trim|required|xss_clean|callback_check_database|callback_check_regex');

        if($this->form_validation->run()==FALSE){
            //jika gagal
            $this->load->view('template/header');
            $this->load->view('home');
            $this->load->view('template/footer');
        }
        else
        {
            //jika berhasil
            $username= $this->input->post('username');
            $password= $this->input->post('password');
            $result=$this->member->login($username,$password);
            foreach ($result as $row){
                if($row->type =='shipyard'){
                    //echo 'shipyard';
                    $sess_array=array(
                        'type'=> 'shipyard',
                        'username'=>    $row->username,
                        'ID_Member'=>   $row->ID_Member
                    );
                    $this->session->set_userdata('logged_in',$sess_array);
                }
                else if($row->type =='shipping_company'){
                    //echo 'shipping company';
                    $sess_array=array(
                        'type'=> 'shipping_company',
                        'username'=>    $row->username,
                        'ID_Member'=>   $row->ID_Member
                    );
                    $this->session->set_userdata('logged_in',$sess_array);
                }
            }
            redirect(base_url().'page/beranda');
        }
        
    }
    
    public function check_database($password){
      //jika validasi suksesvalidasi dengan database
        $username=  $this->input->post('username');
        
        //query database
        $result=$this->member->login($username,$password);
        
        if($result)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database','invalid username atau password');
            return false;
        }
    }
    
    public function check_regex($str){
        if(preg_match('/[^a-zA-Z0-9 ]/i', $str)){
            $this->form_validation->set_message('check_regex', 'inputan salah atau tidak sesuai');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    public function log_out(){
        $user = $this->session->all_userdata();
        $this->session->unset_userdata($user);
        redirect(base_url().'home/view/home');
    }
}
?>
