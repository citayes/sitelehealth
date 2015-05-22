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
        'label' => 'name',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 100)
    	),
    	'tempat_lahir' => array(
        'label' => 'place of birth',
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'tanggal_lahir' => array(
        'label' => 'date of birth',
     	'rules' => array('required', 'valid_date')
    	),
    	'umur' => array(
        'label' => 'age',
     	'rules' => array('required',  'numeric', 'greater_than' => 0, 'less_than' => 150)
    	),
    	'alamat_rumah' => array(
        'label' => 'address',
     	'rules' => array('max_length' => 100)
    	),
    	'tinggi' => array(
        'label' => 'height',
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' => 300 )
    	),
    	'berat' => array(
        'label' => 'weight',
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' => 400)
    	),
    	'jenis_kelamin' => array(
        'label' => 'gender',
     	'rules' => array('required')
    	),
    	'warga_negara' => array(
        'label' => 'nationality',
     	'rules' => array('max_length' => 100)
    	),
    	'agama' => array(
        'label' => 'religion',
     	'rules' => array('max_length' => 100)
    	)
    );
}
