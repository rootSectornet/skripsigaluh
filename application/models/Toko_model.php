<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Toko_model extends CI_Model
{

	private $table = "Toko";
	private $primary = "id_toko";

	public function read($cari = null){
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
