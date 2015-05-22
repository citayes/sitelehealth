<?php
	class merawat extends DataMapper {
	var $validation = array(
		'pasien_id' => array(
        'label' => 'patient id',
        'rules' => array('required')
        ),
        'medicalrecord_id' => array(
        'label' => 'medical record id',
        'rules' => array('required')
        ),
	);
}
