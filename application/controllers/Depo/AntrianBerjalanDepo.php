<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'antrian.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'barang.php';

class AntrianBerjalanDepo extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'antrianberjalandepo');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
            redirect('login');
        }
    }
    
    public function index()
    {   
        $this->page(1);
    }

    public function page($page=null)
    {   
        $master = new MasterTabel();

        $title['title']="Antrian Berjalan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data['daftarUnit'] = $master->getData("unit");
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/antrianberjalan',$data);
        $this->load->view('footer');
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
    
    public function ajaxAntrianBerjalan($unit_id){
        $antrian = new Antrian();
        echo $antrian->ajaxAntrianHariIni($unit_id);
    }

    public function layananObatKeluar($pasien_id)
    {   
        $unit_id = 2;
        $master = new MasterTabel();
        $barang = new Barang();

        $title['title']="Antrian Berjalan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data['daftarUnit'] = $master->getData("unit");
        $data['daftarBarang'] = $barang->getAll($unit_id);
        $data['daftarJenisPenerimaan'] = $master->getData('jenis_penerimaan');
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/obatkeluar',$data);
        $this->load->view('footer');
    }
}
