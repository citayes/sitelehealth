<?php
	class jadwal_jaga extends DataMapper {
		var $has_one = array('drg_ortodonti','admin');
				var $validation = array(
    	'jam_mulai' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' =>24)
    	),
    	'jam_selesai' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 1, 'less_than' =>24)
    	),
    	'drg_ortodonti_id' => array(
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

    