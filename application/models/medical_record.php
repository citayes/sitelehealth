<?php
	class medical_record extends DataMapper {
		var $has_one = array('drg_lain');

		function validationMedicalRecord($attributes){
		if($attributes['tanggal']			!=0	&& $attributes['tanggal'] 			!= 1)	return false;
		if($attributes['jam']				!=0	&& $attributes['jam'] 				!= 1)	return false;
		if(strlen($attributes['deskripsi'])	< 1 || strlen($attributes['nama2']) 	> 500)	return false;
		return true;
	}
}
