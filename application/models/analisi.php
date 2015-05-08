<?php
	class analisi extends DataMapper {
		var $has_one = array('pasien','drg_ortodonti','pengguna');
		var $has_many=array('pengguna');

		function validationAnalisi($attributes){
		if(strlen($attributes['skor'])						< 1 || strlen($attributes['skor']) 						> 11)	return false;
		if(strlen($attributes['maloklusi_menurut_angka'])	< 1 || strlen($attributes['maloklusi_menurut_angka']) 	> 11)	return false;
		if(strlen($attributes['diagnosis_rekomendasi'])		< 1 || strlen($attributes['diagnosis_rekomendasi']) 	> 500)	return false;
		return true;
	}
}
