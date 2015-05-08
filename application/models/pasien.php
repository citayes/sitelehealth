<?php
	class pasien extends DataMapper {
		var $has_many = array('analisi', 'medical_record','dokter_gigi');

				function remove($id){
		$pasien = new pasien();
		$pasien->get();

		//$sql = "DELETE FROM `penggunas` WHERE `id` = $id";
		$sql = "delete from pasiens where id = '$id'";
		$pasien->query($sql);
	}

	function validationPasien($attributes){
		if(strlen($attributes['Name'])			< 1 || strlen($attributes['Name']) 			> 100)	return false;
		if(strlen($attributes['PlaceofBirth'])	< 1 || strlen($attributes['PlaceofBirth']) 	> 100)	return false;
		if(strlen($attributes['Weight'])		< 1 || strlen($attributes['Weight']) 		> 100)	return false;
		if(strlen($attributes['Age'])			< 1 || strlen($attributes['Age']) 			> 4)	return false;
		if(strlen($attributes['Address'])		< 1 || strlen($attributes['Address']) 		> 100)	return false;
		if($attributes['DateofBirth']			!=0	&& $attributes['DateofBirth'] 			!= 1)	return false;
		if($attributes['Gender'] != "Lakilaki"	&& $attributes['Gender']					 != "Perempuan") return false;
		if(strlen($attributes['Height'])		< 1 || strlen($attributes['Height']) 		> 11)	return false;
		if(strlen($attributes['Nationality'])	< 1 || strlen($attributes['Nationality']) 	> 100)	return false;
		if(strlen($attributes['Religion'])		< 1 || strlen($attributes['Religion']) 		> 100)	return false;
		return true;
	}
}
