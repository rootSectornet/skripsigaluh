<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jabatan_model extends CI_Model{

	private $table = "Jabatan";
	private $primary = "Id_jabatan";

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