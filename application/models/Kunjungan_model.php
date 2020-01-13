<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Kunjungan_model extends CI_Model
{

	private $table = "kunjungan";
	private $primary = "id_report_kunjungan";

	public function read(){
		$this->db->join('Toko','Toko.id_toko = kunjungan.id_toko','INNER');
		$this->db->join('Pegawai','Pegawai.ID_Pegawai = kunjungan.id_pegawai','INNER');
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

	 function upload_gambar($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    function update_gambar($data_kunjungan ,$data){
        foreach ($data as $key => $value) {
            $this->db->where('id_report_kunjungan',$value);
            $this->db->update('kunjungan',$data_kunjungan);
        }
    }

}
