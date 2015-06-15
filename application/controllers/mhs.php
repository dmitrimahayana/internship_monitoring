<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhs extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('kp');
        $this->load->model('perusahaan');
        $this->load->model('member');
        $this->load->model('catatan_bimbingan');
        $this->load->model('bimbingan');
        $this->load->model('detail_dosen_seminar');
        $this->load->model('dosen');
        $this->load->model('nilai_mhs_perusahaan');
        $this->load->model('nilai_klp');
        $this->load->model('project');
    }
    
    public function cek_session()
    { 
        if($this->session->userdata('username') and !$this->session->userdata('nipDsn'))
        {   
            return TRUE;
        }
        else {
            redirect(base_url());
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
   function update($page){
       //$this->session->set_userdata(array('test'=>$this->input->post('idklp')));
       if($page == 'project'){
            $this->uploadProject();
            $namaProject = $this->input->post('nama_final_project');
            if($namaProject)$this->project->updateProject('',$namaProject,'');
            $page = 'dokumen';
       }
       else if($page == 'kp'){
            $this->uploadProposal();
            $dateNow = str_replace("-","/",date("m-d-Y"));
            $this->kp->updatePrsh($dateNow);
            $page = 'upload_proposal';
       }
       else if($page == 'dosenLapangan'){
           $this->kp->updateDosenLap();
           $page = 'beranda';
       }
       redirect(base_url().'mhs/show/'.$page);
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
                $this->catatan_bimbingan->addCttnBimbing('klp');
           }
       }
       redirect(base_url().'mhs/show/bimbingan_online');
   }
   
    //show page
    public function show($page){
        $this->cek_session();
        $idklp = $this->session->userdata('username');
        if($page == 'upload_proposal'){
            $data['prs'] = $this->perusahaan->tampil();
            
            $data['klp'] = $this->kp->getDataKlp($idklp);
            if(!$data['klp'])$data['klp'] = $this->kp->getPeriode($idklp);
            
        }
        else if($page == 'bimbingan_online'){
            $data['bbg'] = $this->bimbingan->getBbg($idklp);
            $data['cttn'] = $this->catatan_bimbingan->getCttn();
        }
        else if($page == 'beranda'){
            $data['nklp'] = $this->nilai_klp->getNilai($idklp);
            $data['jwl'] = $this->detail_dosen_seminar->getDataKlp();
            $data['klp'] = $this->kp->getAllDataKlp($idklp);
            if(!$data['klp']) $data['klp'] = $this->kp->getDataKlp($idklp);
        }
        else if($page == 'nilai'){
            //NILAI KELOMPOK
            $data['nmp'] = $this->nilai_mhs_perusahaan->getNilaiKlp($idklp);
            $data['nklp'] = $this->nilai_klp->getNilai($idklp);
        }
        $data['username'] =  $idklp;
        //echo '<script>alert("'.$this->session->userdata('test').'")</script>';
        $this->load->view('template/header');
        $this->load->view('mhs/'.$page, $data);
        $this->load->view('template/footer');
    }
    
    public function validasi(){
        $type=$this->input->post('type');
        if($type=="dosenLapangan"){
            $data['idklp']=$this->input->post('idklp'); 
            $data['klp'] = $this->kp->getKLP( $data['idklp'] );
            $this->load->view('mhs/updateDosenLapangan',$data);
        }
    }
    
    public function uploadProposal(){
            //$temp = explode('.',$this->input->post('proposal_KP'));
            //$type = $temp[1];//$temp[count($temp)-1];
            //$newName1='KLP'.$this->session->userdata('username').'_Proposal.'.$type;
            $config['upload_path'] = './files/proposal/';
            $config['overwrite'] = TRUE;    
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['remove_spaces']  = TRUE;
            $config['max_size']	= '500';
            //$config['file_name'] = $newName1;
            
            //$this->session->set_userdata(array('test'=>$this->input->post('proposal_KP')));
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($_FILES['proposal_KP']['name']){
                
                if (!$this->upload->do_upload('proposal_KP'))
                {
                    //echo 'namafile gagal'.$_FILES['proposal_KP']['name'];
                    //$this->countError+=1;
                    //$this->count2[]=array('index'=>1);
                    echo $this->upload->display_errors('', '');
                    //$this->show('upload_proposal');
                }    
                else
                {
                    
                    $data1=$this->upload->data();
                    //$img=$url.'images/dataPeserta/'.$data1['file_name'];
                    $this->kp->updateProposal($data1['file_name']);
                }
            }
            //$this->berandaUser();
            //redirect(base_url().'mhs/show/upload_proposal');
    }
    
    public function uploadProject(){
            //$temp = explode('.',$this->input->post('proposal_KP'));
            //$type = $temp[1];//$temp[count($temp)-1];
            //$newName1='KLP'.$this->session->userdata('username').'_Proposal.'.$type;
            $config['upload_path'] = './files/project/';
            $config['overwrite'] = TRUE;    
            $config['allowed_types'] = 'pdf|doc|docx|zip|rar';
            $config['remove_spaces']  = TRUE;
            $config['max_size']	= '1000';
            //$config['file_name'] = $newName1;
            
            //$this->session->set_userdata(array('test'=>$this->input->post('proposal_KP')));
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($_FILES['buku_kp']['name']){
                if (!$this->upload->do_upload('buku_kp'))
                {
                    $this->countError+=1;
                    $this->count2[]=array('index'=>1);
                }    
                else
                {
                    $data1=$this->upload->data();
                    //$img=$url.'images/dataPeserta/'.$data1['file_name'];
                    $this->project->updateProject($data1['file_name'],'','');
                }
            }
            
            if($_FILES['final_project']['name']){
                if (!$this->upload->do_upload('final_project'))
                {
                    $this->countError+=1;
                    $this->count2[]=array('index'=>1);
                    $this->session->set_userdata(array('error' => $this->upload->display_errors()));
                    
                    //redirect(base_url());
                }    
                else
                {
                    $data1=$this->upload->data();
                    //$img=$url.'images/dataPeserta/'.$data1['file_name'];
                    $this->project->updateProject('','',$data1['file_name']);
                }
            }
            $this->error=$this->upload->display_errors('', '');
    }
}