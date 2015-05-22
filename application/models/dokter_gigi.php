<?php
	class dokter_gigi extends DataMapper {
		var $has_many = array('pasien');
		var $has_one = array('pengguna', 'drg_lain', 'drg_ortodonti');

		var $validation = array(
        	'kursus' => array(
            'label' => 'course',
         	'rules' => array('max_length' => 100)
        	),
        	'pendidikan_dokter' => array(
            'label' => 'last_education',
         	'rules' => array('required', 'max_length' => 100)
        	),
        	'alamat_praktik' => array(
            'label' => 'clinic address',
         	'rules' => array('required', 'max_length' => 100)
        	),
        	'kode_pos' => array(
            'label' => 'postal code',
         	'rules' => array('required', 'numeric', 'max_length' => 10)
        	)
            // 'longitude' => array(
            // 'rules' => array('required', 'max_length' => 50)
            // ),
            // 'latitude' => array(
            // 'rules' => array('required', 'max_length' => 50)
            // )
        );
    }