<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembimbing extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('kp');
        $this->load->model('detail_mhs');
        $this->load->model('member');
        $this->load->model('bimbingan');
        $this->load->model('catatan_bimbingan');
        $this->load->model('detail_dosen_seminar');
        $this->load->model('nilai_klp');
    }
    
    public function cek_session()
    { 
        if($this->session->userdata('username'))
        {   
            return TRUE;
        }
        else {
            redirect(base_url().'page/home');
        }
    }
    
    public function index()
    {
        $this->cek_session();
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
   
    function insert($page){
        if($page == 'bimbingan'){
            $dateNow = str_replace("-","/",date("m-d-Y H:i:s"));
            $this->bimbingan->addBimbing($dateNow);
            //echo $dateNow.' '.$this->bimbingan->getIdBimbinganNew();
            //die();
            if($this->input->post('catatan') or $this->input->post('final_project')){
                $idbimbing = $this->bimbingan->getIdBimbing($dateNow);
                //$idbimbing = $this->bimbingan->getIdBimbinganNew();
                $this->catatan_bimbingan->addCttnBimbing('klp',$idbimbing);
            }
       }
       else if($page == 'catatanBimbingan'){
           if($this->input->post('catatan')){
                $this->catatan_bimbingan->addCttnBimbing('dsn');
           }
        }
        $idklp = $this->session->userdata('idklp');
        $this->session->set_userdata(array('idklp'=>''));
        redirect(base_url().'pembimbing/show_bimbingan/KLP'.$idklp);
    }
    
    function update($page){
        if($page == 'nilai'){
            $this->nilai_klp->updateNilaiPembimbing();
            $idklp = $this->input->post('idklp');
            
            $nilai = $this->nilai_klp->getAllNilai($idklp);
            $nilaiPenguji1 = $nilai->NILAI_AKHIR_PENGUJI1;
            $nilaiPenguji2 = $nilai->NILAI_AKHIR_PENGUJI2; 
            $nilaiPembimbing = $nilai->NILAI_AKHIR_PEMBIMBING;
            $this->nilai_klp->updateTotalNilai($nilaiPenguji1, $nilaiPenguji2, $nilaiPembimbing,$idklp);
        }
        redirect(base_url().'pembimbing/show/seminar');
    }
    
    //show page
    public function show($page){
        $this->cek_session();
        if($page == 'beranda'){
            $data['dosbing'] = $this->kp->getDataPembimbing();
            $data['dtlmhs'] = $this->detail_mhs->getData();
            $data['jmlbbg'] = $this->bimbingan->getJumlahBimbing();
        }
        else if($page == 'seminar'){
            $data['smr'] =  $this->detail_dosen_seminar->getAllDataPembimbing();
            $data['dtlmhs'] = $this->detail_mhs->getData();
            $data['nklp'] = $this->nilai_klp->tampil();
        }
        else if($page == 'dokumen'){
            $data['klp'] = $this->kp->getDataPembimbing();
        }
        $data['username'] =  $this->session->userdata('username');
        $data['nipDsn'] = $this->session->userdata('nipDsn');
        $data['jenis'] = $this->session->userdata('jenis');
        $this->load->view('template/header');
        $this->load->view('pembimbing/'.$page,$data);
        $this->load->view('template/footer');
    }
    
    public function show_bimbingan($idklp){
        $data['username'] =  $this->session->userdata('username');
        $data['idklp']=substr($idklp,3);
        $this->session->set_userdata(array('idklp'=>$data['idklp']));
        $data['bbg'] = $this->bimbingan->getBbg($data['idklp']);
        $data['cttn'] = $this->catatan_bimbingan->getCttn();
        //echo '<script>alert("'.$this->session->userdata('idklp').'")</script>';
        $this->load->view('template/header');
        $this->load->view('pembimbing/bimbingan_online',$data);
        $this->load->view('template/footer');
    }
    
    public function validasi(){
        $type=$this->input->post('type');
        if($type=="bimbingan"){
            $data['idklp']=$this->input->post('idklp');
            $this->load->view('pembimbing/verifikasiProposal',$data);
        }
        else if($type=="nilai"){
            $data['idklp'] = $this->input->post('idklp');
            $data['nklp']  = $this->nilai_klp->getNilai($data['idklp']);
            $this->load->view('pembimbing/form_nilai_pembimbing',$data);
        }
    }
}