
<?php
	class pesan extends DataMapper {
		var $has_one = array('pengguna');

		var $validation = array(
    	'subject' => array(
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 200)
    	),
    	'isi' => array(
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 1000)
    	),
    	'penerima_id' => array(
     	'rules' => array('required')
    	),
);

	}