<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('User_model','user');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['absen'] = $this->user->getAbsen($this->session->userdata('data')->ID_Pegawai);
        $this->template->layout('Dashboard',$data);
    }

    public function Absen(){
        $data = array(
            'id_pegawai' => $this->session->userdata('data')->ID_Pegawai,
            'jam_masuk' => date('H:i:s'),
            'tanggal' => date('Y-m-d')
        );
        $this->db->trans_start();
        $this->user->absen($data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Barang"));
            redirect('Home','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Barang"));
            redirect('Home','refresh');
        }
    }

    public function Absen_pulang(){
        $data = array(
            'jam_keluar' => date('H:i:s'),
        );
        $this->db->trans_start();
        $this->user->absen_pulang($this->session->userdata('data')->ID_Pegawai,$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus  Barang"));
            redirect('Home','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus  Barang"));
            redirect('Home','refresh');
        }
    }
    

}
