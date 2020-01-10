<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->model('User_model','user');
        $this->load->model('jabatan_model','jabatan');
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $item['items'] = $this->user->Read();
        $this->template->layout('user/table',$item);
    }
    public function Create(){
        if ($_POST){
            $this->db->trans_start();
                $data = $this->input->post();
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $this->user->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah User"));
                redirect('User','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah User"));
                redirect('User','refresh');
            }
        }
        $item['jabatans'] = $this->jabatan->Read();
        $this->template->layout('user/create',$item);
    }

    public function Edit($id){
        if ($_POST) {
            $this->db->trans_start();
                $data = $this->input->post();
                if (isset($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }                
                $this->user->update($this->input->post(),$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update User"));
                redirect('User','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update User"));
                redirect('User','refresh');
            }
        }
        $item['item'] = $this->user->getById($id);
        $item['jabatans'] = $this->jabatan->Read();
        $this->template->layout('user/edit',$item);
    }
    public function Delete($id){
            $this->db->trans_start();
                $this->user->delete($id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus Data"));
                redirect('User','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus Data"));
                redirect('User','refresh');
            }
    }
    

}
