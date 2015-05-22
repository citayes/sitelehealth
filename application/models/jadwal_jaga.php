<?php
	class jadwal_jaga extends DataMapper {
		var $has_one = array('drg_ortodonti','admin');
				var $validation = array(
    	'jam_mulai' => array(
        'label' => 'start hour',
     	'rules' => array('required')
    	),
    	'jam_selesai' => array(
        'label' => 'end hour',
     	'rules' => array('required')
    	),
    	'drg_ortodonti_id' => array(
        'label' => 'doctor',
     	'rules' => array('required')
    	)
    );

    //     var $validation = array(
    // 'Doctor' => array(
    //     'label' => 'Doctor',
    //     'rules' => array('required')
    // ),
    // 'Start' => array(
    //     'label' => 'Start',
    //     'rules' => array('required', 'numeric')
    // ),
    // 'End' => array(
    //     'label' => 'End',
    //     'rules' => array('required', 'numeric')
    // )
//);

	}

    