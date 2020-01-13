<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->model('Jabatan_model','jabatan');
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $item['items'] = $this->jabatan->Read();
        $this->template->layout('jabatan/table',$item);
    }
    public function Create(){
        if ($_POST) {
            $data = array(
                "Jabatan"   =>  $this->input->post('Jabatan')
            );
            $this->db->trans_start();
                $this->jabatan->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Jabatan"));
                redirect('Jabatan','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Jabatan"));
                redirect('Jabatan','refresh');
            }
        }
        $this->template->layout('jabatan/create');
    }

    public function Edit($id){
        if ($_POST) {
            $data = array(
                "Jabatan"   =>  $this->input->post('Jabatan')
            );
            $this->db->trans_start();
                $this->jabatan->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Jabatan"));
                redirect('Jabatan','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Jabatan"));
                redirect('Jabatan','refresh');
            }
        }
        $item['item'] = $this->jabatan->getById($id);
        $this->template->layout('jabatan/edit',$item);
    }
    public function Delete($id){
            $this->db->trans_start();
                $this->jabatan->delete($id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus Data"));
                redirect('Jabatan','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus Data"));
                redirect('Jabatan','refresh');
            }
    }
    

}
