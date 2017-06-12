<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'gudang.php';
class Laporan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page)
    {   
        if(isset($_POST['pilihanrange'])){
                $_SESSION['pilihanrange']=$_POST['pilihanrange'];
                $range = $_SESSION['pilihanrange'];
            }else if(isset($_SESSION['pilihanrange'])){
                $range = $_SESSION['pilihanrange'];
            }else{ 
                $_SESSION['pilihanrange'] = "Bulanan";
            }

        $this->session->set_userdata('navbar_status', 'laporanfarmasi');
        $gudang = new Gudang();
        $title['title']="Riwayat Permintaan Masuk";

        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ $limit = $this->default_setting->pagination('LIMIT'); }
        if(!isset($sort)){ $sort = $this->default_setting->pagination('SORT');  }
        
        $data = $gudang->getLaporanRange($range, $sort, $page, $limit);
        //$data = $gudang->riwayatPermintaanStok($sort, $page, $limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/laporanfarmasi', $data);
        $this->load->view('footer');
    }
    public function print($month, $year)
    {   
        $title['title']="Print";
        $gudang = new Gudang();
        $data = $gudang->getLaporan($month, $year);
        $this->load->view('header',$title);
        $this->load->view('farmasi/laporanprint',$data);
    }
}