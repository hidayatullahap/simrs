<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class KelolaPasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('kelola/m_kelolapasien');
    }
    
    public function index()
    {   
        $title['title']="Kelola Pasien";
        $page = 1; 
        $limit = $this->default_setting->pagination('LIMIT'); 
        $limit = 5;
        $sort = $this->default_setting->pagination('SORT'); 
        $data = $this->m_kelolapasien->getData($page, $limit, $sort);
      
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolapasien', $data);
        $this->load->view('footer');
    }

    public function page($page=null)
    {   
        if(!isset($page)){
            $page=1;
        }
        $title['title']="Kelola Pasien";
        if(!isset($page)){ $page = 1; }
        $limit = $this->default_setting->pagination('LIMIT'); 
        $limit=5;
        $sort = $this->default_setting->pagination('SORT'); 
        $data = $this->m_kelolapasien->getData($page, $limit, $sort);

        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolapasien', $data);
        $this->load->view('footer');
    }

    public function search($search=null)
    {   
        if(!isset($search)){
            $search="";
        }
        $title['title']="Kelola Pasien";
        $search = $this->input->post('search');
        $data = $this->m_kelolapasien->searchData($search);

        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/kelola/kelolapasien', $data);
        $this->load->view('footer');
    }
    
    public function insert_obat() {

        if ($this->input->post('batal')) {
            redirect('/kelola/c_obat', 'refresh');
        } else {
            $affectedRow = $this->m_gudang->insertObat();
            $this->pesan("Tambah", $affectedRow);
            redirect('/kelola/c_obat', 'refresh');
        }
    }

    public function test()
    {   
        $data = $this->m_kelolapasien->getData();
        var_dump($data);
        echo "<br><br><br><br><br><br>";
        $this->load->view('/tests/testDumpKelolaPasien', $data);
    }
}
