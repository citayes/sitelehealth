<?php
class pengguna extends DataMapper {
	var $has_many = array('mengirim', 'analisi', 'pesan');
	var $has_one = array('dokter_gigi', 'admin'); 

	var $validation = array(
    	'username' => array(
        'label' => 'username',
     	'rules' => array('required', 'min_length' => 4, 'max_length' => 20, 'unique', 'alpha_dash_dot')
    	),
    	'password' => array(
        'label' => 'password',
     	'rules' => array('required', 'min_length' => 4, 'max_length' => 20)
    	),
    	'nama' => array(
        'label' => 'name',
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 100)
    	),
    	'tanggal_lahir' => array(
        'label' => 'date of birth',
     	'rules' => array('required', 'valid_date')
    	),
    	'tempat_lahir' => array(
        'label' => 'place of birth',
     	'rules' => array('max_length' => 100)
    	),
    	'warga_negara' => array(
        'label' => 'nationality',
     	'rules' => array('max_length' => 100)
    	),
    	'jenis_kelamin' => array(
        'label' => 'gender',
     	'rules' => array('required')
    	),
    	'agama' => array(
        'label' => 'religion',
     	'rules' => array('max_length' => 100)
    	),
    	'email' => array(
        'label' => 'email',
     	'rules' => array('required', 'valid_email')
    	),
    	'role' => array(
        'label' => 'role',
     	'rules' => array('required')
    	)
    );

		function remove($id){
		$pengguna = new pengguna();
		$pengguna->get();

		//$sql = "DELETE FROM `penggunas` WHERE `id` = $id";
		$sql = "delete from penggunas where id = '$id'";
		$pengguna->query($sql);
	}
}
?>
