<?php
	class analisi extends DataMapper {
		var $has_one = array('pasien','drg_ortodonti','pengguna');
		var $has_many=array('pengguna');

		var $validation = array(
    	'skor' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 0, 'less_than' => 10)
    	),
    	'maloklusi_menurut_angka' => array(
     	'rules' => array('required', 'numeric', 'greater_than' => 0, 'less_than' => 10)
    	),
    	'diagnosis_rekomendasi' => array(
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 500)
    	)
    );
}
