<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'jenispenerimaan.php';

class KelolaJenisPenerimaan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'kelola');
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page=null)
    {   
        $pasien = new JenisPenerimaan();
        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Jenis Penerimaan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }
        
        $data = $pasien->getData($sort, $page, $limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolajenispenerimaan', $data);
        $this->load->view('footer');
    }

    public function detil($id=null)
    {   
        $pasien = new JenisPenerimaan();
        //$url="pasien";
        $title['title']="Kelola Jenis Penerimaan";
        
        $data = $pasien->getOne($id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolajenispenerimaan', $data);
        $this->load->view('footer');
    }


    public function search($search=null)
    {   
        $search = $this->input->post('search');
        $pasien = new JenisPenerimaan();
        $title['title']="Kelola Jenis Penerimaan";
        
        $data = $pasien->searchData($search);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolajenispenerimaan', $data);
        $this->load->view('footer');
    }
    
    public function insertData() {
        $pasien = new JenisPenerimaan();
        $affectedRow = $pasien->postData();
        $this->pesan("Tambah", $affectedRow);
        redirect('/kelola/kelolajenispenerimaan', 'refresh');
    }

    public function editData($id) {
        $pasien = new JenisPenerimaan();
        $affectedRow = $pasien->editData($id);
        $this->pesan("Edit", $affectedRow);
        redirect('/kelola/kelolajenispenerimaan', 'refresh');
    }

    public function deleteData($id) {
        $pasien = new JenisPenerimaan();
        $affectedRow = $pasien->deleteData($id);
        $this->pesan("Hapus", $affectedRow);
        redirect('/kelola/kelolajenispenerimaan', 'refresh');
    }

    public function pesan($metode, $affectedRow) {
        $this->session->set_flashdata('metode', $metode);
        if ($affectedRow == 1) {

            $this->session->set_flashdata('pesan', 'berhasil');
        } elseif ($affectedRow == 0 and $metode == "ubah") {
            $this->session->set_flashdata('pesan', 'berhasil');
        } else {
            $this->session->set_flashdata('pesan', 'gagal');
        }
    }
}
