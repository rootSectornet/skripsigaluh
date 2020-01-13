<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_toko extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Toko_model','MToko');
        $this->load->model('Produk_model','MProduk');
        $this->load->model('Produk_toko_model','MProduk_toko');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MProduk_toko->read();
        $this->template->layout('Produk_toko/table',$data);
    }

    public function Create(){
        if ($_POST) {
            $this->db->trans_start();
                $data = array(
                    "id_barang"   =>  $this->input->post('id_barang'),
                    "id_toko"   =>  $this->input->post('id_toko'),
                );
                $this->MProduk_toko->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Data Barang"));
                redirect('Master/Produk_toko','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Data Barang"));
                redirect('Master/Produk_toko','refresh');
            }
        }
        $data['produk'] = $this->MProduk->read();
        $data['toko'] = $this->MToko->read();
        $this->template->layout('Produk_toko/create',$data);
    }


    public function Edit($id = null){
        if ($_POST) {
            $data = array(
                "id_barang"   =>  $this->input->post('id_barang'),
                "id_toko"   =>  $this->input->post('id_toko'),
            );
            $this->db->trans_start();
                $this->MProduk_toko->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Data Barang"));
                redirect('Master/Produk_toko','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Data Barang"));
                redirect('Master/Produk_toko','refresh');
            }

        }

        $data['produk'] = $this->MProduk->read();
        $data['toko'] = $this->MToko->read();
        $data['produk_toko'] = $this->MProduk_toko->getById($id);
        $this->template->layout('Produk_toko/edit',$data);

    }



    public function Delete($id){
        $this->db->trans_start();
            $this->MProduk_toko->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Barang"));
            redirect('Master/Produk_toko','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Barang"));
            redirect('Master/Produk_toko','refresh');
        }
    }

    

}
