<?php
	class medical_record extends DataMapper {
		var $has_one = array('drg_lain');


		var $validation = array(
    	'tanggal' => array(
        'label' => 'date',
     	'rules' => array('required', 'valid_date')
    	),
    	'jam' => array(
        'label' => 'time',
     	'rules' => array('numeric', 'max_length' => 100)
    	),
    	'deskripsi' => array(
        'label' => 'description',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 1000)
    	)
    );
}
