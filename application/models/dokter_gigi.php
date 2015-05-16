<?php
	class dokter_gigi extends DataMapper {
		var $has_many = array('pasien');
		var $has_one = array('pengguna', 'drg_lain', 'drg_ortodonti');

		var $validation = array(
<<<<<<< Updated upstream
        	'kursus' => array(
         	'rules' => array('max_length' => 100)
        	),
        	'pendidikan_dokter' => array(
         	'rules' => array('required', 'max_length' => 100)
        	),
        	'alamat_praktik' => array(
         	'rules' => array('required', 'max_length' => 100)
        	),
        	'kode_pos' => array(
         	'rules' => array('required', 'max_length' => 5, 'numeric')
        	),
            'longitude' => array(
            'rules' => array('required', 'max_length' => 50)
            ),
            'latitude' => array(
            'rules' => array('required', 'max_length' => 50)
            )
        );
    }
=======
    	'kursus' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'pendidikan_dokter' => array(
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'alamat_prakitk' => array(
     	'rules' => array('required', 'max_length' => 100)
    	),
    	'kode_pos' => array(
     	'rules' => array('required', 'numeric')
    	)
    );
}

				   
>>>>>>> Stashed changes
