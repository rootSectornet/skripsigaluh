<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Pelanggan_model extends CI_Model
{

	private $table = "pelanggan";
	private $primary = "id_pelanggan";
	public function cek_user($data) {
		$query = $this->db->get_where($this->table, $data);
		return $query;
	}

	public function GetByEmail($email){
		$this->db->where("pelanggan.email",$email);
		return $this->db->get($this->table)->row();
	}
	function Read(){
		return $this->db->get($this->table)->result();
	}
	function create($data){
		$this->db->insert($this->table,$data);
	}
	function getById($id){
		$this->db->where($this->primary,$id);
		return $this->db->get($this->table)->row();
	}
	function update($data,$id){
		$this->db->where($this->primary,$id);
		$this->db->update($this->table,$data);
	}
	function delete($id){
		$this->db->where($this->primary,$id);
		$this->db->delete($this->table);
	}
}
