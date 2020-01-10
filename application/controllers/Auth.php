<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('User_model','user');
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
    	$this->load->view('Auth/Login');
    }
    public function DoLogin(){
        if($this->input->post()){
            $username = $this->input->post("username");
            $data = $this->user->GetByUsername($username);
            // print_r($data);
            // exit;
            if($data){
                if(password_verify($this->input->post('password'),$data->password)){
                        $sess_data['login']  = 'Yes';
                        $sess_data['data']  = $data;
                        $this->session->set_userdata($sess_data);
                        echo 300;
                }else{
                    echo 302;
                }
            }else{
                echo 301;
            }       
        }

    }
	public function logout(){
        $this->session->sess_destroy();
        redirect('Auth','refresh');
	}

}