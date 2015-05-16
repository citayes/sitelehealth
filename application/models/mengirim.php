<?php
	class mengirim extends DataMapper {
	var $validation = array(
    	'kandidat1' => array(
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'kandidat2' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat3' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat4' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'kandidat5' => array(
     	'rules' => array('max_length' => 100)
    	),
    );
}
