<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Laporan extends CI_Controller
{   
    private $unit_id = 3;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->load->model('stokModel');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page)
    {       
        $range="Bulanan";
        if(isset($_POST['pilihanrange'])){
            $_SESSION['pilihanrange']=$_POST['pilihanrange'];
            $range = $_SESSION['pilihanrange'];
            }else if(isset($_SESSION['pilihanrange'])){
                $range = $_SESSION['pilihanrange'];
            }else{ 
                $_SESSION['pilihanrange'] = "Bulanan";
        }

        $this->session->set_userdata('navbar_status', 'laporanfarmasi');
        $title['title']="Laporan";

        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ $limit = $this->default_setting->pagination('LIMIT'); }
        if(!isset($sort)){ $sort = $this->default_setting->pagination('SORT');  }
        
        $data = $this->stokModel->getLaporanRange($range, $sort, $page, $limit, $this->unit_id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/laporanfarmasi', $data);
        $this->load->view('footer');
    }
    public function printlaporan($month, $year)
    {   
        
        if(isset($_SESSION['pilihanrange'])){
            $range=$_SESSION['pilihanrange'];
            }else{ 
               $range="Bulanan";
        }
        $title['title']="Print";
        $data = $this->stokModel->getLaporan($range, $month, $year, $this->unit_id);
        $this->load->view('header',$title);
        $this->load->view('farmasi/laporanprint',$data);
    }

    public function excel($month, $year)
    {   
        if(isset($_SESSION['pilihanrange'])){
            $range=$_SESSION['pilihanrange'];
            }else{ 
               $range="Bulanan";
        }
        $data = $this->stokModel->getLaporan($range, $month, $year, $this->unit_id);

        $tempArray = array();
        $myArray = array();
        foreach ($data['data'] as $field => $row){
                $tempArray = $row;
                array_push($myArray, $tempArray);
            }
        $json = json_encode($myArray);
        $arrayMu=json_decode($json,true);

        $filename = 'laporan.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        $output = fopen("php://output", "w");
        $header = array_keys($arrayMu[0]);
        fputcsv($output, $header);
        foreach ($arrayMu as $row) {
            fputcsv($output, $row);
        }

        fclose($output);

    }
}