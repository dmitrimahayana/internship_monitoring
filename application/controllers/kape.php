<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhs extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('kp');
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
        $this->load->view('template/header');
        $this->load->view('home');
        $this->load->view('template/footer');
    }

    //fungsi search
    function search(){
        //untuk  validasi
        $this->load->view('template/header');
       
        $this->load->view('template/footer');
    }
   
    //show page
    public function show($page){
        $this->load->view('template/header');
        $this->load->view('mhs/'.$page);
        $this->load->view('template/footer');
    }
}