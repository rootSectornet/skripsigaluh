<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Pesanan_model extends CI_Model
{

	private $table = "Order_Produk";
	private $primary = "ID_Order";


	public function getPesananPelangganBelumBayar($id_pelanggan = null){
		if ($id_pelanggan != null) {
			$this->db->where('Order_Produk.ID_Pelanggan',$id_pelanggan);
		}
		$this->db->where('Order_Produk.Status',0);
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		$this->db->order_by('Order_Produk.Tanggal','DESC');
		return $this->db->get($this->table)->result();
	}


	public function getPesananPelangganSudahBayar($id_pelanggan = null){
		if ($id_pelanggan != null) {
			$this->db->where('Order_Produk.ID_Pelanggan',$id_pelanggan);
		}
		$this->db->where('Order_Produk.Status',1);
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		$this->db->order_by('Order_Produk.Tanggal','DESC');
		$tmp = $this->db->get($this->table)->result();
		foreach ($tmp as $key => $item) {
			$tmp[$key]->Pembayaran = $this->getPembayaran($item->ID_Order);
		}
		return $tmp;
	}

	public function getOrderSedangDiProses($id_pelanggan = null,$id_driver = null){
		if ($id_pelanggan != null) {
			$this->db->where('Order_Produk.ID_Pelanggan',$id_pelanggan);
		}
		if ($id_driver != null) {
			$this->db->where('Pegawai.ID_Pegawai',$id_driver);
		}
		$this->db->select('Order_Produk.*,produk.*,pelanggan.*,Pembayaran.ID_Pembayaran,Pembayaran.Jumlah_Bayar,Pembayaran.Bukti_Pembayaran,Pembayaran.Tanggal as tanggalPembayaran,Pembayaran.Status as statusPembayaran,Pembayaran.Keterangan as keteranganPembayaran,Pengiriman.ID_Pengiriman,Pengiriman.Status as statusPengiriman, Pengiriman.Tanggal as tanggalPengiriman,Pengiriman.Tanggal_selesai,Pegawai.nama_pegawai as driver,Pegawai.no_tlp_pegawai');
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		$this->db->where('Order_Produk.Status',1);
		$this->db->where('Pembayaran.Status',2);
		$this->db->where('Pengiriman.Status',0);
		$this->db->join('Pembayaran','Pembayaran.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pengiriman','Pengiriman.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get($this->table)->result();
	}




	public function getOrderSelesai($id_pelanggan = null){
		if ($id_pelanggan != null) {
			$this->db->where('Order_Produk.ID_Pelanggan',$id_pelanggan);
		}
		$this->db->select('Order_Produk.*,produk.*,pelanggan.*,Pembayaran.ID_Pembayaran,Pembayaran.Jumlah_Bayar,Pembayaran.Bukti_Pembayaran,Pembayaran.Tanggal as tanggalPembayaran,Pembayaran.Status as statusPembayaran,Pembayaran.Keterangan as keteranganPembayaran,Pengiriman.ID_Pengiriman,Pengiriman.Status as statusPengiriman, Pengiriman.Tanggal as tanggalPengiriman,Pengiriman.Tanggal_selesai,Pegawai.nama_pegawai as driver,Pegawai.no_tlp_pegawai');
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		$this->db->where('Order_Produk.Status',1);
		$this->db->where('Pembayaran.Status',2);
		$this->db->where('Pengiriman.Status',1);
		$this->db->join('Pembayaran','Pembayaran.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pengiriman','Pengiriman.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get($this->table)->result();
	}


	public function getLaporanPenjualan($dari,$sampai){
		$this->db->select('Order_Produk.*,produk.*,pelanggan.*,Pembayaran.ID_Pembayaran,Pembayaran.Jumlah_Bayar,Pembayaran.Bukti_Pembayaran,Pembayaran.Tanggal as tanggalPembayaran,Pembayaran.Status as statusPembayaran,Pembayaran.Keterangan as keteranganPembayaran,Pengiriman.ID_Pengiriman,Pengiriman.Status as statusPengiriman, Pengiriman.Tanggal as tanggalPengiriman,Pengiriman.Tanggal_selesai,Pegawai.nama_pegawai as driver,Pegawai.no_tlp_pegawai');
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		$this->db->where('Order_Produk.Status',1);
		$this->db->where('Pembayaran.Status',2);
		$this->db->where('Order_Produk.Tanggal >=',$dari);
		$this->db->where('Order_Produk.Tanggal <=',$sampai);
		$this->db->join('Pembayaran','Pembayaran.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pengiriman','Pengiriman.ID_Order = Order_Produk.ID_Order','inner');
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get($this->table)->result();
	}

	public function getLaporanPengiriman($dari,$sampai,$status){
		$this->db->select('Order_Produk.*,produk.*,pelanggan.*,Pengiriman.ID_Pengiriman,Pengiriman.Status as statusPengiriman, Pengiriman.Tanggal as tanggalPengiriman,Pengiriman.Tanggal_selesai,Pegawai.nama_pegawai as driver,Pegawai.no_tlp_pegawai');
		$this->db->join('Order_Produk','Order_Produk.ID_Order = Pengiriman.ID_Order','inner');
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		if ($status != null) {
			$this->db->where('Pengiriman.Status',$status);
		}
		$this->db->where('Pengiriman.Tanggal >=',$dari);
		$this->db->where('Pengiriman.Tanggal <=',$sampai);
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get("Pengiriman")->result();
	}


	public function getPembayaran($ID_Order){
		$this->db->where('Pembayaran.ID_Order',$ID_Order);
		return $this->db->get('Pembayaran')->row();
	}

	public function create($data){
		$this->db->insert($this->table,$data);
	}
	public function create_pengiriman($data){
		$this->db->insert("Pengiriman",$data);
	}

	public function getOrderById($id){
		$this->db->where('Order_Produk.ID_Order',$id);
		$this->db->join('produk','produk.id_produk = Order_Produk.ID_Produk','inner');
		$this->db->join('pelanggan','pelanggan.id_pelanggan = Order_Produk.ID_Pelanggan','inner');
		return $this->db->get($this->table)->row();
	}

	public function update($data,$id){
		$this->db->where($this->primary,$id);
		$this->db->update($this->table,$data);
	}

	public function updatePengiriman($data,$id){
		$this->db->where("ID_Pengiriman",$id);
		$this->db->update("Pengiriman",$data);
	}

	public function generateCodeOrder(){
		$this->db->select('RIGHT(Order_Produk.ID_Order,4)as kode',FALSE);
		$this->db->order_by('ID_Order','DESC');
		$this->db->limit(1);
		$query = $this->db->get('Order_Produk');
		if ($query->num_rows()<>0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;

		}else{
			$kode = 1;
		}
		$kodemax = str_pad($kode,4,"000",STR_PAD_LEFT);
		$kodejadi = 'ORDER'.$kodemax;
		return $kodejadi;
	}
	public function generateCodePengiriman(){
		$this->db->select('RIGHT(Pengiriman.ID_Pengiriman,4)as kode',FALSE);
		$this->db->order_by('ID_Pengiriman','DESC');
		$this->db->limit(1);
		$query = $this->db->get('Pengiriman');
		if ($query->num_rows()<>0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;

		}else{
			$kode = 1;
		}
		$kodemax = str_pad($kode,4,"000",STR_PAD_LEFT);
		$kodejadi = 'SEND'.$kodemax;
		return $kodejadi;
	}

	public function getPengirimanByIdOrder($id_order){
		$this->db->where('ID_Order',$id_order);
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get('Pengiriman')->row();
	}

	public function getPengirimanById($ID_Pengiriman){
		$this->db->where('ID_Pengiriman',$ID_Pengiriman);
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = Pengiriman.ID_Pegawai','inner');
		return $this->db->get('Pengiriman')->row();
	}

	public function HapusOrder($id){
		$this->db->where($this->primary,$id);
		$this->db->delete($this->table);
	}

}
