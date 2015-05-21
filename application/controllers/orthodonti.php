<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orthodonti extends CI_Controller {
	var $profile_construct;
	public function __construct(){
        parent::__construct();
        session_start();
		if(!isset($_SESSION['id'])) redirect('homepage');
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
function do_upload(){
		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['orthodonti']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-orthodonti', $status['menu']);
			$this->load->view('result-orthodonti', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-orthodonti', $status['menu']);
			$this->load->view('result-orthodonti', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function list_reference($page = 1){
		$content="";
		$mengirim = new mengirim();
		$mengirim->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();	
		$lala = $pengguna->id;
		$mengirim->where('orto_id', $lala)->get_paged($page, 10);

		$data['array']=array('mengirim'=>$mengirim, 'orto_id'=>$lala);
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference', $data['array']);
		$this->load->view('footer');
	}

	public function reference_orthodonti($n){
		 	
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$mengirim = new mengirim();
		$mengirim->where('id', $n)->get();
		$analisis_id= $mengirim->analisis_id;
		$analisis = new analisi();
		$analisis->where('id', $analisis_id)->get();
		$nama_pusat = new pengguna();
		$nama_pusat->where('id', $mengirim->pusat_id)->get();
		$nama_admin = new pengguna();
		$nama_admin->where('id', $mengirim->admin_id)->get();
		$nama_pasien = new pasien();
		$nama_pasien->where('id', $analisis->pasien_id)->get();

		$mengirim1 = new mengirim();
		$mengirim1->where('id', $n)->update('flag_membaca', '2');
		$analisis1 = new analisi();
		$analisis1->where('id', $n)->update('flag_membaca', '2');

		$splitTimeStamp = explode(" ",$mengirim->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Date</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Admins name</b></td><td>'.$nama_admin->nama.'</td></tr>
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
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$analisis->foto.'"></center></tr></td>
			<tr><td><center><a class="btn btn-warning" href="../list_reference_drg">Back<a></center></td>
			<td><center><a class="btn btn-primary" href="../send_to_referral/'.$n.'">Send Reference<a></center></td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reference_orthodonti', $data['array']);
		$this->load->view('footer');
	}

		public function pasien1(){
	

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Name'];
			$Tempat_Lahir = $_POST['PlaceofBirth'];
			$Tanggal_Lahir = $_POST['DateofBirth'];
			$Umur = $_POST['Age'];
			$Alamat = $_POST['Address'];
			$Tinggi = $_POST['Height'];
			$Berat = $_POST['Weight'];
			$Jenis_Kelamin = $_POST['Gender'];
			$Warga_Negara = $_POST['Nationality'];
			$Agama = $_POST['Religion'];
			
			$Pasien = new pasien();
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			$idDokter = $pengguna->id;

			$Pasien->nama=$Nama;
			$Pasien->tempat_lahir=$Tempat_Lahir;
			$Pasien->tanggal_lahir=$Tanggal_Lahir;
			$Pasien->umur=$Umur;
			$Pasien->alamat_rumah=$Alamat;
			$Pasien->tinggi=$Tinggi;
			$Pasien->berat=$Berat;
			$Pasien->jenis_kelamin=$Jenis_Kelamin;
			$Pasien->warga_negara=$Warga_Negara;
			$Pasien->agama=$Agama;
			$Pasien->doktergigi_id=$idDokter;
			$Pasien->save();

			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Patient has been created.
									</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien1');
			$this->load->view('footer');
		}else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
			$this->load->view('header-orthodonti', $data['menu']);
			//$this->load->view('header-orthodonti');
			$this->load->view('pasien1');
			$this->load->view('footer');
		}
	}
	
	public function read($n){
	
		$Pasien = new pasien();
		$Merawat = new merawat();
		$Pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$Pasien->nama.'</td></tr>
			<tr><td><b>Date of Birth</b></td><td>'.$Pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$Pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$Pasien->umur.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$Pasien->agama.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$Pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$Pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$Pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$Pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$Pasien->warga_negara.'</td></tr>
			<tr><td><form method="post" action="../medical_record1/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Create Medical Record</button></form></td>
			<td><form method="post" action="../list_medical_record_ortho/'.$n.'"><button type="submit" class="btn btn-primary pull-right">View Medical Record</button></form></td>			
			</td></tr>');

		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('read_ortho', $data['array']); 
		$this->load->view('footer');
	}

	public function pasien_read_ortho($page = 1){
		
		$pasien = new pasien();
		$pasien->get();
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$idDokter=$pengguna->id;
		$pasien->order_by('id', 'desc');
		$pasien->where('doktergigi_id', $idDokter)->get_paged($page, 10);

		//$this->load->view('header-orthodonti');
		
		$data['array']=array('pasien'=>$pasien, 'doktergigi_id'=>$idDokter);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_read_ortho', $data['array']);
		$this->load->view('footer');
	}

	
	
	public function pasien_update(){
		
		$this->load->view('header-orthodonti');
		$this->load->view('pasien_update_ortho');
		$this->load->view('footer');
	}

	public function medical_record1($n){
		
		$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('medical_record1', $data['array']);
		$this->load->view('footer');
	}	

	function choose_image_orthodonti($n){
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('choose_image_orthodonti', $data['array']);
		$this->load->view('footer');
	}

	function upload_image_orthodonti($n){
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
			redirect("orthodonti/choose_image_orthodonti/$n");
			$data['array']=array('n'=>$n);
			$this->load->view('header-orthodonti', $status['menu']);
			$this->load->view('choose_image_orthodonti', $data['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/citra/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->get();

			$medical_record = new medical_record();
			$medical_record->where('id',$n)->update('foto', $temp);

			//$status['array']=array('content' => '<a href="../send_reference/'.$n.'">Send reference.</a>');

			$data['array']=array('n'=>$n);
					 			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> medical record has been created.
							</div>", 'content' => '<a href="../pasien_read_ortho">Back to patient list.</a>');
		 					$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('result-orthodonti');
		$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

			public function send_diagnose_to_admin($n){
	 if($_SERVER['REQUEST_METHOD'] == 'POST'){
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

		 		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
			$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}

	public function list_reference_drg(){
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference_drg');
		$this->load->view('footer');
	}

	public function send_data($n){
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
					 	$pengguna = new pengguna();
		 	$merawat = new merawat();

		 		// $pengguna->where('username', $_SESSION['orthodonti'])->get();
		 		// $id = $pengguna->id;
		 		// $merawat->pasien_id=$n;
		 		// $merawat->orto_id= $id;
		 		// $merawat->save();
		 	$pengguna->where('username', $_SESSION['orthodonti'])->get();
		 		$id = $pengguna->id;
		 		$merawat->medicalrecord_id=$n;
		 		$merawat->orto_id= $id;
		 		$medical_record = new medical_record();
		 		$medical_record->where('id', $n)->get();
		 		$merawat->pasien_id=$medical_record->pasien_id;
		 		$merawat->save();

			}
			$data['array'] = array('n' => $n);
		$data['array']= array('content' => '<a href ="../pasien_read_ortho">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been sent.
							</div>");
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('result-orthodonti', $data['array']);
		$this->load->view('footer');

	}

		public function pasien_update2_ortho($n){
		$pasien = new pasien();
		$pasien->where('id', $n)->get();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Umur = $_POST['Umur'];
			$Alamat = $_POST['Alamat_Rumah'];
			$Tinggi = $_POST['Tinggi'];
			$Berat = $_POST['Berat'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pasien = new pasien();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pasien->where('id', $n)->update('nama',$Nama);
			$pasien->where('id', $n)->update('tempat_lahir',$Tempat_Lahir);
			$pasien->where('id', $n)->update('tanggal_lahir',$Tanggal_Lahir);
			$pasien->where('id', $n)->update('umur',$Umur);
			$pasien->where('id', $n)->update('alamat_rumah',$Alamat);
			$pasien->where('id', $n)->update('tinggi',$Tinggi);
			$pasien->where('id', $n)->update('berat',$Berat);
			$pasien->where('id', $n)->update('warga_negara',$Warga_Negara);
			$pasien->where('id', $n)->update('agama',$Agama);

			$pasien->where('id', $n)->get();
			$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal' => '', 'inbox' => '', 'setting' => '');	
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien_update2_ortho', $data['array']);
			$this->load->view('footer');
		}else{
		$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_update2_ortho', $data['array']);
		$this->load->view('footer');
		}
	}


	public function delete1($id){
		$this->load->model('penggunas');
		$status = $this->penggunas->deletePasien($id);
		if($status)
			redirect("orthodonti/pasien_read_ortho");
	}

	
	public function list_pengguna(){
 		$pengguna = new pengguna();
		$pengguna->get();
		if($pengguna->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<thead><tr>
							<td><center><b><strong>Position</strong></b></center></td>
							<td><center><b><strong>Name</strong></b></center></td>
							<td><center><b><strong>Action</strong></b></center></td>
							</tr></thead>";
			foreach($pengguna as $row){

					$content .= "<tr>
									<td><center>".$row->role."</center></td>
									<td><center>".$row->nama."</center></td>
									<td><center><a class='btn btn-primary' href='../orthodonti/send_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> </center></td>
								</tr>";
				
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_pengguna', $data['array']);
		$this->load->view('footer');

	}



	public function view_message($page = 1){
		$content="";
		$pesan = new pesan();
		$pesan->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
 		$idPengguna = $pengguna->id;
 		$pesan->where('pengguna_id', $idPengguna)->get_paged($page, 10);

		
		
		$data['array']=array('pesan'=>$pesan, 'pengguna_id'=>$idPengguna);
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_message', $data['array']);
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


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('detail_message', $data['array']); 
		$this->load->view('footer');
	}

	public function view_reference($page = 1){
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$idDokter = $pengguna->id;

		// $pesan = new pesan();
		// $pesan->get();

		$mengirim = new mengirim();
		$mengirim->get();

		$rujukan = new rujukan();
		$rujukan->order_by('waktu', 'desc')->get();	
		$rujukan->where('orto_id', $idDokter)->get_paged($page, 10);

		
		
		$data['array']=array('rujukan'=>$rujukan, 'orto_id'=>$idDokter);
				

		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_reference', $data['array']);
		$this->load->view('footer');
	}

	public function detail_reference($n){
		$rujukan = new rujukan();
		$rujukan->where('id', $n)->get();

		$pasien = new pasien();
		$pasien->where('id', $rujukan->pasien_id)->get();

		$analisi = new analisi();
		$analisi->where('id', $rujukan->analisi_id)->get();

		$rujukan1 = new rujukan();
		$rujukan1->where('id', $n)->update('flag_membaca', '2');

		$profile="";
        $profile .="<br><img alt='140x140' src='../".$analisi->foto."' style='width:125px; height:125px;'>";

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$pasien->nama.'</td></tr>
			<tr><td><b>Birth Date</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Place of Birth</b></td><td>'.$pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Religion</b></td><td>'.$pasien->agama.'</td></tr>
			<tr><td><b>Age</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Height</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Weight</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Gender</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Address</b></td><td>'.$pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Nationality</b></td><td>'.$pasien->warga_negara.'</td></tr>
			<tr><td><center><b>Diagnose</b></center></td></tr>
			<tr><td><b>Image</b></td><td>'.$profile.'</td></tr>			
			<tr><td><b>Score</b></td><td>'.$analisi->skor.'</td></tr>	
			<tr><td><b>Malocclusion</b></td><td>'.$analisi->maloklusi_menurut_angka.'</td></tr>	
			<tr><td><b>Diagnose</b></td><td>'.$analisi->diagnosis_rekomendasi.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$rujukan->pesan.'</td></tr>	
		<tr><td><center><a class="btn btn-primary" href="../reply_message/'.$rujukan->id.'">Reply<a></center></td></tr>');
			

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('detail_reference', $data['array']); 
		$this->load->view('footer');
	}

	public function reply_message($n){
		$data['array'] = array('n'=>$n);	
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');		
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reply_message', $data['array']);
		$this->load->view('footer');
	}

	public function save_reply_message($n){
		$rujukan = new rujukan();
		$rujukan->where('id',$n)->get();

		$pesan = new pesan();

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$pesan->subject = $_POST['subject'];
			$pesan->isi = $_POST['isi'];
			$pesan->penerima_id=$rujukan->pengirim_id;
			$pesan->pengguna_id=$rujukan->orto_id;

			$pesan->validate();
			if($pesan->valid){

				$pesan->save();
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Message has been sent.
								</div>");
			}
			else{
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
								</div>");
			}
		}

		$data['array'] = array('n'=>$n);	
		//$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');		
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reply_message', $data['array']);
		$this->load->view('footer');
	}

	public function list_outbox_orthodonti($page = 1){
		$content="";
		$content1="";
		$content2="";
		$merawat = new merawat();
		$merawat->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		$lala = $pengguna->id;
		$pesan = new pesan();
		$pesan->get();
		$rujukan = new rujukan();
		$rujukan->get();

		$merawat->order_by('waktu', 'desc');
		$merawat->where('orto_id', $lala)->get_paged($page, 10);
		$pesan->order_by('waktu', 'desc');
		$pesan->where('pengguna_id', $lala)->get_paged($page, 10);
		$rujukan->order_by('waktu', 'desc');
		$rujukan->where('pengirim_id', $lala)->get_paged($page, 10);


		$data['array']=array('merawat' => $merawat, 'pesan' => $pesan, 'rujukan' => $rujukan, 'orto_id' => $lala, 'pengguna_id' => $lala, 'pengirim_id' => $lala);

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content, 'content1'=>$content1, 'content2'=>$content2);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_outbox_orthodonti', $data['array']);
		$this->load->view('footer');
	}

		public function view_merawat_orthodonti($n){
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$merawat = new merawat();
		$merawat->where('id', $n)->get();
		$pasien_id= $merawat->pasien_id;
		$pasien = new pasien();
		$pasien->where('id', $pasien_id)->get();
		$medical_record = new medical_record();
		$medical_record->where('id', $merawat->medicalrecord_id)->get();
		// $nama_pusat = new pengguna();
		// $nama_pusat->where('id', $mengirim->pusat_id)->get();
		// $nama_admin = new pengguna();
		// $nama_admin->where('id', $mengirim->admin_id)->get();
		// $nama_penerima = new pengguna();
		// $nama_penerima->where('id', $mengirim->umum_id)->get();
		// $nama_pasien = new pasien();
		// $nama_pasien->where('id', $merawat->pasien_id)->get();
		$splitTimeStamp = explode(" ",$merawat->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$merawat1 = new merawat();
		$merawat1->where('id', $n)->update('flag_outbox', '2');

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Recipient name</b></td><td>FKG UI</td></tr>
			<tr><td><b>Patients id</b></td><td>'.$merawat->pasien_id.'</td></tr>
			<tr><td><b>Patients name</b></td><td>'.$pasien->nama.'</td></tr>
			<tr><td><b>Patient Birth Date</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Patient Age</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Patient Height</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Patient Weight</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Patient Gender</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Medical Record ID</b></td><td>'.$medical_record->id.'</td></tr>
			<tr><td><b>Date Medical Record</b></td><td>'.$medical_record->tanggal.'</td></tr>
			<tr><td><b>Time Medical Record</b></td><td>'.$medical_record->jam.'</td></tr>
			<tr><td><center><img alt="140x140" src="../../../../'.$medical_record->foto.'" style="width:125px; height:125px;" class="img-circle"></center></tr></td>
			<tr><td><b>Description</b></td><td>'.$medical_record->deskripsi.'</td></tr>
			');

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_merawat_orthodonti', $data['array']);
		$this->load->view('footer');
	}

			public function outbox_message_orthodonti($n){
		$pesan = new pesan();
		$pesan->where('id', $n)->get();
		$pengguna = new pengguna();
		$pengguna->where('id',$pesan->pengguna_id)->get();
		$nama_penerima = new pengguna();
		$nama_penerima->where('id', $pesan->penerima_id)->get();
		//var_dump($pesan->waktu);
		$splitTimeStamp = explode(" ",$pesan->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$pesan1 = new pesan();
		$pesan1->where('id', $n)->update('flag_outbox', '2');
		//var_dump($date);

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Recipient id</b></td><td>'.$pesan->penerima_id.'</td></tr>
			<tr><td><b>Recipient Name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('outbox_message_orthodonti', $data['array']); 
		$this->load->view('footer');
	}

	public function view_rujukan_orthodonti($n){
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$rujukan = new rujukan();
		$rujukan->where('id', $n)->get();
		$pasien_id= $rujukan->pasien_id;
		$pasien = new pasien();
		$pasien->where('id', $pasien_id)->get();
		$analisi = new analisi();
		$analisi->where('id', $rujukan->analisi_id)->get();
		$pengguna1 = new pengguna();
		$pengguna1->where('id', $rujukan->orto_id)->get();
		$splitTimeStamp = explode(" ",$rujukan->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];

		$rujukan1 = new rujukan();
		$rujukan1->where('id', $n)->update('flag_outbox', '2');

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>Recipient ID</b></td><td>'.$rujukan->orto_id.'</td></tr>
			<tr><td><b>Recipient name</b></td><td>'.$pengguna1->nama.'</td></tr>
			<tr><td><b>Date</b></td><td>'.$rujukan->waktu.'</td></tr>
			<tr><td><b>Date</b></td><td>'.$rujukan->pesan.'</td></tr>
			<tr><td><b>Patients id</b></td><td>'.$rujukan->pasien_id.'</td></tr>
			<tr><td><b>Patients name</b></td><td>'.$pasien->nama.'</td></tr>
			<tr><td><b>Patient Birth Date</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Patient Age</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Patient Height</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Patient Weight</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Patient Gender</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Patient Diagnosis from</b></td><td>'.$analisi->orto_id.'</td></tr>
			<tr><td><b>Patient Par Scor</b></td><td>'.$analisi->skor.'</td></tr>
			<tr><td><b>Patient Maloclution</b></td><td>'.$analisi->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Patient Diagnosis</b></td><td>'.$analisi->diagnosis_rekomendasi.'</td></tr>
			');

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_rujukan_orthodonti', $data['array']);
		$this->load->view('footer');
	}

}
?>