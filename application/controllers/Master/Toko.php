
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Toko_model','MToko');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MToko->read();
        $this->template->layout('Toko/table',$data);
    }

    public function Create(){
        if ($_POST) {
            $this->db->trans_start();
                $data = array(
                    "nama_toko"   =>  $this->input->post('nama_toko'),
                    "alamat_toko"   =>  $this->input->post('alamat_toko'),
                );
                $this->MToko->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Data Toko"));
                redirect('Master/Toko','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Data Toko"));
                redirect('Master/Toko','refresh');
            }
        }
        $this->template->layout('Toko/create');
    }


    public function Edit($id = null){
        if ($_POST) {
            $data = array(
                "nama_toko"   =>  $this->input->post('nama_toko'),
                "alamat_toko"   =>  $this->input->post('alamat_toko'),
            );
            $this->db->trans_start();
                $this->MToko->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Data Toko"));
                redirect('Master/Toko','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Data Toko"));
                redirect('Master/Toko','refresh');
            }

        }


        $data['produk'] = $this->MToko->getById($id);
        $this->template->layout('Toko/edit',$data);

    }



    public function Delete($id){
        $this->db->trans_start();
            $this->MToko->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Toko"));
            redirect('Master/Toko','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Toko"));
            redirect('Master/Toko','refresh');
        }
    }

    

}
