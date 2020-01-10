<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Kategori_model extends CI_Model
{

	private $table = "kategori";
	private $primary = "id_kategori";

	public function read(){
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

}
