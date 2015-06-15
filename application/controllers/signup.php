<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('member');
        $this->load->model('periode');
        $this->load->model('kp');
        $this->load->model('detail_mhs');
        $this->load->model('nilai_klp');
        $this->load->model('project');
    }
    
    public function cek_session()
    { 
        if($this->session->userdata('logged_in'))
        {   
            return TRUE;
        }
        else {
            redirect(base_url().'page/home');
        }
    }
    
    public function index()
    {
        $data['mhs'] = $this->member->getData();
        $data['prd'] = $this->periode->tampil();
        $this->load->view('template/header');
        $this->load->view('signup',$data);
        $this->load->view('template/footer');
    }

    //fungsi search
    function search(){
        //untuk  validasi
        $this->load->view('template/header');
       
        $this->load->view('template/footer');
    }
    
    function insert(){
        if($this->input->post('password') == '')redirect(base_url()."signup");
        $pieces1 = explode(",", $this->input->post('memberValue'));
        
        $this->kp->addKP();
        $idklp = $this->kp->getCurrIdKp();
        $this->nilai_klp->addNilaiKlp($idklp);
        $this->project->addProject($idklp);
        foreach ($pieces1 as $temp){
            $pieces2 = explode("+", $temp);
            $this->detail_mhs->addDTL($pieces2[1],$idklp);
        }
        
        $data['idklp']=$idklp;
        $data['password']=$this->input->post('password');
        $this->success($data);
    }
    
    function success($data){
        $pieces1 = explode(",", $this->input->post('memberValue'));
        $dummy=array();
        $i=0;
        foreach ($pieces1 as $temp){
            $pieces2 = explode("+", $temp);
            //echo $pieces2[1].' '.$pieces2[2].'<br/>';
            $dummy[$i]=$pieces2[1];
            $dummy[$i+1]=$pieces2[2];
            //echo $dummy[$i].' '.$dummy[$i+1].'<br/>';
            $i+=2;
        }
        $data['members']=$dummy;
        $this->load->view('success',$data);
    }
}