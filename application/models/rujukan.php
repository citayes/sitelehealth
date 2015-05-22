<?php
	class rujukan extends DataMapper {
	var $validation = array(
		'pasien_id' => array(
        'label' => 'patient id',
        'rules' => array('required')
        ),
        'analisis_id' => array(
        'label' => 'diagnosis id',
        'rules' => array('required')
        ),
        'orto_id' => array(
        'label' => 'referral',
        'rules' => array('required')
        ),
    );
	}
