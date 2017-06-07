<?php
require_once CLASSES_DIR  . 'pengguna.php';

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        
    }

    function index() {
        $pengguna = new Pengguna();
        //if ($this->is_loggedin()){
        if ($pengguna->is_loggedin()){
            redirect('kelola/kelolapasien');
            //$this->proses();
        } else {
            $title['title']="Login";
            $this->load->view('header',$title);
            $this->load->view('login');
        }
    }
    
    /*
    function is_loggedin(){
        //$this->session->set_userdata('pengguna_role', 'kelola');
        $checksession = $this->session->userdata('pengguna_username');
        return isset($checksession);
    }*/

    function proses() {
        $pengguna = new Pengguna();
        $username = $_POST['username'];
        $password = $_POST['password'];

        //$username = "daffa";
        //$password = "admsin";

        $hashpass = md5($password);

        $cek = $pengguna->checkCredential($username, $hashpass);
        var_dump($cek['data']);
        echo "<br><br>";
        
        if ($cek['data']->num_rows>0) {
            echo "suc";
            foreach ($cek['data'] as $field => $values) {
                echo $values['username'];
                echo $values['role'];
                $sess_data['pengguna_nama'] = $values['nama'];
                $sess_data['pengguna_username'] = $values['username'];
                $sess_data['pengguna_peran'] = $values['role'];
                $this->session->set_userdata($sess_data);
                setcookie("pageLimit",15, time()+86400, "/","", 0);
                setcookie("pageSort", "DESC", time()+86400, "/","", 0);
                redirect('kelola/kelolapasien');
            }
        } else {
            echo "err";
            $this->session->set_userdata('notif_error', 'Username/Password Salah');
            redirect('login');
        }
    }
    function logout() {
        $pengguna = new Pengguna();
        $pengguna->logout();
        redirect('login');
    }
}