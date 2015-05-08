<?php
class pengguna extends DataMapper {
	var $has_many = array('mengirim', 'analisi');
	var $has_one = array('dokter_gigi', 'admin');

		function remove($id){
		$pengguna = new pengguna();
		$pengguna->get();

		//$sql = "DELETE FROM `penggunas` WHERE `id` = $id";
		$sql = "delete from penggunas where id = '$id'";
		$pengguna->query($sql);
	}

		function validationPengguna($attributes){
		if(strlen($attributes['Username'])		< 1 || strlen($attributes['Username']) 	> 20)	return false;
		if(strlen($attributes['Password'])		< 5 || strlen($attributes['Password']) 	> 20)	return false;
		if(strlen($attributes['Email'])			< 1 || strlen($attributes['Password']) 	> 100)	return false;
		if(strlen($attributes['Nama'])			< 1 || strlen($attributes['Nama']) 		> 100)	return false;
		if(strlen($attributes['Tempat_Lahir'])	< 1 || strlen($attributes['Tempat_Lahir']) 	> 100)	return false;
		if($attributes['Tanggal_Lahir']			!=0	&& $attributes['Tanggal_Lahir'] 		!= 1)	return false;
		if($attributes['Jenis_Kelamin'] != "Lakilaki"	&& $attributes['Jenis_Kelamin'] != "Perempuan")	return false;
		if(strlen($attributes['Warga_Negara'])	< 1 || strlen($attributes['Warga_Negara']) 	> 100)	return false;
		if(strlen($attributes['Agama'])			< 1 || strlen($attributes['Agama']) 		> 100)	return false;
		if($attributes['Role'] != "admin"	&& $attributes['Role'] != "pusat" && $attributes['Role'] != "orthodonti" && $attributes['Role'] != "umum")	return false;
		return true;
	}

}
?>