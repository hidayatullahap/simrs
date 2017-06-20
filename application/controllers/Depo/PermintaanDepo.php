<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once CLASSES_DIR  . 'gudang.php';
require_once CLASSES_DIR  . 'pengguna.php';
require_once CLASSES_DIR  . 'barang.php';
require_once CLASSES_DIR  . 'mastertabel.php';
require_once CLASSES_DIR  . 'depo.php';

class PermintaanDepo extends CI_Controller
{   
    private $unit_id=2;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('default_setting');
        $this->session->set_userdata('navbar_status', 'permintaanstok');
        $pengguna = new Pengguna();
        if (!$pengguna->is_loggedin()){
            redirect('login');
        }
    }

    public function index()
    {   
        $_SESSION["tanggalAwal"]=null;
        $_SESSION["tanggalAkhir"]=null;
        $_SESSION["searchFarmasi"]=null;
        $this->page(1);
    }
    public function tambahPermintaanDepo(){
        if( $this->input->post('batal') )
        {
            redirect('/depo/permintaandepo', 'refresh');

        } else if( $this->input->post('simpan') ){
            $depo=new Depo();
            $return = $depo->prosesPermintaanStok($this->unit_id);
            //var_dump($return);
            if($return==false){
                    $this->pesan("Tabel tidak boleh kosong", $return);
                    redirect('/depo/permintaandepo', 'refresh');
                }else if($return==true){
                    $this->pesan("Pengadaan barang berhasil", $return);
                    redirect('/depo/permintaandepo', 'refresh');
                }else{
                    $this->pesan("Error server", $return);
                    redirect('/depo/permintaandepo', 'refresh');
            }
        }
    }

    public function page($page)
    {   
        $gudang = new Gudang();
        $title['title']="Riwayat Barang Masuk";
        $limit = $_COOKIE["pageLimit"];
        $sort = $_COOKIE["pageSort"];

        if(!isset($page)){ $page = 1; }
        if(!isset($limit)){ 
            $limit = $this->default_setting->pagination('LIMIT'); 
        }
        if(!isset($sort)){ 
            $sort = $this->default_setting->pagination('SORT'); 
        }

        $data = $gudang->infoStok($this->unit_id, $sort,$page,$limit);
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/stokdepo', $data);
        $this->load->view('footer');
    }

    public function pesan($metode, $return) {
        $this->session->set_flashdata('metode', $metode);
        $this->session->set_flashdata('pesan', '');
    }

    public function layanan() {
        $title['title']="Riwayat Barang Keluar";
        $barang = new Barang();
        $master = new MasterTabel();
        $data['daftarBarang'] = $barang->getAll($this->unit_id);
        $data['daftarUnit'] = $master->getData('unit');
        $this->load->view('header',$title);
        $this->load->view('navbar');
        $this->load->view('/depo/permintaanbarang', $data);
        $this->load->view('footer');
    }
}
