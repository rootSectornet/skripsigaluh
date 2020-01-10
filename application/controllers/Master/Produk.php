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
            $config = array(
                'upload_path' => "./assets/img/",
                'overwrite' => TRUE,
                'allowed_types' =>  '*'
                );
            $this->load->library('upload', $config);
            if($this->upload->do_upload("foto"))
            {
                $image = array('upload_data' => $this->upload->data());
                $this->db->trans_start();
                    $data = array(
                        "id_kategori"   =>  $this->input->post('nama_kategori'),
                        "nama_produk"   =>  $this->input->post('produk'),
                        "keterangan"    =>  $this->input->post('keterangan'),
                        "harga" =>  $this->input->post('harga'),
                        "gambar"    =>  $image["upload_data"]["file_name"],
                        "stock" =>  $this->input->post('stock')
                    );
                    $this->MProduk->create($data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === false) {
                       $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Menambah Data Produk"));
               redirect('Master/Produk','refresh');
                }else{
                       $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Menambah Data Produk"));
                redirect('Master/Produk','refresh');
                }
            }
            else
            {
                $this->session->set_flashdata("pesan_eror",AlertSuccess($this->upload->display_errors()));
                redirect('Master/Produk','refresh');
            }
        }
        $data['kategoris'] = $this->MKategori->read();
        $this->template->layout('Produk/create',$data);
    }


    public function Edit($id = null){

        if ($_POST) {
            $data = array(
                "id_kategori"   =>  $this->input->post('nama_kategori'),
                "nama_produk"   =>  $this->input->post('produk'),
                "keterangan"    =>  $this->input->post('keterangan'),
                "harga" =>  $this->input->post('harga'),
                "stock" =>  $this->input->post('stock')
            );
            if (!empty($_FILES['foto']['name'])) {
                $config = array(
                    'upload_path' => "./assets/img/",
                    'overwrite' => TRUE,
                    'allowed_types' =>  '*'
                    );
                $this->load->library('upload', $config);
                if($this->upload->do_upload("foto"))
                {
                    $image = array('upload_data' => $this->upload->data());
                    $data['gambar'] = $image["upload_data"]["file_name"];
                }
                else
                {
                    $this->session->set_flashdata("pesan_eror",AlertSuccess($this->upload->display_errors()));
                    redirect('Master/Produk','refresh');
                }
            }

            $this->db->trans_start();
                $this->MProduk->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                   $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Data Produk"));
           redirect('Master/Produk','refresh');
            }else{
                   $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Data Produk"));
            redirect('Master/Produk','refresh');
            }

        }


        $data['produk'] = $this->MProduk->getById($id);
        $data['kategoris'] = $this->MKategori->read();
        $this->template->layout('Produk/edit',$data);

    }



    public function Delete($id){
        $this->db->trans_start();
            $this->MProduk->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Produk"));
            redirect('Master/Produk','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Produk"));
            redirect('Master/Produk','refresh');
        }
    }

    

}
