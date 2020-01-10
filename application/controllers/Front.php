<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Kategori_model','MKategori');
        $this->load->model('Produk_model','MProduk');
        $this->load->model('Pelanggan_model','MPelanggan');
        $this->load->model('Pesanan_model','MPesanan');
        $this->load->model('Pembayaran_model','MPembayaran');
        
    }
    public function index(){
        $data['produks'] = $this->MProduk->read();
        $this->load->view('Front/Header_front');
        $this->load->view('Front/home',$data);
    }

    public function produk(){
        $cari = null;
        if ($_POST) {
            $cari = $this->input->post('cari');
            $data['cari'] = $this->input->post('cari');
        }
        $data['produks'] = $this->MProduk->read($cari);
        $this->load->view('Front/Header_front');
        $this->load->view('Front/produk',$data);
    }
    public function produk_detail($id){
        $data['produk'] = $this->MProduk->getById($id);
        $this->load->view('Front/Header_front');
        $this->load->view('Front/produk_detail',$data);
    }

    public function kontak(){
        $this->load->view('Front/Header_front');
        $this->load->view('Front/kontak');
    }

    public function Check_login(){
        if ($this->ISLogin()) {
            redirect('Front/logout','refresh');
        }else{
            redirect('Front/login','refresh');
        }
    }

    public function logout(){
        $this->session->unset_userdata('pelanggan');
            redirect('Front/login','refresh');
    }

    public function login(){
        if ($_POST) {
            $email = $this->input->post("email");
            $data = $this->MPelanggan->GetByEmail($email);
            if(count($data) > 0){
                if(password_verify($this->input->post('password'),$data->password)){
                        $sess_data['pelanggan']  = $data;
                        $this->session->set_userdata($sess_data);
                        redirect('Front','refresh');
                }else{
                    $this->session->set_flashdata("pesan_eror",AlertSuccess("Password Salah"));
                    redirect('Front/login','refresh');
                }
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Email Salah"));
                redirect('Front/login','refresh');
            }   
        }
        $this->load->view('Front/Header_front');
        $this->load->view('Front/login');
    }

    public function daftar(){
        if ($_POST) {
            if ($this->input->post('password') != $this->input->post('repassword')) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Konfirmasi Password Tidak Sesuai"));
                redirect('Front/daftar','refresh');
            }else{
                $data = array(
                    "username" =>  $this->input->post('username'),
                    "email" =>  $this->input->post('email'),
                    "password"  =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    "alamat"    =>  $this->input->post('alamat'),
                    "telepon"   =>  $this->input->post('telepon')
                );
                $this->db->trans_start();
                    $this->MPelanggan->create($data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === false) {
                    $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Daftar"));
                    redirect('Front/daftar','refresh');
                }else{
                    $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Daftar Silahkan Login"));
                    redirect('Front/login','refresh');
                }
            }
        }
        $this->load->view('Front/Header_front');
        $this->load->view('Front/daftar');
    }

    private function  ISLogin(){
        if ($this->session->userdata('pelanggan')) {
            return true;
        }else{
            return false;
        }
    }

    public function Beli($id){
        if ($this->ISLogin()) {
            $order = array(
                "ID_Order"  =>  $this->MPesanan->generateCodeOrder(),
                "ID_Pelanggan"  =>  $this->session->userdata('pelanggan')->id_pelanggan,
                "ID_Produk" =>  $id,
                "Tanggal"   =>  date('Y-m-d')
            );

            $tmpstock = $this->MProduk->getStock($id);
            $updateStock = array('stock'=>$tmpstock - 1);
                $this->db->trans_start();
                    $this->MPesanan->create($order);
                $this->db->trans_complete();
                if ($this->db->trans_status() === false) {
                }else{
                    $this->MProduk->update($updateStock,$id);
                }
            redirect('Front/Pesanan','refresh');
        }else{
            redirect('Front/login','refresh');
        }
    }

    public function Pesanan(){
        if ($this->ISLogin()) {
            $data['pesananMenungguPembayaran'] = $this->MPesanan->getPesananPelangganBelumBayar($this->session->userdata('pelanggan')->id_pelanggan);
            $data['pesananMenungguKonfirmasi'] = $this->MPesanan->getPesananPelangganSudahBayar($this->session->userdata('pelanggan')->id_pelanggan);
            $data['pesananProsesPengiriman'] = $this->MPesanan->getOrderSedangDiProses($this->session->userdata('pelanggan')->id_pelanggan);
            $data['OrderSelesai'] = $this->MPesanan->getOrderSelesai($this->session->userdata('pelanggan')->id_pelanggan);
            $this->load->view('Front/Header_front');
            $this->load->view('Front/daftar_pesanan',$data);
        }else{
            redirect('Front/login','refresh');
        }
    }

    public function Konfirmasi($idOrder = null){
        if ($idOrder != null) {
            $idOrder = base64_decode($idOrder);
            $tmpOrder = $this->MPesanan->getOrderById($idOrder);
            if ($_POST) {
                $config = array(
                    'upload_path' => "./assets/img/",
                    'overwrite' => TRUE,
                    'allowed_types' =>  '*'
                    );
                $this->load->library('upload', $config);
                if($this->upload->do_upload("bukti"))
                {
                    $image = array('upload_data' => $this->upload->data());
                    $this->db->trans_start();
                        $pembayaran = array(
                            "ID_Pembayaran" => $this->MPembayaran->generateCodePembayaran(),
                            "ID_Order"  =>  $idOrder,
                            "Jumlah_Bayar"  =>  $this->input->post('Jumlah_Bayar'),
                            "Bukti_Pembayaran"  =>  $image["upload_data"]["file_name"],
                            "Tanggal"   =>  date('Y-m-d'),
                            "Keterangan"   =>   $this->input->post('Keterangan')
                        );
                        if ($this->input->post('Jumlah_Bayar') >= $tmpOrder->harga) {
                            $this->MPembayaran->create($pembayaran);
                            $orderStatus['Status'] = 1;
                            $this->MPesanan->update($orderStatus,$idOrder);
                        }else{
                            echo "<script>alert('Jumlahn pembayaran kurang');</script>";
                        }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === false) {
                        echo "<script>alert('Gagal Konfirmasi pembayaran');</script>";
                    }else{
                            echo "<script>alert('Terima kasih atas Konfirmasi pembayaran anda, silahkan tunggu konfirmasi dari admin untuk proses selanjutnya');</script>";
                            redirect('Front/Pesanan','refresh');
                    }
                }
                else
                {
                    echo "<script>alert('".$this->upload->display_errors()."');</script>";
                }

            }
            $data['code'] = $this->MPembayaran->generateCodePembayaran();
            $this->load->view('Front/Header_front');
            $this->load->view('Front/konfirmasi',$data);
        }else{
            redirect('Front/Pesanan','refresh');
        }
    }


    public function Hapus($id){
        $this->db->trans_start();
            $tmpOrder = $this->MPesanan->getOrderById($id);
            $tmpstock = $this->MProduk->getStock($tmpOrder->ID_Produk);
            $updateStock = array('stock'=>$tmpstock + 1);
            $this->MPesanan->HapusOrder($id);
            $this->MProduk->update($updateStock,$tmpOrder->ID_Produk);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Hapus Pesanan"));
            redirect('Front/Pesanan','refresh');
        }else{
            $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Hapus Pesanan"));
            redirect('Front/Pesanan','refresh');
        }
    }
    
    public function Profile($id){
        if ($_POST) {
            $data = array(
                "username" =>  $this->input->post('username'),
                "email" =>  $this->input->post('email'),
                "alamat"    =>  $this->input->post('alamat'),
                "telepon"   =>  $this->input->post('telepon')
            );
            if ($this->input->post('password') != "*****") {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->db->trans_start();
                $this->MPelanggan->update($data,$id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata("pesan_eror",AlertFailed("Gagal Update Profile"));
                redirect('Front/Profile/'.$id,'refresh');
            }else{
                $this->session->set_flashdata("pesan_eror",AlertSuccess("Berhasil Update Profile"));
                redirect('Front/Profile/'.$id,'refresh');
            }
        }


        $data['item'] = $this->MPelanggan->getById($id);
        $this->load->view('Front/Header_front');
        $this->load->view('Front/Profile',$data);
    }

}
