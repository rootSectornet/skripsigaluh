<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kunjungan extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Kunjungan_model','MKunjungan');
        $this->load->model('Toko_model','MToko');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['items'] = $this->MKunjungan->read();
        $this->template->layout('Kunjungan/table',$data);
    }

    public function Create(){
        if ($_POST) {
            $this->db->trans_start();
                $data_kunjungan = array(
                    "id_toko"   =>  $this->input->post('id_toko'),
                );
                $gambar = $this->input->post('id_kunjungan_toko');
                $gambar = json_decode($gambar);
                $this->MKunjungan->update_gambar($data_kunjungan,$gambar);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Data Barang"));
                redirect('Master/Kunjungan','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Data Barang"));
                redirect('Master/Kunjungan','refresh');
            }
        }
        $data['toko'] = $this->MToko->read();
        $this->template->layout('Kunjungan/create',$data);
    }

    public function upload_gambar(){
        $config['upload_path']          = 'assets/img/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG';
        $config['overwrite']            = false;
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('userfile')){
            $this->db->trans_start();
            $data = array(
                'foto' => $this->upload->data('file_name'),
                'id_pegawai' => $this->session->userdata('data')->ID_Pegawai,
                'id_toko' => "",
                'tanggal' => date('Y-m-d'),
            );
            $gambar = $this->MKunjungan->upload_gambar($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo 100;
            }else{
               echo $gambar;
            }
        }else{
            echo $this->upload->display_errors();
        }
    }

    public function delete_gambar($id){
        $this->db->trans_start();
            $this->MKunjungan->delete($id);
        $this->db->trans_complete();
    }


    public function Edit($id = null){
        if ($_POST) {
            $data = array(
                "nama_barang"   =>  $this->input->post('nama_barang'),
                "satuan"   =>  $this->input->post('satuan'),
            );
            $this->db->trans_start();
                $this->MKunjungan->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Data Barang"));
                redirect('Master/Kunjungan','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Data Barang"));
                redirect('Master/Kunjungan','refresh');
            }

        }


        $data['kunjungan'] = $this->MKunjungan->getById($id);
        $this->template->layout('Kunjungan/edit',$data);

    }



    public function Delete($id){
        $this->db->trans_start();
            $this->MKunjungan->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Barang"));
            redirect('Master/Kunjungan','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Barang"));
            redirect('Master/Kunjungan','refresh');
        }
    }

    

}
