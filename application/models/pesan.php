
<?php
	class pesan extends DataMapper {
		var $has_one = array('pengguna');

		var $validation = array(
    	'subject' => array(
        'label' => 'subject',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 200)
    	),
    	'isi' => array(
        'label' => 'Message',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 1000)
    	),
    	'penerima_id' => array(
        'label' => 'Recipient id',
     	'rules' => array('required')
    	),
        'pengguna_id' => array(
        'label' => 'Sender id',
        'rules' => array('required')
        ),
);

	}