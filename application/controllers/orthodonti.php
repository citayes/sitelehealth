<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orthodonti extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => 'active', 'pasien' => '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('orthodonti');
		$this->load->view('footer');
	}

		public function edit_profile(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$id = $pengguna->id;
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $id)->get();

		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Agama = $_POST['Agama'];
			
			$pengguna = new pengguna();
			//$pengguna->where('username', $_SESSION['admin'])->get();
			$pengguna->where('username', $_SESSION['orthodonti'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['orthodonti'])->update('agama',$Agama);
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);

			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			$id = $pengguna->id;
			$dokter_gigi->where('pengguna_id', $id)->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] =array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('edit_profile-orthodonti', $data['array']);
			$this->load->view('footer');
		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('edit_profile-orthodonti', $data['array']);
		$this->load->view('footer');
		}
	}
		
	public function change(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['orthodonti']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['orthodonti'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-orthodonti', $data['menu']);
							$this->load->view('changepassword-orthodonti');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Warning!</strong> Wrong new password.
									</div>");	
							$this->load->view('header-orthodonti', $data['menu']);
							$this->load->view('changepassword-orthodonti');
							$this->load->view('footer');
						}
						
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword-orthodonti');
						$this->load->view('footer');
					}
				}
			}

		}else{
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('changepassword-orthodonti');
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
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['orthodonti']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
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

			$status['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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

	public function list_reference(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		$content="";
		$mengirim = new mengirim();
		$mengirim->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
 		$lala = $pengguna->id;
		$content .= '<table class="table">
				<tr>
				<td><center><b>Date</center></b></td>
				<td><center><b>Doctors ID</center></b></td>
				<td><center><b>Doctors Name</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';				
		foreach($mengirim as $row){
			if($row->orto_id==$lala && $row->flag_membaca!=1){
				$nama_pusat = new pengguna();
				$nama_pusat->where('id', $row->pusat_id)->get();
				$content .= "<tr><td><center>".$row->waktu."</center></a></td>
								<td><center>".$row->orto_id."</center></td>
								<td><center>".$nama_pusat->nama."</center></td>
								<td><center><a class='btn btn-primary' href='../orthodonti/reference_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></b></td></tr>";
			}
			else if($row->orto_id==$lala && $row->flag_membaca==1){
				$nama_pusat = new pengguna();
				$nama_pusat->where('id', $row->pusat_id)->get();
				$content .= "<tr><td><b><center>".$row->waktu."</center></a></b></td>
								<td><b><center>".$row->orto_id."</center></b></td>
								<td><b><center>".$nama_pusat->nama."</center></b></td>
								<td><b><center><a class='btn btn-primary' href='../orthodonti/reference_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></b></td></tr>";
			}
		}
		$content.='</table>';
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference');
		$this->load->view('footer');
	}

	public function reference_orthodonti($n){
		  session_start();
		  if(!isset($_SESSION['orthodonti']))
		  	redirect ("homepage");
		
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
			<tr><td><center><a class="btn btn-warning" href="../list_reference_drg">Back<a></center></td>
			<td><center><a class="btn btn-primary" href="../send_to_referral/'.$n.'">Send Reference<a></center></td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reference_orthodonti', $data['array']);
		$this->load->view('footer');
	}

		public function pasien1(){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
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

			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Patient has been created.
									</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien1');
			$this->load->view('footer');
		}else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
			$this->load->view('header-orthodonti', $data['menu']);
			//$this->load->view('header-orthodonti');
			$this->load->view('pasien1');
			$this->load->view('footer');
		}
	}
	
	public function read($n){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

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
			<td><form method="post" action="../send_data/'.$n.'"><button type="submit" class="btn btn-primary">Send to FKG UI</button></form>
			</td></tr>');

		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('read_ortho', $data['array']); 
		$this->load->view('footer');
	}

	public function pasien_read_ortho(){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
		 	redirect ("homepage");
			
		$pasien = new pasien();
		$pasien->get();
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$idDokter=$pengguna->id;

		if($pasien->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>Name</strong></b></center></td>
							<td><center><b><strong>Age</strong></b></center></td>
							<td><center><b><strong>Height</strong></b></center></td>
							<td><center><b><strong>Weight</strong></b></center></td>
							<td><center><b><strong>Gender</strong></b></center></td>
							<td><center><b><strong>Action</strong></b></center></td>
							</tr>";
			foreach($pasien as $row){
				if($row->doktergigi_id==$idDokter){	
					$content .= "<tr>
							<td><center>".$row->nama."</center></td>
							<td><center>".$row->umur."</center></td>
							<td><center>".$row->tinggi."</center></td>
							<td><center>".$row->berat."</center></td>
							<td><center>".$row->jenis_kelamin."</center></td>
							<td><center><a class='btn btn-primary' href='../orthodonti/read/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
								<a class='btn btn-warning' href='../orthodonti/pasien_update2_ortho/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
								<a class='btn btn-danger' href='../orthodonti/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
							</center></td></tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}
		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_read_ortho', $data['array']);
		$this->load->view('footer');
	}

	
	
	public function pasien_update(){
		// session_start();
		//  if(!isset($_SESSION['orthodonti']))
		//  	redirect ("homepage");
		$this->load->view('header-orthodonti');
		$this->load->view('pasien_update_ortho');
		$this->load->view('footer');
	}

	public function medical_record1($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("../homepage");

		$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('medical_record1', $data['array']);
		$this->load->view('footer');
	}	

	public function simpan_medical_record1($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("../homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$tanggal = $_POST['tanggal'];
			$jam = $_POST['jam'];
			$deskripsi = $_POST['deskripsi'];

			$pengguna = new pengguna();
			$medical_record = new medical_record();

			$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		 	$medical_record->umum_id= $pengguna->id;
			$medical_record->tanggal=$tanggal;
			$medical_record->jam=$jam;
			$medical_record->deskripsi=$deskripsi;
			$medical_record->pasien_id=$n;

			$medical_record->save();
			$data['array']= array('content' => '<a href ="../pasien_read_ortho">Back to Patient List.</a>');
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been saved.
							</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('result-orthodonti', $data['array']);
			$this->load->view('footer');
		}
	}

			public function send_diagnose_to_admin($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['orthodonti']))
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

		 		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
		 		$analisi->orto_id= $pengguna->id;
		 		$analisi->flag_menerima= '1';
		 		$analisi->flag_mengirim= '1';

		 		$analisi->save();

					//redirect('admin/send_diagnose_to_admin');							
			}
			$data['array'] = array('n' => $n);
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}

	public function list_reference_drg(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_reference_drg');
		$this->load->view('footer');
	}

	public function send_data($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
		redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
					 	$pengguna = new pengguna();
		 	$merawat = new merawat();

		 		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		 		$id = $pengguna->id;
		 		$merawat->pasien_id=$n;
		 		$merawat->orto_id= $id;
		 		$merawat->save();

			}
			$data['array'] = array('n' => $n);
		$data['array']= array('content' => '<a href ="../pasien_read_ortho">Back to Patient List.</a>');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Patient data has been sent.
							</div>");
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('result-orthodonti', $data['array']);
		$this->load->view('footer');

	}

		public function pasien_update2_ortho($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
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
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('pasien_update2_ortho', $data['array']);
			$this->load->view('footer');
		}else{
		$data['array'] = array('nama' => $pasien->nama, 'tempat_lahir' => $pasien->tempat_lahir, 'tanggal_lahir' => $pasien->tanggal_lahir, 'umur'=>$pasien->umur,
			'alamat_rumah'=>$pasien->alamat_rumah, 'tinggi'=>$pasien->tinggi, 'berat'=>$pasien->berat, 'warga_negara' => $pasien->warga_negara, 'agama' => $pasien->agama);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('pasien_update2_ortho', $data['array']);
		$this->load->view('footer');
		}
	}


	public function delete1($id){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->deletePasien($id);
		if($status)
			redirect("orthodonti/pasien_read_ortho");
	}

	public function send_message(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

			$pengguna = new pengguna();
			$pengguna->get();
			$tujuan="";
			foreach($pengguna as $row){
				$tujuan .= "<option value='".$row->id."'>".$row->nama."</option>";
			}

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$subject = $_POST['subject'];
			$isi = $_POST['isi'];

			$pesan = new pesan();
			$pengguna = new pengguna();

			$pengguna->where('username', $_SESSION['orthodonti'])->get();
			$pesan->pengguna_id=$pengguna->id;
			$pesan->penerima_id=$_POST['tujuan'];
			$pesan->subject=$subject;
			$pesan->isi=$isi;

			$pesan->validate();
			if($pesan->valid){
				$pesan->save();	
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
			}
			else{
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
				  					
				  			// 		
									// </div>");
			}
			$data['array'] = array('content' => $tujuan);	
			//$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');		
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('send_message', $data['array']);
			$this->load->view('footer');
			
		}else{

			$data['array'] = array('content' => $tujuan);	
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');		
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('send_message', $data['array']);
			$this->load->view('footer');
		}

	}

	public function list_pengguna(){
 	 session_start();
		  if(!isset($_SESSION['orthodonti']))
		  	redirect ("homepage");
			
		$pengguna = new pengguna();
		$pengguna->get();
		if($pengguna->result_count()!=0){
			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>Position</strong></b></center></td>
							<td><center><b><strong>Name</strong></b></center></td>
							<td><center><b><strong>Action</strong></b></center></td>
							</tr>";
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

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_pengguna', $data['array']);
		$this->load->view('footer');

	}



	public function view_message(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		$content="";
		$pesan = new pesan();
		$pesan->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['orthodonti'])->get();		
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
								<td><center><a class='btn btn-primary' href='../orthodonti/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td>
							</tr>";
			}
			else if($row->penerima_id==$idPengguna && $row->flag_membaca==1){
				$nama_pengirim = new pengguna();
				$nama_pengirim->where('id', $row->pengguna_id)->get();
				$content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
								<td><b><center>".$nama_pengirim->nama."</center></b></a></td>
								<td><b><center>".$row->subject."</center></b></td>
								<td><center><b><a class='btn btn-primary' href='../orthodonti/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></b></center></td>
							</tr>";
			}
		}
		$content.='</table>';
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_message');
		$this->load->view('footer');
	}
	
		public function detail_message($n){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

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


		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('detail_message', $data['array']); 
		$this->load->view('footer');
	}

	public function view_reference(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['orthodonti'])->get();
		$idDokter = $pengguna->id;

		// $pesan = new pesan();
		// $pesan->get();

		$mengirim = new mengirim();
		$mengirim->get();

		$rujukan = new rujukan();
		$rujukan->order_by('waktu', 'desc')->get();	
				

		if($rujukan->result_count()!=0){

			$content = "<table class='table table-hover'>";
			$content .="<tr>
							<td><center><b><strong>Date</strong></b></center></td>
							<td><center><b><strong>Time</strong></b></center></td>
							<td><center><b><strong>From</strong></b></center></td>
							<td><center><b><strong>Action</strong></b></center></td>
							</tr>";

			foreach($rujukan as $row){
				$nama_pengirim = new pengguna();
		$nama_pengirim->where('id', $row->pengirim_id)->get();
					
		$analisi = new analisi();
		$analisi->where('id',$row->analisi_id)->get();
		$waktu=$row->waktu;
		$splitWaktu = explode(" ", $waktu);
		$date = $splitWaktu[0];
		$time = $splitWaktu[1];

		$pasien = new pasien();
		$pasien->where('id',$analisi->pasien_id)->get();

				if($row->orto_id == $idDokter && $row->flag_membaca!=1 && $row->orto_id==$idDokter){

						$content .= "<tr>
									<td><center>".$date."</center></td>
									<td><center>".$time."</center></td>
									<td><center>".$nama_pengirim->nama."</center></td>
									<td><center><a class='btn btn-primary' href='../orthodonti/detail_reference/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
								</tr>";
				}
				if($row->orto_id == $idDokter && $row->flag_membaca==1  && $row->orto_id==$idDokter){
						$content .= "<tr>
									<td><center><b>".$date."</b></center></td>
									<td><center><b>".$time."</b></center></td>
									<td><center><b>".$nama_pengirim->nama."</b></center></td>
									<td><center><b><a class='btn btn-primary' href='../orthodonti/detail_reference/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></b></center></a> 
								</tr>";
				}
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_reference', $data['array']);
		$this->load->view('footer');
	}

	public function detail_reference($n){

		 session_start();
		 if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");

		$rujukan = new rujukan();
		$rujukan->where('id', $n)->get();

		$pasien = new pasien();
		$pasien->where('id', $rujukan->pasien_id)->get();

		$analisi = new analisi();
		$analisi->where('id', $rujukan->analisi_id)->get();

		$rujukan1 = new rujukan();
		$rujukan1->where('id', $n)->update('flag_membaca', '2');

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
			<tr><td><b>Image</b></td><td>'.$analisi->foto.'</td></tr>			
			<tr><td><b>Score</b></td><td>'.$analisi->skor.'</td></tr>	
			<tr><td><b>Malocclusion</b></td><td>'.$analisi->maloklusi_menurut_angka.'</td></tr>	
			<tr><td><b>Diagnose</b></td><td>'.$analisi->diagnosis_rekomendasi.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$rujukan->pesan.'</td></tr>	
		<tr><td><center><a class="btn btn-primary" href="../reply_message/'.$rujukan->id.'">Reply<a></center></td></tr>');
			

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('detail_reference', $data['array']); 
		$this->load->view('footer');
	}

	public function reply_message($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
	

		$data['array'] = array('n'=>$n);	
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');		
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reply_message', $data['array']);
		$this->load->view('footer');
	}

	public function save_reply_message($n){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect("homepage");

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
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Message has been sent.
								</div>");
			}
			else{
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
								</div>");
			}
		}

		$data['array'] = array('n'=>$n);	
		//$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');		
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('reply_message', $data['array']);
		$this->load->view('footer');
	}

	public function list_outbox_orthodonti(){
		session_start();
		if(!isset($_SESSION['orthodonti']))
			redirect ("homepage");
		
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

		$content.='<table class="table">
				<tr>
				<td><center><b>Recipient ID</center></b></td>
				<td><center><b>Recipient Name</center></b></td>
				<td><center><b>Information</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';
			$content1.='<table class="table">
				<tr>
				<td><center><b>Recipient ID</center></b></td>
				<td><center><b>Recipient Name</center></b></td>
				<td><center><b>Information</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';
			$content2.='<table class="table">
				<tr>
				<td><center><b>Recipient ID</center></b></td>
				<td><center><b>Recipient Name</center></b></td>
				<td><center><b>Information</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';
		foreach($merawat->order_by('id', 'desc')->get() as $row){


			//foreach ($pesan as $row1) {
				if($row->flag_outbox!=1 && $row->orto_id==$lala){
					// $nama_penerima = new pengguna();
					// $nama_penerima->where('id', $row->pusat_id)->get();
					$content .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>FKG UI</center></td>
									<td><center>Send Patient to FKG UI</center></td>
									<td><center><a class='btn btn-primary' href='../orthodonti/view_merawat_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
				}
				else if($row->flag_outbox==1 && $row->orto_id==$lala){
					// $nama_penerima = new pengguna();
					// $nama_penerima->where('id', $row->pusat_id)->get();
					$content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><b><center>FKG UI</center></b></td>
									<td><b><center>Send Patient to FKG UI</center></b></td>
									<td><b><center><a class='btn btn-primary' href='../orthodonti/view_merawat_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
				}
		} 
		foreach ($pesan->order_by('id', 'desc')->get() as $row) {
			if($row->pengguna_id==$lala && $row->flag_outbox!=1){
				$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->penerima_id)->get();
					$content1 .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Message</center></td>
									<td><center><a class='btn btn-primary' href='../orthodonti/outbox_message_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
			}
			else if($row->pengguna_id==$lala && $row->flag_outbox==1){
				$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->penerima_id)->get();
					$content1 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><b><center>".$nama_penerima->nama."</center></b></td>
									<td><b><center>Message</center></b></td>
									<td><center><b><a class='btn btn-primary' href='../orthodonti/outbox_message_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a><b></center></td></tr>";
			}
		}

		foreach($rujukan->order_by('id', 'desc')->get() as $row){
			//foreach ($pesan as $row1) {
				if($row->pengirim_id==$lala && $row->flag_outbox!=1){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->orto_id )->get();
					$content2 .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Send Reference</center></td>
									<td><center><a class='btn btn-primary' href='../orthodonti/view_rujukan_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
			}
			if($row->pengirim_id==$lala && $row->flag_outbox==1){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->orto_id )->get();
					$content2 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><b><center>".$nama_penerima->nama."</center></b></td>
									<td><b><center>Send Reference</center></b></td>
									<td><b><center><a class='btn btn-primary' href='../orthodonti/view_rujukan_orthodonti/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
			}
		}
				
		$content.='</table>';
		$content1.='</table>';
		$content2.='</table>';

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content, 'content1'=>$content1, 'content2'=>$content2);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('list_outbox_orthodonti');
		$this->load->view('footer');
	}

		public function view_merawat_orthodonti($n){
		  session_start();
		  if(!isset($_SESSION['orthodonti']))
		  	redirect ("homepage");
		
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

		$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_merawat_orthodonti', $data['array']);
		$this->load->view('footer');
	}

			public function outbox_message_orthodonti($n){
		 session_start();
		 if(!isset($_SESSION['orthodonti']))
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
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('outbox_message_orthodonti', $data['array']); 
		$this->load->view('footer');
	}

	public function view_rujukan_orthodonti($n){
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
		$this->load->view('header-orthodonti', $data['menu']);
		$this->load->view('view_rujukan_orthodonti', $data['array']);
		$this->load->view('footer');
	}

}
?>