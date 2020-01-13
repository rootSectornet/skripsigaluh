<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class User_model extends CI_Model
{

	private $table = "Pegawai";
	private $primary = "ID_Pegawai";
	public function cek_user($data) {
		$query = $this->db->get_where($this->table, $data);
		return $query;
	}

	public function GetByUsername($username){
		$this->db->where("Pegawai.username",$username);
		$this->db->join('Jabatan','Jabatan.ID_Jabatan = Pegawai.id_jabatan','inner');
		return $this->db->get($this->table)->row();
	}
	function Read(){
		$this->db->join('Jabatan','Jabatan.Id_jabatan = Pegawai.id_jabatan','inner');
		return $this->db->get($this->table)->result();
	}
	function create($data){
		$this->db->insert($this->table,$data);
	}
	function getById($id){
		$this->db->where($this->primary,$id);
		$this->db->join('Jabatan','Jabatan.Id_jabatan = Pegawai.id_jabatan','inner');
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
	function getByJabatan($id_jabatan){
		$this->db->where('Pegawai.id_jabatan',$id_jabatan);
		return $this->db->get($this->table)->result();
	}

	function absen($data){
		$this->db->insert('Absen',$data);
	}
	function absen_pulang($id,$data){
		$this->db->where('id_pegawai',$id);
		$this->db->update('Absen',$data);
	}
	function getAbsen($id){
		$this->db->where('id_pegawai',$id);
		return $this->db->get('Absen')->row();
	}
}
