<?php
	class jadwal_praktek extends DataMapper {
		var $has_one = array('drg_ortodonti');
		var $validation = array(
    	'jam_mulai' => array(
     	'rules' => array('required', 'numeric')
    	),
    	'jam_selesai' => array(
     	'rules' => array('required', 'numeric')
    	)
    	'drg_ortodonti_id' => array(
     	'rules' => array('required')
    	)
    );
}
