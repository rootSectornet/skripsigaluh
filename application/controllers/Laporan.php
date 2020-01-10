<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Pesanan_model','MPesanan');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function Penjualan(){
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        if ($_GET) {
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');
        }
        $data['items'] = $this->MPesanan->getLaporanPenjualan($dari,$sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->template->layout('Laporan/Penjualan/table',$data);
    }

    public function downloadPenjualan($dari,$sampai){
        $data['items'] = $this->MPesanan->getLaporanPenjualan($dari,$sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->load->view('Laporan/Penjualan/cetak',$data);
    }

    public function Pengiriman(){
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $status = null;
        if ($_GET) {
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');
            $status = $this->input->get('status');
            if ($status == "all") {
                $status = null;
            }
        }
        $data['items'] = $this->MPesanan->getLaporanPengiriman($dari,$sampai,$status);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->template->layout('Laporan/Pengiriman/table',$data);
    }

    public function downloadPengiriman($dari,$sampai){
        $data['items'] = $this->MPesanan->getLaporanPengiriman($dari,$sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->load->view('Laporan/Pengiriman/cetak',$data);
    }
    

}
