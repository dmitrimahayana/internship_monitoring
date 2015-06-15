<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penguji extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('classification_model');
        $this->load->model('kontent');
        $this->load->model('member');
        $this->load->model('detail_dosen_seminar');
        $this->load->model('detail_mhs');
        $this->load->model('nilai_klp');
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
   
    public function update($page){
        if($page == 'nilai'){
            $this->nilai_klp->updateNilaiPenguji();
            $temp = explode(',',$this->input->post('idklp'));
            $idklp = $temp[0];
            $nilai = $this->nilai_klp->getAllNilai($idklp);
            $nilaiPenguji1 = $nilai->NILAI_AKHIR_PENGUJI1;
            $nilaiPenguji2 = $nilai->NILAI_AKHIR_PENGUJI2; 
            $nilaiPembimbing = $nilai->NILAI_AKHIR_PEMBIMBING;
            $this->nilai_klp->updateTotalNilai($nilaiPenguji1, $nilaiPenguji2, $nilaiPembimbing,$idklp);
        }
        redirect(base_url().'penguji/show/beranda');
    }
    //show page
    public function show($page){
        $namadsn = $this->session->userdata('username');
        if($page == 'beranda'){
            $data['smr'] =  $this->detail_dosen_seminar->getAllData();
            $data['dtlmhs'] = $this->detail_mhs->getData();
        }
        $data['username'] =  $namadsn;
        $data['nipDsn'] = $this->session->userdata('nipDsn');
        $data['jenis'] = $this->session->userdata('jenis');
        $this->load->view('template/header');
        $this->load->view('Penguji/'.$page,$data);
        $this->load->view('template/footer');
    }
    
    public function validasi(){
        $type=$this->input->post('type');
        if($type=="nilai"){
            $temp = explode(',',$this->input->post('idklp'));
            $data['idklp'] = $temp[0];
            $data['jenis'] = $temp[1];
            $data['nklp'] = $this->nilai_klp->getNilai($data['idklp']);
            $this->load->view('penguji/form_nilai_penguji',$data);
        }
    }
}