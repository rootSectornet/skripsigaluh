<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tanggal'))
{
	function tanggal($var = '')
	{
	$tgl = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$pecah = explode("-", $var);
	return $pecah[2]." ".$tgl[$pecah[1] - 1]." ".$pecah[0];
	}
	function umur($param = ''){
		// Tanggal Lahir
		$birthday = $param;

		// Convert Ke Date Time
		$biday = new DateTime($birthday);
		$today = new DateTime();

		$diff = $today->diff($biday);
		return  $diff->y ." Tahun ";
	}
	// All Method Btn
	function BtnView($link,$nama){
		return '<a href="'.base_url().$link.'" class="btn bg-blue btn-flat btn-sm" data-toggle="tooltip" data-placement="top" title="Detail '.$nama.'"><i class="fa fa-eye"></i> Detail</a>';
	}
	function BtnEdit($link,$nama){
		return '<a href="'.base_url().$link.'" class="btn btn-warning btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Edit '.$nama.'"><i class="fa fa-pencil"></i> Edit </a>';
	}
	function BtnDelete($link,$nama){
		return '<a href="'.base_url().$link.'" onclick="return ConfirmDialog()" class="btn btn-danger btn-flat btn-sm" data-toggle="tooltip" data-placement="top" title="Delete '.$nama.'"><i class="fa fa-trash"></i> Hapus</a>';
	}
	function BtnCreate($link,$nama){
		return '<a href="'.base_url().$link.'" class="btn btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="Tambah '.$nama.'"><i class="fa fa-plus"></i> Tambah</a>';
	}
	function BtnSave($nama){
		return '<button type="submit" nama="submit" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top" title="Simpan"><i class="fa fa-check"></i> '.$nama.'</button>';
	}
	function BtnBack($link){
		return '<a class="btn btn-danger btn-flat" href="'.base_url().$link.'" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fa fa-arrow-left"></i> Kembali</a>';
	}
	function BtnVerif($link,$nama){
		return '<a class="btn btn-info btn-flat" onclick="return ConfirmVerif()" href="'.base_url().$link.'" data-toggle="tooltip" data-placement="top" title="Verifikasi '.$nama.'"><i class="fa fa-check"></i></a>';
	}
	function BtnunVerif($link,$nama){
		return '<a class="btn btn-warning btn-flat" onclick="return ConfirmVerif()" href="'.base_url().$link.'" data-toggle="tooltip" data-placement="top" title="Batalkan Verifikasi '.$nama.'"><i class="fa fa-check"></i></a>';
	}
	function BtnPrint($link,$nama){
		return '<a class="btn btn-default btn-flat" href="'.base_url().$link.'" data-toggle="tooltip" data-placement="top" title="Print '.$nama.'"><i class="fa fa-print"></i></a>';
	}
	function AlertSuccess($message){
		return "<div class='alert bg-blue alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4><i class='icon fa fa-ban'></i> Information !!!</h4>".$message."</div>";
	}
	function AlertFailed($message){
		return "<div class='alert bg-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4><i class='icon fa fa-ban'></i> Information !!!</h4>".$message."</div>";
	}
	function IDR($amount){
		$angka_format = number_format($amount,2,",",".");
		return $angka_format;
	}
	//end all method btn


	function getAccess($string){
        $TC =& get_instance();
        if (!isset($TC->action)) {
            $TC->load->model('Group_access_model','action');
        }
        $tmp = $TC->action->search($string);
        if ($tmp) {
	        $cek = $TC->action->checkActionRole($_SESSION['data']->id_jabatan,$tmp->ID_Action);
	        return $cek;
        }else{
        	return false;
        }
    }


}
