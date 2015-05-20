<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DRG extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$data['menu'] = array('home' => 'active', 'pasien' => '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('drg');
		$this->load->view('footer');
	}
	public function pasien(){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");		

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
		

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->get();
			$idDokter = $pengguna->id;
			$Pasien = new pasien();
			
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
			//$Pasien->save();

			$Pasien->validate();
			if($Pasien->valid){
				$Pasien->save();
							$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Patient has been created.
									</div>");

			}
			else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					Patient has not been created. ".$Pasien->error->nama." ".$Pasien->error->tempat_lahir." ".$Pasien->error->tanggal_lahir." ".$Pasien->error->umur." ".$Pasien->error->alamat_rumah." ".$Pasien->error->tinggi." ".$Pasien->error->berat." ".$Pasien->error->jenis_kelamin."".$Pasien->error->warga_negara."".$Pasien->error->agama."
									</div>");	
			}


			$this->load->view('header-drg', $data['menu']);
			$this->load->view('pasien');
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien');
		$this->load->view('footer');
		}
	}

		public function edit_profile(){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$id = $pengguna->id;
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $id)->get();
		$drg_lain = new drg_lain();
		$drg_lain->where('pengguna_id', $id)->get();
		//echo $drg_lain->where('pengguna_id', $id)->pengguna_id;

		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pengguna = new pengguna();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pengguna->where('username', $_SESSION['drg'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['drg'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['drg'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['drg'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['drg'])->update('agama',$Agama);
			$dokter_gigi= new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);
			$drg_lain = new drg_lain();
			$drg_lain->where('pengguna_id', $id)->update('kursus_ortodonti', $_POST['kursus_orthodonti']);
			$drg_lain->where('pengguna_id', $id)->update('jadwal_praktik', $_POST['jadwal']);

			$pengguna->where('username', $_SESSION['drg'])->get();
			$id = $pengguna->id;
			$dokter_gigi->where('pengguna_id', $id)->get();
			$drg_lain->where('pengguna_id', $id)->get();


			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('edit_profile-drg', $data['array']);
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('edit_profile-drg', $data['array']);
		$this->load->view('footer');
		}

	
	}
	
	public function read($n){
		 session_start();
		 if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$pasien = new pasien();
		//$pasien->get();
		$pasien->where('id', $n)->get();

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
			<tr><td><form method="post" action="../medical_record/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Add Medical Record</button></form></td>
			<td><form method="post" action="../list_medical_record/'.$n.'"><button type="submit" class="btn btn-primary pull-right">View Medical Record</button></form></td>
			
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('read', $data['array']); 
		$this->load->view('footer');
	}

	public function pasien_read($page = 1){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$idDokter = $pengguna->id;
		$pasien = new pasien();
		$pasien->order_by('id', 'desc');
		$pasien->where('doktergigi_id', $idDokter)->get_paged($page, 10);
		
		$data['array']=array('pasien'=>$pasien, 'doktergigi_id'=>$idDokter);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_read', $data['array']);
		$this->load->view('footer');
	}


	public function pasien_delete(){
		session_start();
		 if(!isset($_SESSION['drg']))
		 	redirect ("homepage");

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_delete');
		$this->load->view('footer');
	}

	public function change(){
		session_start();
		 if(!isset($_SESSION['drg']))
		 	redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['drg']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['drg'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-drg', $data['menu']);
							$this->load->view('changepassword-drg');
							$this->load->view('footer');
						}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  					<strong>Warning!</strong> Wrong new password.
										</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword-drg');
						$this->load->view('footer');
						}
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
					$this->load->view('header-drg', $data['menu']);
					$this->load->view('changepassword-drg');
					$this->load->view('footer');
					}
				}
			}
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('changepassword-drg');
		$this->load->view('footer');
		}	
	}
	public function logout(){
			session_start();
			//hapus session
			session_destroy();
			//alihkan kehalaman login (index.php)
			redirect('homepage');
		}
	
		function do_upload(){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['drg']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-drg', $status['menu']);
			$this->load->view('result-drg', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-drg', $status['menu']);
			$this->load->view('result-drg', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

	public function medical_record($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");

		$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('medical_record', $data['array']);
		$this->load->view('footer');
	}	

	public function list_medical_record($n, $page = 1){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		  
		
		//echo $n;
		$medical_record = new medical_record();
		$pasien = new pasien();
		//$medical_record->order_by('tanggal', 'desc')->get();

		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$idDokter = $pengguna->id;

		$medical_record->order_by('tanggal', 'desc');
		$medical_record->get_paged($page, 10);
		//echo $medical_record;

		//if($medical_record->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<thead><tr>
							<td><center><b><strong>ID Medical Record</strong></b></center></td>
							<td><center><b><strong>Date</strong></b></center></td>
							<td><center><b><strong>Operation</strong></b></center></td>
							</tr></thead>";
			foreach($medical_record as $row){
				if($row->dokter_gigi_id == $idDokter && $row->pasien_id==$n){
					//echo $row->doktergigi_id;
					//echo $idDokter;
					$content .= "<tr>

								<td><center>".$row->id."</center></td>
								<td><center>".$row->tanggal."</center></td>
								<td><center><a class='btn btn-primary' href='../view_medical_record/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
								</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content, 'medical_record' => $medical_record);
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('list_medical_record', $data['array']);
			$this->load->view('footer');
		//}

	}


	public function view_medical_record($n){
		 session_start();
		 if(!isset($_SESSION['drg']))
			redirect ("homepage");

		echo $n;
		$medical_record = new medical_record();
		$medical_record->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Medical Record ID</b></td><td>'.$medical_record->id.'</td></tr>
			<tr><td><b>Date</b></td><td>'.$medical_record->tanggal.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$medical_record->jam.'</td></tr>
			<tr><td><center><img alt="140x140" src="../../../'.$medical_record->foto.'" style="width:125px; height:125px;" class="img-circle"></center></tr></td>
			<tr><td><b>Description</b></td><td>'.$medical_record->deskripsi.'</td></tr>
			<td><form method="post" action="../send_data/'.$n.'"><button type="submit" class="btn btn-primary ">Send to FKG UI</button></form>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('view_medical_record', $data['array']); 
		$this->load->view('footer');
	}

	public function simpan_medical_record($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("../homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$tanggal = $_POST['tanggal'];
			$jam = $_POST['jam'];
			$deskripsi = $_POST['deskripsi'];

			$pengguna = new pengguna();
			$medical_record = new medical_record();

			$pengguna->where('username', $_SESSION['drg'])->get();		
		 		$medical_record->dokter_gigi_id= $pengguna->id;
			$medical_record->tanggal=$tanggal;
			$medical_record->jam=$jam;
			$medical_record->deskripsi=$deskripsi;
			$medical_record->pasien_id=$n;

			$medical_record->validate();
			if($medical_record->valid){
				$medical_record->save();
				// $data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
				// $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				// 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  // 					<strong>Well done!</strong> Patient data has been saved.
				// 			</div>");
				// 			$this->load->view('header-drg', $data['menu']);
				// 			$this->load->view('result-drg', $data['array']);
				// 			$this->load->view('footer');
				redirect("drg/choose_image_drg/$medical_record->id");
			}
			else{
							//$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
							$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					Patient data not been created.".$medical_record->error->tanggal."".$medical_record->error->jam."".$medical_record->error->deskripsi."
									</div>");
				// echo $medical_record->error->tanggal;
				// echo $medical_record->error->jam;
				// echo $medical_record->error->deskripsi;
						redirect("drg/medical_record/$n");
						$data['array'] = array('n' => $n);
						//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('medical_record', $data['array']);
						$this->load->view('footer');
			}


		}

	}

	function choose_image_drg($n){
		session_start();
		
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('choose_image_drg', $data['array']);
		$this->load->view('footer');
	}

	function upload_image_drg($n){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

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
			$status['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			//$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			redirect("drg/choose_image_drg/$n");
			$data['array']=array('n'=>$n);
			$this->load->view('header-drg', $status['menu']);
			$this->load->view('choose_image_drg', $data['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/citra/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['drg'])->get();

			$medical_record = new medical_record();
			$medical_record->where('id',$n)->update('foto', $temp);

			//$status['array']=array('content' => '<a href="../send_reference/'.$n.'">Send reference.</a>');

			$data['array']=array('n'=>$n);
					 			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> medical record has been created.
							</div>", 'content' => '<a href="../pasien_read">Back to patient list.</a>');
		 					$this->load->view('header-drg', $data['menu']);
		$this->load->view('result-drg');
		$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}

			public function send_diagnose_to_admin($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
		redirect ("homepage");
		

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

		 		$pengguna->where('username', $_SESSION['drg'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
			$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}

	public function list_reference_drg($page = 1){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$content="";
    // send to view
//    $this->load->view('posts/archive', array('posts' => $posts));
		$mengirim = new mengirim();
		$mengirim->order_by('waktu', 'desc');
		//$mengirim->get_paged($page, 10);
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['drg'])->get();		
		$lala = $pengguna->id;

		$mengirim->where('umum_id', $lala)->get_paged($page, 10);

		$data['array']=array('mengirim'=>$mengirim, 'umum_id'=>$lala);
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('list_reference_drg', $data['array']);
		$this->load->view('footer');
	}

			public function send_data($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['drg']))
		redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$pengguna = new pengguna();
		 	$merawat = new merawat();

		 		$pengguna->where('username', $_SESSION['drg'])->get();
		 		$id = $pengguna->id;
		 		$merawat->medicalrecord_id=$n;
		 		$merawat->umum_id= $id;
		 		$medical_record = new medical_record();
		 		$medical_record->where('id', $n)->get();
		 		$merawat->pasien_id=$medical_record->pasien_id;
		 		$merawat->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
		$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been sent.
							</div>");
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('result-drg', $data['array']);
		$this->load->view('footer');
		}

		public function pasien_update2($n){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

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
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been updated.
							</div>");	
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('pasien_update2', $data['array']);
			$this->load->view('footer');
		}else{
		$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('pasien_update2', $data['array']);
		$this->load->view('footer');
		}
	}
	
	public function pasien_update(){
		// session_start();
		//  if(!isset($_session['Username']))
		//  	redirect ("homepage");
		$this->load->view('header-drg');
		$this->load->view('pasien_update');
		$this->load->view('footer');
	}

	public function delete1($id){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->deletePasien($id);
		if($status)
			redirect("drg/pasien_read");
	}


	public function reference_drg($n){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
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

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$mengirim->tanggal.'</td></tr>
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

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('reference_drg', $data['array']);
		$this->load->view('footer');
	}

	public function send_to_referral($n){
		session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$option="";
		$mengirim = new mengirim();
		$mengirim->where('id', $n)->get();
		$pengguna1 =new pengguna();
		$pengguna1->where('nama', $mengirim->kandidat1)->get();
		$option .= "<option value='".$pengguna1->id."'>".$pengguna1->nama."</option>";
		$pengguna2 =new pengguna();
		$pengguna2->where('nama', $mengirim->kandidat2)->get();
		$option .= "<option value='".$pengguna2->id."'>".$pengguna2->nama."</option>";
		$pengguna3 =new pengguna();
		$pengguna3->where('nama', $mengirim->kandidat3)->get();
		$option .= "<option value='".$pengguna3->id."'>".$pengguna3->nama."</option>";
		$pengguna4 =new pengguna();
		$pengguna4->where('nama', $mengirim->kandidat4)->get();
		$option .= "<option value='".$pengguna4->id."'>".$pengguna4->nama."</option>";
		$pengguna5 =new pengguna();
		$pengguna5->where('nama', $mengirim->kandidat5)->get();
		$option .= "<option value='".$pengguna5->id."'>".$pengguna5->nama."</option>";		

		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$pengguna = new pengguna();
		 	$rujukan = new rujukan();
		 	$mengirim = new mengirim();
			$analisis = new analisi();
			$pesan = new pesan();
			
		 	$pengguna->where('username', $_SESSION['drg'])->get();
			$mengirim->where('id', $n)->get();
			$analisis_id= $mengirim->analisis_id;
			$analisis->where('id', $analisis_id)->get();

		 	$rujukan->orto_id=$_POST['nama'];
		 	$rujukan->pusat_id=$pengguna->id;
		 	$rujukan->pasien_id=$analisis->pasien_id;
		 	$rujukan->analisi_id=$analisis_id; 		
		 	$rujukan->save();

		 	$rujukan->order_by('id', 'desc')->get();

		 	$pesan->subject="Pasien dari dokter ".$pengguna->nama."";
		 	$isi = $_POST['message'];
		 	$isi.= "dengan id rujukan".$rujukan->id."";
		 	$pesan->isi=$isi;
		 	$pesan->pengguna_id=$pengguna->id;
		 	$pesan->penerima_id=$_POST['nama'];

		 	$pesan->validate();
		 		if($pesan->valid){
		 			$pesan->save();	
		 			//echo 'lala';
					$data['array'] = array ('option' => $option, 'n'=>$n);
					$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '','status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						  					<strong>Well done!</strong> Reference has been sent.
											</div>");
					// $this->load->view('header-drg', $data['menu']);
					// $this->load->view('send_to_referral', $data['array']);
					// $this->load->view('footer'); 
		 		}
		 		else{
		 			$data['array'] = array ('option' => $option, 'n'=>$n);
					$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '','status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						  					<strong>Reference has not been sent.".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
											</div>");
					// $this->load->view('header-drg', $data['menu']);
					// $this->load->view('send_to_referral', $data['array']);
					// $this->load->view('footer');	

		 		}
						$data['array'] = array ('option' => $option, 'n'=>$n);
				//$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
				$this->load->view('header-drg', $data['menu']);
				$this->load->view('send_to_referral', $data['array']);
				$this->load->view('footer');	
			}else{
		$data['array'] = array ('option' => $option, 'n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('send_to_referral', $data['array']);
		$this->load->view('footer');
	}
	}


	public function list_outbox_drg($page = 1){
		session_start();
		if(!isset($_SESSION['drg']))
			redirect ("homepage");
		
		$content="";
		$content1="";
		$content2="";
		$merawat = new merawat();
		//$merawat->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['drg'])->get();		
		$lala = $pengguna->id;
		$pesan = new pesan();
		//$pesan->get();
		$rujukan = new rujukan();
		//$rujukan->get();

		$merawat->order_by('waktu', 'desc');
		$merawat->where('umum_id', $lala)->get_paged($page, 10);
		$pesan->order_by('waktu', 'desc');
		$pesan->where('pengguna_id', $lala)->get_paged($page, 10);
		$rujukan->order_by('waktu', 'desc');
		$rujukan->where('pengirim_id', $lala)->get_paged($page, 10);


		$data['array']=array('merawat' => $merawat, 'pesan' => $pesan, 'rujukan' => $rujukan, 'umum_id' => $lala, 'pengguna_id' => $lala, 'pengirim_id' => $lala);

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content, 'content1'=>$content1, 'content2'=>$content2);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('list_outbox_drg', $data['array']);
		$this->load->view('footer');
	}

		public function view_merawat_drg($n){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
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

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('view_merawat_drg', $data['array']);
		$this->load->view('footer');
	}

			public function outbox_message_drg($n){
		 session_start();
		 if(!isset($_SESSION['drg']))
			redirect ("homepage");

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


		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('outbox_message_drg', $data['array']); 
		$this->load->view('footer');
	}

	public function view_rujukan_drg($n){
		  session_start();
		  if(!isset($_SESSION['drg']))
		  	redirect ("homepage");
		
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

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('view_rujukan_drg', $data['array']);
		$this->load->view('footer');
	}

	public function search_patient($page = 1){
	  session_start();
	  if(!isset($_SESSION['drg']))
	  	redirect ("homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['drg'])->get();
		$idDokter = $pengguna->id;
		$pasien = new pasien();
		$pasien->order_by('id', 'desc');
		$pasien->where('doktergigi_id', $idDokter)->like('nama', $_POST['nama'])->get_paged($page, 10);
		
		$data['array']=array('pasien'=>$pasien, 'doktergigi_id'=>$idDokter, 'nama'=>$_POST['nama']);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-drg', $data['menu']);
		$this->load->view('search_patient', $data['array']);
		$this->load->view('footer');
	}

	}
}
?>