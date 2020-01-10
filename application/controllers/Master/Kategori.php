<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Kategori_model','MKategori');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MKategori->read();
        $this->template->layout('Kategori/table',$data);
    }

    public function Create(){
        if ($_POST) {
            $data['nama_kategori'] = $_POST['Kategori'];

            $this->db->trans_start();
                $this->MKategori->create($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Kategori Produk"));
                redirect('Master/Kategori','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Kategori Produk"));
                redirect('Master/Kategori','refresh');
            }

        }
        $this->template->layout('Kategori/create');
    }

    public function Edit($id){
        if ($_POST) {
            $data = array(
                "nama_kategori"   =>  $this->input->post('Kategori')
            );
            $this->db->trans_start();
                $this->MKategori->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Kategori Produk"));
                redirect('Master/Kategori','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Kategori Produk"));
                redirect('Master/Kategori','refresh');
            }
        }
        $item['item'] = $this->MKategori->getById($id);
        $this->template->layout('Kategori/edit',$item);
    }

    public function Delete($id){
        $this->db->trans_start();
            $this->MKategori->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus Kategori Produk"));
            redirect('Master/Kategori','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus Kategori Produk"));
            redirect('Master/Kategori','refresh');
        }
    }
    

}
