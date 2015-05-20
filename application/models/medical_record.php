<?php
	class medical_record extends DataMapper {
		var $has_one = array('drg_lain');


		var $validation = array(
    	'tanggal' => array(
        'label' => 'Date',
     	'rules' => array('required', 'valid_date')
    	),
    	'jam' => array(
        'label' => 'Time',
     	'rules' => array('numeric', 'max_length' => 100)
    	),
    	'deskripsi' => array(
        'label' => 'Description',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 500)
    	)
    );
}
