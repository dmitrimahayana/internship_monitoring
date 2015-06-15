<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koor extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('detail_mhs');
        $this->load->model('kp');
        $this->load->model('member');
        $this->load->model('periode');
        $this->load->model('ruangan');
        $this->load->model('jadwal_seminar');
        $this->load->model('detail_dosen_seminar');
        $this->load->model('dosen');
        $this->load->model('perusahaan');
        $this->load->model('nilai_mhs_perusahaan');
    }
    
    public function cek_session()
    { 
        if($this->session->userdata('username') and $this->session->userdata('nipDsn'))
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
    function search($page){
        $this->session->set_userdata( array('cari'=>'') );
        $data['username'] =  $this->session->userdata('username');
        $data['nipDsn'] = $this->session->userdata('nipDsn');
        $data['jenis'] = $this->session->userdata('jenis');
        
        $data['prsh'] = $this->perusahaan-> findPerusahaan();
        if(!$data['prsh'])$this->session->set_userdata( array('cari'=>'Data yang Dicari Tidak Ada') );
        //untuk  validasi
        $this->load->view('template/header');
        $this->load->view('koor/daftarPerusahaan',$data);
        $this->load->view('template/footer');
    }
   
    //show page
    public function show($page){
        $this->cek_session();
//        echo '<script>alert("'.$this->session->userdata('test').'");</script>';
        $this->session->set_userdata(array('test'=>''));
        $namadsn = $this->session->userdata('username');
        if($page == "beranda"){
            $data['klp'] = $this->kp->getData();
            $data['dtl'] = $this->detail_mhs->getDataMhs();
        }
        else if($page == 'daftarPerusahaan'){
            $data['prsh'] = $this->perusahaan->tampil();
        }
        else if($page == 'praSeminar'){
            $temp = $this->detail_dosen_seminar->isExist();
            $arr = array();
            foreach($temp as $ver){
                array_push($arr, $ver->ID_KLP);
            }
            $data['verifikasi'] = $arr;
            $data['nmp'] = $this->nilai_mhs_perusahaan->tampil();
            $data['klp'] = $this->kp->getSyaratKlp();
        }
        else if($page == "listSeminar"){
            $data['prd'] = $this->periode->tampil();
            $data['rng'] = $this->ruangan->tampil();
            $data['dsn'] = $this->dosen->tampil();
            $data['dsnsmr'] = $this->detail_dosen_seminar->getData();
        }
        else if($page == "seminar"){
            $data['dsnsmr'] = $this->detail_dosen_seminar->getData();
            $data['dtlmhs'] = $this->detail_mhs->getData();
            $data['bimbing'] = $this->kp->getPembimbing();
        }
        else if($page == 'nilai'){
           /*Pagination start
            $countRow = $this->nilai_mhs_perusahaan->count();//$this->member->count_find_company($cari);
            
            $config = array();
            $config["base_url"] = base_url().'koor/show/nilai';
            $config["total_rows"] = $countRow;
            $config["per_page"] = 1;//rubah per page nya
            $config["uri_segment"] = 4;
            $config['full_tag_open'] = '<div class="pagination">';
            $config['full_tag_close'] = '</div>';
            $config['next_link'] = 'Next &raquo;';
            $config['prev_link'] = '&laquo; Back';
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';

            $this->pagination->initialize($config);
            $start = ($this->uri->segment(4)) ? $this->uri->segment(4) : '0';
            $data['links'] = $this->pagination->create_links();
            
            $data['prsh']= $this->nilai_mhs_perusahaan->getIdDistinctLimit($start, $config["per_page"]);//$this->member->find_company($cari,$config["per_page"], $page);
            /*pagination end*/
            
            $data['nmp'] = $this->nilai_mhs_perusahaan->getData();
            $data['kp'] = $this->kp->getData();
            $data['prsh'] = $this->nilai_mhs_perusahaan->getIdDistinct();
        }
        $data['username'] =  $namadsn;
        $data['nipDsn'] = $this->session->userdata('nipDsn');
        $data['jenis'] = $this->session->userdata('jenis');
        $this->load->view('template/header');
        $this->load->view('koor/'.$page, $data);
        $this->load->view('template/footer');
    }
    public function insert($page)
    {
        if($page == 'daftarPerusahaan'){
            $this->perusahaan->addPrsh();
        }
        else{
            $this->jadwal_seminar->addJadwal();
            $idjadwal = $this->jadwal_seminar->last();
            $this->detail_dosen_seminar->addDtlDosen($idjadwal->ID_JADWAL);
            $this->detail_dosen_seminar->updatePenguji();
        }
        redirect(base_url()."koor/show/".$page);
    }
    
    public function update($page,$id)
    {
        if($page == 'listSeminar'){
            $temp = explode(',',$this->input->post('idjadwal'));
            $this->session->set_userdata(array('test'=>$temp[0].'-'.$temp[1].'-'.$temp[2]));
            $this->jadwal_seminar->updateJadwal();
            
            $this->detail_dosen_seminar->updateDtlDosen('Penguji1');
            $this->detail_dosen_seminar->updateDtlDosen('Penguji2');
            
            $this->detail_dosen_seminar->updatePenguji();
        }
        else if($page == 'proposal'){
            $this->kp->updateKlp($page);
            $page = 'beranda';
        }
        else if($page == 'daftarPerusahaan'){
            $this->perusahaan->updatePrsh();
            
        }
        else if($page == 'praSeminar'){
            $idjadwal = $this->detail_dosen_seminar->getIdjadwal($id);
            $check = $this->detail_dosen_seminar->updateKLP($id, $idjadwal);
            if(!$check){
                  $penguji1 = $this->detail_dosen_seminar->getPenguji1($idjadwal);
                  $penguji2 = $this->detail_dosen_seminar->getPenguji2($idjadwal);
                  $this->detail_dosen_seminar->addCopyDtlDosen($idjadwal,$penguji1,$penguji2);
                  $this->detail_dosen_seminar->updateKLP($id, $idjadwal);
            }
        }
        else if($page == 'perusahaan'){
            $this->kp->updateKlp($page);
            $this->dosen->updateDsn();
            if($this->input->post('Approve')){
                $idklp = $this->input->post('Approve');
                $idprsh = $this->kp->getIdPrsh($idklp);
                $mhs = $this->detail_mhs->getMhs($idklp);
                foreach($mhs as $mahasiswa){
                    $this->nilai_mhs_perusahaan->addNilaiPrsh($idprsh, $mahasiswa->NRP,$idklp);
                }
                /*$jwl = $this->detail_dosen_seminar->getPeriodeJadwal();
                $periode = $this->kp->getPeriode($idklp);
                foreach($jwl as $jadwal){
                    $idjadwal = ($jadwal->ID_PERIODE==$periode->ID_PERIODE)?$jadwal->ID_JADWAL:'';
                }*/
//                $idjadwal = $this->detail_dosen_seminar->getIdjadwal($idklp);
//                $check = $this->detail_dosen_seminar->updateKLP($idklp, $idjadwal);
            }
            $page = 'beranda';
        }
        else if($page == 'nilai'){
            //$arr = array('test'=>$this->input->post('1'));
            //$this->session->set_userdata($arr);
            $this->nilai_mhs_perusahaan->updateNilai();
        }
        
        redirect(base_url()."koor/show/".$page);
    }
    
    public function delete($page)
    {
        $this->detail_dosen_seminar->deleteDtlDsn();
        redirect(base_url()."koor/show/".$page);
    }
    
    public function validasi(){
        $type=$this->input->post('type');
        if($type=="proposal"){
            $data['idklp']=$this->input->post('idklp'); 
            $data['dtl'] = $this->detail_mhs->getMHS( $data['idklp'] );
            $data['klp'] = $this->kp->getKLP( $data['idklp'] );
            $this->load->view('koor/verifikasiProposal',$data);
        }
        else if($type=="perusahaan"){
            $data['idklp']=$this->input->post('idklp');
            $data['dtl'] = $this->detail_mhs->getMHS( $data['idklp'] );
            $data['dsn'] = $this->dosen->getNotPenguji();
            $data['klp'] = $this->kp->getKLP( $data['idklp'] );
            $this->load->view('koor/verifikasiPerusahaan',$data);
        }
        else if($type=="seminar"){
            $id = explode(',',$this->input->post('idklp') );
            $idsmr1 = $id[0];
            $idsmr2 = $id[1];
            $idjadwal = $id[2];
            $data['jwl'] = $this->jadwal_seminar->getJadwal($idjadwal);
            
            $data['penguji1'] = $this->detail_dosen_seminar->getDosen($idsmr1,'Penguji1');
            $data['penguji2'] = $this->detail_dosen_seminar->getDosen($idsmr2,'Penguji2');
            $data['idsmr'] = $idsmr1.','.$idsmr2;
            
            
            $data['prd'] = $this->periode->tampil();
            $data['rng'] = $this->ruangan->tampil();
            $data['dsn'] = $this->dosen->tampil();
            $this->load->view('koor/updateJadwalSeminar',$data);
        }
        else if($type=="nilai"){
            $nrp = $this->input->post('nrp');
            $data['nmp'] = $this->nilai_mhs_perusahaan->getNilai($nrp);
            $data['mhs'] = $this->member->getMhs($nrp);
            $this->load->view('koor/form_penilaian_KP',$data);
        }
        else if($type=="update_perusahaan"){
            $data['idklp']=$this->input->post('idklp');
            $data['prsh'] = $this->perusahaan->getDataPrsh($data['idklp']); 
            $this->load->view('koor/updatePerusahaan',$data);
        }
    }
}