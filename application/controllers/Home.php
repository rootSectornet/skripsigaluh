<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $this->template->layout('Dashboard');
    }
    

}
