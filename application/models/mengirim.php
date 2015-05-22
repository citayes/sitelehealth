<?php
	class mengirim extends DataMapper {
	var $validation = array(
    	'kandidat1' => array(
        'label' => 'first referral doctor',
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'kandidat2' => array(
        'label' => 'second referral doctor',
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat3' => array(
        'label' => 'third referral doctor',
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat4' => array(
        'label' => 'fourth referral doctor',
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat5' => array(
        'label' => 'fifth referral doctor',
     	'rules' => array('max_length' => 100)
    	),
        'pusat_id' => array(
        'label' => 'FKG UI id',
        'rules' => array('required')
        ),
        'analisis_id' => array(
        'label' => 'diagnosis id',
        'rules' => array('required')
        ),
    );
}
