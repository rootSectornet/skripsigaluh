<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login')=="") {
            redirect('Auth');
        }
        $this->load->library('Template','template');
        $this->load->helper('date');
        $this->load->model('Pesanan_model','MPesanan');
        $this->load->model('Pembayaran_model','MPembayaran');
        $this->load->model('Pelanggan_model','MPelanggan');
        $this->load->model('User_model','user');
        $this->load->model('Kategori_model','MKategori');
        $this->load->model('Produk_model','MProduk');
        date_default_timezone_set("Asia/Jakarta");

    }
    public function index(){
        $data['itemsPBB'] = $this->MPesanan->getPesananPelangganBelumBayar();
        $data['itemsPMK'] = $this->MPesanan->getPesananPelangganSudahBayar();
        $data['itemsPP'] = $this->MPesanan->getOrderSedangDiProses();
        $data['OrderSelesai'] = $this->MPesanan->getOrderSelesai();
        $this->template->layout('Order/table',$data);
    }

    public function Detail($id = null){
        if ($id != null) {
            $id = base64_decode($id);
            $data['Order'] = $this->MPesanan->getOrderById($id);
            $data['pembayaran'] = $this->MPembayaran->getByIdOrder($id);
            $data['pelanggan'] = $this->MPelanggan->getById($data['Order']->ID_Pelanggan);
            $data['pengiriman'] = $this->MPesanan->getPengirimanByIdOrder($id);
            $this->template->layout('Order/detail',$data);
        }else{
            
            show_404();
        }
    }

    public function Konfirmasi($id = null){
        if ($id != null) {
            $tmpPembayaran = $this->MPembayaran->getById($id);
            $updatePembayaran['Status'] = 1;
            $this->db->trans_start();
                $this->MPembayaran->update($updatePembayaran,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Konfirmasi Pembayaran"));
                redirect('Order/Detail/'.base64_encode($tmpPembayaran->ID_Order),'refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Konfirmasi Pembayaran"));
                redirect('Order/Detail/'.base64_encode($tmpPembayaran->ID_Order),'refresh');
            }
        }else{
            show_404();
        }
    }

    public function Pengiriman($id){

        $data['tmpPembayaran'] = $this->MPembayaran->getById($id);
        if ($_POST) {
            $dataPengiriman = array(
                "ID_Pengiriman" =>  $this->MPesanan->generateCodePengiriman(),
                "ID_Order"  =>  $data['tmpPembayaran']->ID_Order,
                "ID_Pegawai"    =>  $this->input->post('driver'),
                "Tanggal"   =>  date('Y-m-d')
            );

            $updatePembayaran['Status'] = 2;
            $this->db->trans_start();
                $this->MPembayaran->update($updatePembayaran,$id);
                $this->MPesanan->create_pengiriman($dataPengiriman);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Konfirmasi Pembayaran"));
                redirect('Order/Detail/'.base64_encode($data['tmpPembayaran']->ID_Order),'refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Konfirmasi Pembayaran"));
                redirect('Order/Detail/'.base64_encode($data['tmpPembayaran']->ID_Order),'refresh');
            }
        }
        $data['drivers'] = $this->user->getByJabatan(4);
        $data['codePengiriman'] = $this->MPesanan->generateCodePengiriman();
        $this->template->layout('Order/create_pengiriman',$data);
    }

    public function Selesai($id_pengiriman){
        $updatePengiriman['Status'] = 1;
        $updatePengiriman['Tanggal_selesai'] = date('Y-m-d');
        $tmpPengiriman = $this->MPesanan->getPengirimanById($id_pengiriman);
        $this->db->trans_start();
            $this->MPesanan->updatePengiriman($updatePengiriman,$id_pengiriman);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Pengiriman Selesai"));
            redirect('Order/Detail/'.base64_encode($tmpPengiriman->ID_Order),'refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Pengiriman Telah Selesai"));
            redirect('Order/Detail/'.base64_encode($tmpPengiriman->ID_Order),'refresh');
        }
    }

    public function create(){
        if ($_POST) {
            $order = array(
                "ID_Order"  =>  $this->MPesanan->generateCodeOrder(),
                "ID_Pelanggan"  =>  $this->input->post('pelanggan'),
                "ID_Produk" =>  $this->input->post('produk'),
                "Tanggal"   =>  date('Y-m-d')
            );

            $tmpstock = $this->MProduk->getStock($this->input->post('produk'));
            $updateStock = array('stock'=>$tmpstock - 1);
                $this->db->trans_start();
                    $this->MPesanan->create($order);
                $this->db->trans_complete();
                if ($this->db->trans_status() === false) {
                    $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Buat Order"));
                    redirect('Order','refresh');
                }else{
                    $this->MProduk->update($updateStock,$this->input->post('produk'));
                    $this->session->set_flashdata("pesan_eror",AlertSuccess("Buat Berhasil"));
                    redirect('Order','refresh');
                }
        }
        $data['produks'] = $this->MProduk->read();
        $data['kategoris'] = $this->MKategori->read();
        $data['pelanggans'] = $this->MPelanggan->read();
        $this->template->layout('Order/create',$data);
    }

    public function delete($id = null){
        if(!is_null($id)){
            $this->db->trans_start();
                $order = $this->MPesanan->getOrderById($id);
                if($order){
                    $tmpstock = $this->MProduk->getStock($order->ID_Produk);
                    $updateStock = array('stock'=>$tmpstock + 1);
                    $this->MProduk->update($updateStock,$order->ID_Produk);
                }
                $this->MPesanan->HapusOrder($id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus Order"));
                redirect('Order','refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Hapus Order Berhasil"));
                redirect('Order','refresh');
            }
        }else{
            redirect('Order','refresh');
        }
    }
    

}
