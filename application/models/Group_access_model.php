<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_access_model extends CI_Model{

	private $table = "Jabatan_akses";
	private $primary = "id_jabatan_akses";

	function search($string){
		$this->db->where('Action',$string);
		return $this->db->get('Action')->row();
	}

	function checkActionRole($idJb,$idAc){
		$this->db->where('id_jabatan',$idJb);
		$this->db->where('id_action',$idAc);
		$data = $this->db->get('Jabatan_akses')->row();
		if ($data) {
			return true;
		}else{
			return false;
		}
	}


}