<?php
	class mengirim extends DataMapper {
		function validationMengirim($attributes){
		if($attributes['tanggal']			!=0	&& $attributes['tanggal'] 			!= 1)	return false;
		if(strlen($attributes['nama1'])		< 1 || strlen($attributes['nama2']) 	> 100)	return false;
		if(strlen($attributes['nama2'])		< 1 || strlen($attributes['nama2']) 	> 100)	return false;
		if(strlen($attributes['nama3'])		< 1 || strlen($attributes['nama3']) 	> 100)	return false;
		if(strlen($attributes['nama4'])		< 1 || strlen($attributes['nama4']) 	> 100)	return false;
		if(strlen($attributes['nama'])		< 1 || strlen($attributes['nama']) 		> 100)	return false;
		return true;
	}
}
