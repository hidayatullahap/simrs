<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }
    
    public function index()
	{
        $this->load->view('header');
        $this->load->view('navbar');
        $this->load->view('kelola/kelolapasien');
        $this->load->view('footer');
	}

}