<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestExcel extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }
    
    public function index()
	{
	    $this->load->view('test_excel');
	}

}