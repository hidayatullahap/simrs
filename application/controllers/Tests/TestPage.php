<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TestPage extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('navbar');
        $this->load->view('tests/testpage');
        $this->load->view('footer');
    }

}
