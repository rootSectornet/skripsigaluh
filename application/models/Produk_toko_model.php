<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Produk_toko_model extends CI_Model
{

	private $table = "barang_toko";
	private $primary = "id_barang_toko";

	public function read($cari = null){
		$this->db->join('barang','barang.id_barang = barang_toko.id_barang','inner');
		$this->db->join('Toko','Toko.id_toko = barang_toko.id_toko','inner');
		return $this->db->get($this->table)->result();
	}

	public function create($data){
		$this->db->insert($this->table,$data);
	}

	public function getById($id){
		$this->db->where($this->primary,$id);
		return $this->db->get($this->table)->row();
	}
	public function update($data,$id){
		$this->db->where($this->primary,$id);
		$this->db->update($this->table,$data);
	}
	public function delete($id){
		$this->db->where($this->primary,$id);
		$this->db->delete($this->table);
	}

	// public function getStock($id){
	// 	$this->db->where($this->primary,$id);
	// 	$tmp =  $this->db->get($this->table)->row();
	// 	if ($tmp) {
	// 		return $tmp->stock;
	// 	}else{
	// 		return 0;
	// 	}
	// }

}
