<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Pembayaran_model extends CI_Model
{

	private $table = "Pembayaran";
	private $primary = "ID_Pembayaran";



	public function generateCodePembayaran(){
		$this->db->select('RIGHT(Pembayaran.ID_Pembayaran,5)as kode',FALSE);
		$this->db->order_by('ID_Pembayaran','DESC');
		$this->db->limit(1);
		$query = $this->db->get('Pembayaran');
		if ($query->num_rows()<>0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;

		}else{
			$kode = 1;
		}
		$kodemax = str_pad($kode,5,"000",STR_PAD_LEFT);
		$kodejadi = 'INV'.$kodemax;
		return $kodejadi;
	}

	
	public function create($data){
		$this->db->insert($this->table,$data);
	}

	public function getByIdOrder($idOrder){
		$this->db->where('ID_Order',$idOrder);
		return $this->db->get($this->table)->row();
	}


	public function getById($id){
		$this->db->where($this->primary,$id);
		return $this->db->get($this->table)->row();
	}
	public function update($data,$id){
		$this->db->where($this->primary,$id);
		$this->db->update($this->table,$data);
	}

}
