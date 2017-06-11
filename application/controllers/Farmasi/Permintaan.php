<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'gudang.php';
class Permintaan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'daftarpasien');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
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
        $gudang = new Gudang();
        $title['title']="Layanan Permintaan Masuk";
        
        $data = $gudang->getDetil($unit_id, $nomorPermintaan);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/farmasi/detilpermintaan', $data);
        $this->load->view('footer');
    }
    
    public function proses($jumlahItem)
    {   
        /*
        for ($i=1; $i <= $jumlahItem ; $i++) { 
            $permintaan_stok_id=$_POST['input'.$i];
            echo "permintaan ke ".$i." permintaan_stok_id= ".$permintaan_stok_id;
            echo "permintaan ke ".$i." Nomor Permintaan = ".$_POST['nomorpermintaan'.$i];
            echo "permintaan ke ".$i." Dengan Jumlah = ".$_POST['jumlah'.$i];
            echo "<br>";
        }*/
        $gudang = new Gudang();
        $unit_id=3;
        for ($i=1; $i <= $jumlahItem ; $i++) { 
            $id=$_POST['idpermintaan'.$i];
            $idbarang=$_POST['idbarang'.$i];
            $nomorPermintaan = $_POST['nomorpermintaan'.$i];
            $untuk_unit_id = $_POST['dariunitid'.$i];
            $jumlah = $_POST['jumlah'.$i];
            
            $gudang->prosesPermintaan($id, $idbarang, $unit_id, $untuk_unit_id, $jumlah);
        }
        //$gudang = new Gudang();
        //var_dump($gudang->prosesPermintaan($jumlahItem));
        redirect('farmasi/halamanutama');
    }
}