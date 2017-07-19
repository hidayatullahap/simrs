<?php

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('penggunaModel');
    }

    function index() {
        if ($this->penggunaModel->is_loggedin()){
            redirect('kelola/masterpasien');
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
        $username = $_POST['username'];
        $password = $_POST['password'];

        //$username = "daffa";
        //$password = "admsin";

        $hashpass = md5($password);

        $cek = $this->penggunaModel->checkCredential($username, $hashpass);
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
                setcookie("pageLimit",10, time()+86400, "/","", 0);
                setcookie("pageSort", "DESC", time()+86400, "/","", 0);
                setlocale(LC_ALL,'id_ID');
            }
            $role=$this->session->userdata('pengguna_peran');
            if($role == "admin"){
                redirect('kelola/masterpengguna');
            }else if($role == "loket"){
                redirect('loket/layananpasien');
            }else if($role == "gudangfarmasi"){
                redirect('farmasi/halamanutama');
            }else if($role == "gudanginventaris"){
                redirect('inventaris/halamanutama');
            }else if($role == "deporajal"){
                redirect('depo/antrianberjalandepo');
            }else{
                redirect('kelola/masterbarang');
            }
            
        } else {
            echo "err";
            $this->session->set_userdata('notif_error', 'Username/Password Salah');
            redirect('login');
        }
    }
    function logout() {
        $this->penggunaModel->logout();
        redirect('login');
    }
}