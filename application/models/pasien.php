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

	var $validation = array(
    	'nama' => array(
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 100)
    	),
    	'tempat_lahir' => array(
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'tanggal_lahir' => array(
     	'rules' => array('required', 'valid_date')
    	),
    	'umur' => array(
     	'rules' => array('required',  'numeric', 'greater_than' => 1, 'less_than' => 150)
    	),
    	'alamat_rumah' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'tinggi' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' => 300 )
    	),
    	'berat' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' => 400)
    	),
    	'jenis_kelamin' => array(
     	'rules' => array('required')
    	),
    	'warga_negara' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'agama' => array(
     	'rules' => array('max_length' => 100)
    	)
    );
}
