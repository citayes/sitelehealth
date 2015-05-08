<?php
	class dokter_gigi extends DataMapper {
		var $has_many = array('pasien');
		var $has_one = array('pengguna', 'drg_lain', 'drg_ortodonti');

		function validationDokterGigi($attributes){
		if(strlen($attributes['Kursus'])		< 1 || strlen($attributes['Kursus']) 	> 100)	return false;
		if(strlen($attributes['Pendidikan'])		< 1 || strlen($attributes['Pendidikan']) 	> 100)	return false;
		if(strlen($attributes['Alamat'])			< 1 || strlen($attributes['Alamat']) 	> 100)	return false;
		if(strlen($attributes['Kodepos'])			< 1 || strlen($attributes['Kodepos']) 		> 100)	return false;
		return true;
	}
}
