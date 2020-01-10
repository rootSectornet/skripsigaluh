<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Pelanggan_model','MPelanggan');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MPelanggan->read();
        $this->template->layout('Pelanggan/table',$data);
    }
    

}
