<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once CLASSES_DIR  . 'antrian.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'pasien.php';
require_once CLASSES_DIR  . 'depo.php';

class AntrianBerjalanDepo extends CI_Controller
{   
    private $title;
    private $unit_id=2;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'antrianberjalandepo');
        $this->title['title']="Antrian Berjalan";
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
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data['daftarUnit'] = $master->getData("unit");
        $this->load->view('header',$this->title);
        $this->load->view('navbar');
        $this->load->view('/depo/antrianberjalan',$data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', $return);
    }
    
    public function ajaxAntrianBerjalan($unit_id){
        $antrian = new Antrian();
        echo $antrian->ajaxAntrianHariIni($unit_id);
    }

    public function layananObatKeluar($pasien_id)
    {   
        $master = new MasterTabel();
        $barang = new Barang();
        $pasien = new Pasien();

        $title['title']="Antrian Berjalan";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];
        
        $data = $pasien->getOne($pasien_id);
        $data['daftarAturanPakai'] = $master->getData("aturan_pakai");
        $data['daftarBarang'] = $barang->getAll($this->unit_id);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/obatkeluar',$data);
        $this->load->view('footer');
    }

    public function prosesObatKeluar($pasien_id){
        if( $this->input->post('batal') )
        {
            redirect('depo/antrianberjalandepo', 'refresh');

        } else if( $this->input->post('simpan') ){
            $depo=new Depo();
            $return = $depo->prosesPengeluaranObat($this->unit_id, $pasien_id);
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
                }else if($return==true){
                    $this->pesan("Pengeluaran obat berhasil", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
                }else{
                    $this->pesan("Error server", "");
                    redirect('depo/antrianberjalandepo', 'refresh');
            }
        }
    }
}
