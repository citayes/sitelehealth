<?php
class pengguna extends DataMapper {
	var $has_many = array('mengirim', 'analisi', 'pesan');
	var $has_one = array('dokter_gigi', 'admin'); 

	var $validation = array(
    	'username' => array(
     	'rules' => array('required', 'min_length' => 4, 'max_length' => 20, 'unique', 'alpha_dash_dot')
    	),
    	'password' => array(
     	'rules' => array('required', 'min_length' => 4, 'max_length' => 20)
    	),
    	'nama' => array(
     	'rules' => array('required', 'min_length' => 1, 'max_length' => 100)
    	),
    	'tanggal_lahir' => array(
     	'rules' => array('required', 'valid_date')
    	),
    	'tempat_lahir' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'warga_negara' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'jenis_kelamin' => array(
     	'rules' => array('required')
    	),
    	'agama' => array(
     	'rules' => array('max_length' => 100)
    	),
    	'email' => array(
     	'rules' => array('required', 'valid_email')
    	),
    	'role' => array(
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
