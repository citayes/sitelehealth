<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pusat extends CI_Controller {
	var $profile_construct;
	public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
    		session_start();
    	}
		if(!isset($_SESSION['pusat'])) redirect('homepage');
		$url = base_url();
		$pengguna = new pengguna();
        $pengguna->where('id', $_SESSION['id'])->get();
		$this->profile_construct ="";
        $this->profile_construct .="<br><center><img alt='140x140' src='".$url."".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
        <p><b>".$pengguna->nama."</b><br>
        <p>".$pengguna->username."<br>
        <p>".$pengguna->email."<br>
        <p>".$pengguna->role."</p></center>";
    }
	public function read2($n){
		$Pasien = new pasien();
		$Merawat = new merawat();
		$Merawat->where('id', $n)->get();
		$medical_record = new medical_record();
		$medical_record->where('id', $Merawat->medicalrecord_id)->get();
		$Pasien->where('id', $Merawat->pasien_id)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$Pasien->nama.'</td></tr>
			<tr><td><b>Date of Birth</b></td><td>'.$Pasien->tanggal_lahir.'</td`></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$Pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$Pasien->agama.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$Pasien->umur.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$Pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$Pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$Pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$Pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$Pasien->warga_negara.'</td></tr>
			<tr><td><b>Medical Record ID</b></td><td>'.$medical_record->id.'</td></tr>
			<tr><td><b>Date of Medical Record</b></td><td>'.$medical_record->tanggal.'</td></tr>
			<tr><td><b>Time of Medical Record</b></td><td>'.$medical_record->jam.'</td></tr>
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$medical_record->foto.'"></center></tr></td>
			<tr><td><b>Description</b></td><td>'.$medical_record->deskripsi.'</td></tr>
			<tr><td><form method="post" action="../send_diagnose_to_admin/'.$Merawat->pasien_id.'"><button type="submit" class="btn btn-primary pull-right">Send Diagnose to Admin</button></form></td>
			<td><form method="post" action="../create_diagnose/'.$Merawat->pasien_id.'"><button type="submit" class="btn btn-primary">Send Reference</button></form>
			<td><form method="post" action="../view_doctor/'.$Pasien->doktergigi_id.'"><button type="submit" class="btn btn-primary">View Doctor</button></form>
			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read2', $data['array']); 
		$this->load->view('footer');
	}


	public function read_data_citra($page = 1){		
		$pasien = new pasien();
		$pasien->get();

		$merawat = new merawat();
		//$merawat->get();
		$merawat->order_by('waktu', 'desc');
		$merawat->get_paged($page, 10);
		$data['array']=array('merawat' => $merawat);
				//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read_data_citra', $data['array']);
		$this->load->view('footer');
	}

function do_upload(){
		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['pusat']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('result-pusat', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('result-pusat', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function send_diagnose_to_admin($n){
		$data['array'] = array('n' => $n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}


		public function send_diagnose_to_admin_lagi($n){
		 	$skor = $_POST['skor'];
		 	$maloklusi_menurut_angka = $_POST['maloklusi_menurut_angka'];
		 	$diagnosis_rekomendasi = $_POST['diagnosis_rekomendasi'];
			
		 	$analisi = new analisi();
		 	$dokter_gigi = new dokter_gigi();
		 	$pengguna = new pengguna();

		 		$analisi->pasien_id=$n;
		 		$analisi->skor = $skor;
		 		$analisi->maloklusi_menurut_angka = $maloklusi_menurut_angka;
		 		$analisi->diagnosis_rekomendasi = $diagnosis_rekomendasi;

		 		$pengguna->where('username', $_SESSION['pusat'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->validate();
		 		if($analisi->valid){
		 			$analisi->save();
		//  			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
		// 					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		//   					<strong>Well done!</strong> Diagnose has been sent.
		// 					</div>");
		//  			// 'content' => '<a href="../read_data_citra">Back to patient list.</a>');
		//  					$this->load->view('header-pusat', $data['menu']);
		// $this->load->view('send_diagnose_to_admin');
		// $this->load->view('footer');
		 			redirect("pusat/choose_image_to_admin/$analisi->id");
		 		}
		 		else{
		 					//$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
							$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					Analisis not been created.".$analisi->error->skor."".$analisi->error->maloklusi_menurut_angka."".$analisi->error->diagnosis_rekomendasi."
									</div>");
									// 'content' => '<a href="../send_diagnose_to_admin/%n">Back to Diagnosis Form.</a>');
								$data['array'] = array('n' => $n);
								redirect("pusat/send_diagnose_to_admin/$n");
		//$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');
					}
		 		
									
		


		}

	function choose_image_to_admin($n){
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('choose_image_to_admin', $data['array']);
		$this->load->view('footer');
	}

	function upload_image_to_admin($n){
		$config['upload_path'] = './uploads/citra/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($n);
		//$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			echo $this->upload->display_errors();
			$status['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			//$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			redirect("pusat/choose_image_to_admin/$n");
			$data['array']=array('n'=>$n);
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('choose_image_to_admin', $data['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/citra/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->get();

			$analisi = new analisi();
			$analisi->where('id',$n)->update('foto', $temp);

			//$status['array']=array('content' => '<a href="../send_reference/'.$n.'">Send reference.</a>');

			$data['array']=array('n'=>$n);
					 			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra/1">Back to patient list.</a>');
		 					$this->load->view('header-pusat', $data['menu']);
		$this->load->view('result-pusat');
		$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}
	
	public function listrujukan($page = 1){

		$content ="";
		$merawat = new merawat();
		$merawat->order_by('id', 'desc');
		$merawat->get_paged($page, 10);
		$pasien= new pasien();
        $pengguna = new pengguna();
		
		
		$data['array']=array('merawat' => $merawat);
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('listrujukan', $data['array']);
		$this->load->view('footer');
	}	
	public function show_rujukan($n){

		$merawat = new merawat();
		$merawat->where('id', $n)->get();
		$pasien = new pasien();
		$pasien->where('id', $merawat->pasien_id)->get();
		$medical_record = new medical_record();
		$medical_record->where('id', $merawat->medicalrecord_id)->get();
		
		
		$pengguna = new pengguna();
		$pengguna->where('id', $merawat->umum_id)->get();
		$pengguna1 = new pengguna();
		$pengguna1->where('id', $merawat->orto_id)->get();

//		if($merawat->flag_membaca==1){
		$merawat1 = new merawat();
		$merawat1->where('id', $n)->update('flag_membaca', '2');

		$splitTimeStamp = explode(" ",$merawat->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

	

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>From Dentist</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>From Orthodontist</b></td><td>'.$pengguna1->nama.'</td></tr>
			<tr><td><b>Patient</b></td><td>'.$pasien->nama.'</td`></tr>
			<tr><td><b>Date of Birth</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$pasien->agama.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$pasien->warga_negara.'</td></tr>
			<tr><td><b>Medical Record ID</b></td><td>'.$medical_record->id.'</td></tr>
			<tr><td><b>Date Medical Record</b></td><td>'.$medical_record->tanggal.'</td></tr>
			<tr><td><b>Time Medical Record</b></td><td>'.$medical_record->jam.'</td></tr>
			
			<tr><td><b>Description</b></td><td>'.$medical_record->deskripsi.'</td></tr>
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$medical_record->foto.'"></center></tr></td>
			<td><form method="post" action="../view_doctor/'.$pasien->doktergigi_id.'"><button type="submit" class="btn btn-primary">View Doctor</button></form>


			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('show_rujukan', $data['array']); 
		$this->load->view('footer');
	}

	public function create_diagnose($n){
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('create_diagnose', $data['array']);
		$this->load->view('footer');
		
	}

	public function save_diagnose($n){
			$skor = $_POST['Skor'];
			$maloklusi= $_POST['Maloklusi'];
			$diagnose = $_POST['Diagnose'];
			//$foto = $_POST['Foto'];

			$analisi = new analisi();
			$rujukan = new rujukan();
			$pengguna = new pengguna();
			$merawat = new merawat();
			$mengirim = new mengirim();

			
			$analisi->pasien_id=$n;
			$analisi->skor=$skor;
			$analisi->maloklusi_menurut_angka=$maloklusi;
			$analisi->diagnosis_rekomendasi=$diagnose;
			$pengguna->where('username', $_SESSION['pusat'])->get();
			$analisi->orto_id=$pengguna->id;
			//$analisi->foto=$foto;

			$analisi->flag_mengirim='2';
			$analisi->save();

			$merawat->where('pasien_id', $n)->get();
			$mengirim->umum_id=$merawat->umum_id;
			$mengirim->pusat_id=$merawat->pusat_id;

			$analisi->flag_mengirim='2';
			$a = $analisi->id;
			$analisi->validate();
			if($analisi->valid){
				$analisi->save();
				redirect("pusat/choose_image/$a");

			}
			else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					Analisi has not been created.".$analisi->error->skor."".$analisi->error->maloklusi_menurut_angka."".$analisi->error->diagnosis_rekomendasi."
									</div>");	
				// echo $analisi->error->skor;
				// echo $analisi->error->maloklusi_menurut_angka;
				// echo $analisi->error->diagnosis_rekomendasi;
		 	$data['array']=array('n'=>$n);
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('create_diagnose', $data['array']);
			$this->load->view('footer');
			}
	}

	function choose_image($n){
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('choose_image', $data['array']);
		$this->load->view('footer');
	}

	function upload_image($n){
		$config['upload_path'] = './uploads/citra';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($n);
		//$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			echo $this->upload->display_errors();
			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			//$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$data['array']=array('n'=>$n);
			$this->load->view('header-pusat', $status['menu']);
			$this->load->view('choose_image', $data['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/citra/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->get();

			$analisi = new analisi();
			$analisi->where('id',$n)->update('foto', $temp);

			//$status['array']=array('content' => '<a href="../send_reference/'.$n.'">Send reference.</a>');

			$data['array']=array('n'=>$n);
			redirect("pusat/send_reference/$n");
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

		public function send_reference($n){
		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}		 

		//$data['array'] = array('n' => $n);
		$data['array'] = array('content' => $option, 'n'=> $n);	
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');				
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_reference', $data['array']);
		$this->load->view('footer');
	}

	public function save_reference($n){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$kandidat1 = $_POST['nama1'];
		 	$kandidat2 = $_POST['nama2'];
		 	$kandidat3 = $_POST['nama3'];
<<<<<<< HEAD
		 	$kandidat4 = $_POST['nama4'];
		 	$kandidat5 = $_POST['nama5'];

=======
>>>>>>> 330409d9f58a7c28f652d363ebf0aa6ca7da08b0
			$pengguna = new pengguna();
		 	$mengirim = new mengirim();
		 	$merawat = new merawat();
		 	$analisi = new analisi();
		 	

		 	$mengirim->kandidat1=$kandidat1;
		 	$mengirim->kandidat2=$kandidat2;
		 	$mengirim->kandidat3=$kandidat3;
		 	$mengirim->kandidat4=$kandidat4;
		 	$mengirim->kandidat5=$kandidat5;

		 	$pengguna->where('username', $_SESSION['pusat'])->get();		
		 	$mengirim->pusat_id= $pengguna->id;
		 	$analisi->where('id', $n);
		 	$analisi->order_by('id', 'desc')->get();

		 	$mengirim->analisis_id=$analisi->id;
	 	
	 		$merawat->where('pasien_id', $analisi->pasien_id)->get();
		 	$mengirim->umum_id=$merawat->umum_id;
			 	
		 	$mengirim->orto_id=$merawat->orto_id;
		 	$mengirim->pusat_id=$analisi->orto_id;
		 	
		 	$mengirim->validate();
		 	if($mengirim->valid){
		 		$mengirim->save();
		 		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		 	 				<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra/1">Back to patient list.</a>');
		 					$this->load->view('header-pusat', $data['menu']);
							$this->load->view('result-pusat');
							$this->load->view('footer');
		 	}

		 	else{
		 		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		 	 				Diagnose has not been sent.".$mengirim->error->kandidat1."".$mengirim->error->kandidat2."".$mengirim->error->kandidat3."".$mengirim->error->kandidat4."".$mengirim->error->kandidat5."".$mengirim->error->pusat_id."".$mengirim->error->analisis_id."
							</div>", 'content' => '<a href="../send_reference/$n">Back to reference form.</a>');
				// echo $mengirim->error->tanggal;
				// echo $mengirim->error->kandidat1;
				// echo $mengirim->error->kandidat2;
				// echo $mengirim->error->kandidat3;
				// echo $mengirim->error->kandidat4;
				// echo $mengirim->error->kandidat5;	
		 	$data['array']=array('n'=>$n);
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('send_reference', $data['array']);
			$this->load->view('footer');

		 	}						
		}
		//halo
	}

	public function view_doctor($m){
		$pengguna = new pengguna();
		$pengguna->where('id', $m)->get();
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $m)->get();

		$data['array'] = array('nama' => $pengguna->nama, 'email' =>  $pengguna->email, 'tanggallahir' => $pengguna->tanggal_lahir,
			'tempatlahir' => $pengguna->tempat_lahir, 'warganegara' => $pengguna->warga_negara, 'foto'=>$pengguna->foto, 'jeniskelamin' => $pengguna->jenis_kelamin,
			'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus, 'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat' => $dokter_gigi->alamat_praktik);
	
$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
	$this->load->view('header-pusat', $data['menu']);
	$this->load->view('view_doctor', $data['array']);
	$this->load->view('footer');
	}	

public function retrievejadwalp(){
		$jadwaljaga = new jadwal_jaga();
		$jadwaljaga-> get();
		$content="";
		if($jadwaljaga->result_count() != 0){
			$content = "<table class='table table-hover'>
						<thead>
						<tr>
							<td><center><b>Day</b><center></td>
							<td><center><b>Start Hour</center></b></td>
							<td><center><b>End Hour</center></b></td>
							<td><center><b>Doctor</center></b></td>
						</tr>
						</thead>";
			foreach($jadwaljaga as $row){
				$pengguna = new pengguna();
				$pengguna-> where('id',$row->drg_ortodonti_id)->get();
					$content .= "<tr><td><center>".$row->hari."</center></a></td>
								 <td><center>".$row->jam_mulai."</center></td>
								 <td><center>".$row->jam_selesai."</center></td>
								 <td><center>".$pengguna->nama."</center></td>
								 </center></td></tr>";
			}
			$content .=  "</table>";
			$data['array']=array('content'=>$content);
		}
		else{
			$data['array']=array();
		}
		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('retrievejadwalp', $data['array']);
		$this->load->view('footer');
	}

	public function list_outbox_fkg($page = 1){
		$content="";
		$content1="";
		$content2="";
		$mengirim = new mengirim();
		$mengirim->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['pusat'])->get();		
		$lala = $pengguna->id;
		$pesan = new pesan();
		$pesan->get();
		$analisi = new analisi();
		$analisi->get();

		$mengirim->order_by('waktu', 'desc');
		$mengirim->where('pusat_id', $lala)->get_paged($page, 10);
		$pesan->order_by('waktu', 'desc');
		$pesan->where('pengguna_id', $lala)->get_paged($page, 10);
		$analisi->order_by('waktu', 'desc');
		$analisi->where('orto_id', $lala)->get_paged($page, 10);

		$data['array']=array('mengirim' => $mengirim, 'pesan' => $pesan, 'analisi' => $analisi, 'pusat_id' => $lala, 'pengguna_id' => $lala,'orto_id' => $lala);
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content, 'content1'=>$content1, 'content2'=>$content2);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('list_outbox_fkg', $data['array']);
		$this->load->view('footer');
	}

	public function view_reference_fkg($n){
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['pusat'])->get();
		$mengirim = new mengirim();
		$mengirim->where('id', $n)->get();
		$analisis_id= $mengirim->analisis_id;
		$analisis = new analisi();
		$analisis->where('id', $analisis_id)->get();
		$nama_pusat = new pengguna();
		$nama_pusat->where('id', $mengirim->pusat_id)->get();
		$nama_admin = new pengguna();
		$nama_admin->where('id', $mengirim->admin_id)->get();
		$nama_penerima = new pengguna();
		$nama_penerima->where('id', $mengirim->umum_id)->get();
		$nama_pasien = new pasien();
		$nama_pasien->where('id', $analisis->pasien_id)->get();

		$mengirim1 = new mengirim();
		$mengirim1->where('id', $n)->update('flag_outbox', '2');

		$splitTimeStamp = explode(" ",$mengirim->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>

			<tr><td><b>Recipient id</b></td><td>'.$mengirim->umum_id.'</td></tr>
			<tr><td><b>Recipient name</b></td><td>'.$nama_penerima->nama.'</td></tr>

			<tr><td><b>FKG Doctors name</b></td><td>'.$nama_pusat->nama.'</td></tr>
			<tr><td><b>Patients id</b></td><td>'.$analisis->pasien_id.'</td></tr>
			<tr><td><b>Patients name</b></td><td>'.$nama_pasien->nama.'</td></tr>
			<tr><td><b>PAR Scor</b></td><td>'.$analisis->skor.'</td></tr>
			<tr><td><b>Maloklusi</b></td><td>'.$analisis->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Diagnosis</b></td><td>'.$analisis->diagnosis_rekomendasi.'</td></tr>
		
			<tr><td><b>Kandidat 1</b></td><td>'.$mengirim->kandidat1.'</td></tr>
			<tr><td><b>Kandidat 2</b></td><td>'.$mengirim->kandidat2.'</td></tr>
			<tr><td><b>Kandidat 3</b></td><td>'.$mengirim->kandidat3.'</td></tr>
			<tr><td><b>Kandidat 4</b></td><td>'.$mengirim->kandidat4.'</td></tr>
			<tr><td><b>Kandidat 5</b></td><td>'.$mengirim->kandidat5.'</td></tr>
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$analisis->foto.'"></center></tr></td>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('view_reference_fkg', $data['array']);
		$this->load->view('footer');
	}

		public function outbox_message_fkg($n){
		$pesan = new pesan();
		$pesan->where('id', $n)->get();
		$pengguna = new pengguna();
		$pengguna->where('id',$pesan->pengguna_id)->get();
		$nama_penerima = new pengguna();
		$nama_penerima->where('id', $pesan->penerima_id)->get();

		$pesan1 = new pesan();
		$pesan1->where('id', $n)->update('flag_outbox', '2');

		$splitTimeStamp = explode(" ",$pesan->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Recipient id</b></td><td>'.$pesan->penerima_id.'</td></tr>
			<tr><td><b>Recipient Name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('outbox_message_fkg', $data['array']); 
		$this->load->view('footer');
	}

	
	public function view_diagnosis_fkg($n){
		$pengguna = new pengguna();

		$pengguna->where('username', $_SESSION['pusat'])->get();
		//$analisis_id= $mengirim->analisis_id;
		$analisis = new analisi();
		$analisis->where('id', $n)->get();
		$nama_admin = new pengguna();
		//$nama_admin->where('id', $mengirim->admin_id)->get();
		$nama_pasien = new pasien();
		$nama_pasien->where('id', $analisis->pasien_id)->get();

		$analisis1 = new analisi();
		$analisis1->where('id', $n)->update('flag_outbox', '2');

		$splitTimeStamp = explode(" ",$analisis->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Recipient name</b></td><td>Admin</td></tr>
			<tr><td><b>Patients id</b></td><td>'.$analisis->pasien_id.'</td></tr>
			<tr><td><b>Patients name</b></td><td>'.$nama_pasien->nama.'</td></tr>
			<tr><td><b>PAR Scor</b></td><td>'.$analisis->skor.'</td></tr>
			<tr><td><b>Maloklusi</b></td><td>'.$analisis->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Diagnosis</b></td><td>'.$analisis->diagnosis_rekomendasi.'</td></tr>
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$analisis->foto.'"></center></tr></td>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('view_diagnosis_fkg', $data['array']);
		$this->load->view('footer');
	}	


		public function view_message(){
		$content="";
		$pesan = new pesan();
		$pesan->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['pusat'])->get();		
 		$idPengguna = $pengguna->id;
		$content .= '<table class="table">
				<tr>
					<td><center><b>Date</center></b></td>
					<td><center><b>From</center></b></td>
					<td><center><b>Subject</center></b></td>
					<td><center><b>Action</center></b></td>
				</tr>';				
		foreach($pesan as $row){
			if($row->penerima_id==$idPengguna && $row->flag_membaca!=1){
				$nama_pengirim = new pengguna();
				$nama_pengirim->where('id', $row->pengguna_id)->get();
				$content .= "<tr><td><center>".$row->waktu."</center></a></td>
								<td><center>".$nama_pengirim->nama."</center></a></td>
								<td><center>".$row->subject."</center></td>
								<td><center><a class='btn btn-primary' href='../pusat/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td>
							</tr>";
			}
			else if($row->penerima_id==$idPengguna && $row->flag_membaca==1){
				$nama_pengirim = new pengguna();
				$nama_pengirim->where('id', $row->pengguna_id)->get();
				$content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
								<td><b><center>".$nama_pengirim->nama."</center></b></a></td>
								<td><b><center>".$row->subject."</center></b></td>
								<td><center><b><a class='btn btn-primary' href='../pusat/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></b></center></td>
							</tr>";
			}
		}
		$content.='</table>';
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct,'jadwal'=>'', 'setting' => '', 'content'=>$content);
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('view_message_pusat');
		$this->load->view('footer');
	} 
	
		public function detail_message($n){
		$pesan = new pesan();
		$pesan->where('id', $n)->get();
		$pengguna = new pengguna();
		$pengguna->where('id',$pesan->pengguna_id)->get();
		$pesan1 = new pesan();
		$pesan1->where('id', $n)->update('flag_membaca', '2');
		$data['array'] = array('content' => '<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'', 'setting' => '');

		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('detail_message_pusat', $data['array']); 
		$this->load->view('footer');
	}
	
}
?>