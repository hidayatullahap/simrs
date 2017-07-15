<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Permintaan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->load->model('penggunaModel');
        $this->load->model('permintaanBarangModel');
        $this->session->set_userdata('navbar_status', 'daftarpasien');
        if (!$this->penggunaModel->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $title['title']="Layanan Permintaan Masuk";
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/halamanutama');
        $this->load->view('footer');
    }

    public function detil($unit_id, $nomorPermintaan)
    {   
        $title['title']="Layanan Permintaan Masuk";
        $this->session->set_userdata('navbar_status', 'halamanutamafarmasi');
        $data = $this->permintaanBarangModel->getDetil($unit_id, $nomorPermintaan);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/detilpermintaan', $data);
        $this->load->view('footer');
    }

    public function detilItem($nomorPermintaan)
    {   
        $this->session->set_userdata('navbar_status', 'riwayatpermintaan');
        $unit_id=3;
        $title['title']="Detil Permintaan Masuk";
        $data = $this->permintaanBarangModel->getDetil($unit_id, $nomorPermintaan);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/detilitempermintaan', $data);
        $this->load->view('footer');
    }
    
    public function proses($jumlahItem)
    {   
        $unit_id=3;
        for ($i=1; $i <= $jumlahItem ; $i++) { 
            $id=$_POST['idpermintaan'.$i];
            $idbarang=$_POST['idbarang'.$i];
            $nomorPermintaan = $_POST['nomorpermintaan'.$i];
            $untuk_unit_id = $_POST['dariunitid'.$i];
            $jumlah = $_POST['jumlah'.$i];
            
            $this->permintaanBarangModel->prosesPermintaan($id, $idbarang, $unit_id, $untuk_unit_id, $jumlah);
        }
        redirect('farmasi/halamanutama');
    }
}