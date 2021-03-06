<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Kategori_model','MKategori');
        $this->load->model('Produk_model','MProduk');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MProduk->read();
        $this->template->layout('Produk/table',$data);
    }

    public function Create(){
        if ($_POST) {
            $this->db->trans_start();
                $data = array(
                    "nama_barang"   =>  $this->input->post('nama_barang'),
                    "satuan"   =>  $this->input->post('satuan'),
                );
                $this->MProduk->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Data Barang"));
                redirect('Master/Produk','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Data Barang"));
                redirect('Master/Produk','refresh');
            }
        }
        $this->template->layout('Produk/create');
    }


    public function Edit($id = null){
        if ($_POST) {
            $data = array(
                "nama_barang"   =>  $this->input->post('nama_barang'),
                "satuan"   =>  $this->input->post('satuan'),
            );
            $this->db->trans_start();
                $this->MProduk->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Data Barang"));
                redirect('Master/Produk','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Data Barang"));
                redirect('Master/Produk','refresh');
            }

        }


        $data['produk'] = $this->MProduk->getById($id);
        $this->template->layout('Produk/edit',$data);

    }



    public function Delete($id){
        $this->db->trans_start();
            $this->MProduk->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Barang"));
            redirect('Master/Produk','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Barang"));
            redirect('Master/Produk','refresh');
        }
    }

    

}
