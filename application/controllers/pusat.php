<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pusat extends CI_Controller {
	public function index(){
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");


		$data['menu'] = array('home' => 'active', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('pusat');
		$this->load->view('footer');
	}

	public function edit_profile(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['pusat'])->get();
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
			$pengguna->where('username', $_SESSION['pusat'])->update('nama',$Nama);
			$pengguna->where('username', $_SESSION['pusat'])->update('tempat_lahir',$Tempat_Lahir);
			$pengguna->where('username', $_SESSION['pusat'])->update('tanggal_lahir',$Tanggal_Lahir);
			$pengguna->where('username', $_SESSION['pusat'])->update('warga_negara',$Warga_Negara);
			$pengguna->where('username', $_SESSION['pusat'])->update('agama',$Agama);

			$dokter_gigi->where('pengguna_id', $id)->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $id)->update('pendidikan_dokter', $_POST['pendidikan']);
			$dokter_gigi->where('pengguna_id', $id)->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $id)->update('kode_pos', $_POST['kodepos']);

			$pengguna->where('username', $_SESSION['pusat'])->get();
			$dokter_gigi->where('pengguna_id', $id)->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		
		}else{
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		}
		
	}
	
	public function read2($n){
		session_start();
		if(!isset($_session['Username']))
			//redirect ("homepage");
		
		$Pasien = new pasien();
		$Merawat = new merawat();
		$Pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Name</b></td><td>'.$Pasien->nama.'</td></tr>
			<tr><td><b>Tanggal_Lahir</b></td><td>'.$Pasien->tanggal_lahir.'</td`></tr>
			<tr><td><b>Tempat_Lahir</b></td><td>'.$Pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Agama</b></td><td>'.$Pasien->agama.'</td></tr>
			<tr><td><b>Umur</b></td><td>'.$Pasien->umur.'</td></tr>
			<tr><td><b>Tinggi</b></td><td>'.$Pasien->tinggi.'</td></tr>
			<tr><td><b>Berat</b></td><td>'.$Pasien->berat.'</td></tr>
			<tr><td><b>Jenis_Kelamin</b></td><td>'.$Pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Alamat_Rumah</b></td><td>'.$Pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Warga_Negara</b></td><td>'.$Pasien->warga_negara.'</td></tr>
			<tr><td><form method="post" action="../send_diagnose_to_admin/'.$n.'"><button type="submit" class="btn btn-primary pull-right">Send Diagnose to Admin</button></form></td>
			<td><form method="post" action="../create_diagnose/'.$n.'"><button type="submit" class="btn btn-primary">Send Reference</button></form>
			<td><form method="post" action="../view_doctor/'.$Pasien->doktergigi_id.'"><button type="submit" class="btn btn-primary">View Doctor</button></form>
			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read2', $data['array']); 
		$this->load->view('footer');
	}


	public function read_data_citra(){
		 session_start();
		 if(!isset($_SESSION['pusat']))
		 	redirect ("homepage");
			
		$pasien = new pasien();
		$pasien->get();


		$merawat = new merawat();
		$merawat->get();
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
			foreach($merawat as $row){
			$content .= "<tr>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->nama."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->umur."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->tinggi."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->berat."</center></td>
							<td><center>".$pasien->where('id',$row->pasien_id)->get()->jenis_kelamin."</center></td>
							<td><center><a class='btn btn-primary' href='../pusat/read2/".$pasien->where('id',$row->pasien_id)->get()->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a> 
								
							</center></td></tr>";
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		//$this->load->view('header-orthodonti');
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('read_data_citra', $data['array']);
		$this->load->view('footer');
	}

	public function change(){
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("pusat");
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['pusat'])->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['pusat']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['pusat'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");
							$this->load->view('header-pusat', $data['menu']);
							$this->load->view('changepassword-pusat');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong new password.
							</div>");	
							$this->load->view('header-pusat', $data['menu']);
							$this->load->view('changepassword-pusat');
							$this->load->view('footer');
						}
					}else{
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword-pusat');
						$this->load->view('footer');
					}
				}
			}

		}else{
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('changepassword-pusat');
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
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['pusat']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
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

			$status['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");
		
			$data['array'] = array('n' => $n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');

		}


		public function send_diagnose_to_admin_lagi($n){
		//session_start();
		session_start();
		if(!isset($_SESSION['pusat']))
		redirect ("homepage");
		
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
		 			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra">Back to patient list.</a>');
		 					$this->load->view('header-pusat', $data['menu']);
		$this->load->view('result-pusat');
		$this->load->view('footer');
		 		}
		 		else{
		 					//$data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
							$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					Analisis not been created.".$analisi->error->skor."".$analisi->error->maloklusi_menurut_angka."".$analisi->error->diagnosis_rekomendasi."
									</div>", 'content' => '<a href="../send_diagnose_to_admin/%n">Back to Diagnosis Form.</a>');
								$data['array'] = array('n' => $n);
		//$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_diagnose_to_admin', $data['array']);
		$this->load->view('footer');
					}
		 		
									
		


		}
	
		public function listrujukan(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
		
		$content ="";
		$merawat = new merawat();
		$merawat->get();
		$pasien= new pasien();
        $pengguna = new pengguna();
		if($merawat->result_count!==0){
			$content .='<table class="table">
						<tr>
							<td><center><b>Id Pasien</b></center></td>
			                <td><center><b>Nama Pasien</b></center></td>
			                <td><center><b>Nama Dokter Umum/Spesialis Lain</b></center></td>
			                <td><center><b>Nama Dokter Spesialis Orthodontist Selain Pusat</b></center></td>
			                <td><center><b>Operation</b></center></td>
						</tr>';
			foreach($merawat as $row){
				$content .= "<tr><td><center>".$row->pasien_id."</center></td>
                                <td><center>".$pasien->where('id', $row->pasien_id)->get()->nama."</center></td>
                                <td><center>".$pengguna->where('id', $row->umum_id)->get()->nama."</center></td>
                                <td><center>".$pengguna->where('id', $row->orto_id)->get()->nama."</center></td>
                                <td><center><a class='btn btn-primary' href='show_rujukan/".$row->pasien_id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td>
                                </tr>";
            }
			$content .= '</table>';
		}
		
		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('listrujukan');
		$this->load->view('footer');
	}	
	public function show_rujukan($n){
		session_start();
		if(!isset($_session['pusat']))
			//redirect ("homepage");
		
		$pasien = new pasien();
		$pasien->where('id', $n)->get();

		$data['array'] = array('content' => '<tr><td><b>Id pasien</b></td><td>'.$pasien->id.'</td></tr>
			<tr><td><b>Nama</b></td><td>'.$pasien->nama.'</td`></tr>
			<tr><td><b>Tanggal Lahir</b></td><td>'.$pasien->tanggal_lahir.'</td></tr>
			<tr><td><b>Tempatlahir</b></td><td>'.$pasien->tempat_lahir.'</td></tr>
			<tr><td><b>Agama</b></td><td>'.$pasien->agama.'</td></tr>
			<tr><td><b>Umur</b></td><td>'.$pasien->umur.'</td></tr>
			<tr><td><b>Alamat Rumah</b></td><td>'.$pasien->alamat_rumah.'</td></tr>
			<tr><td><b>Tinggi</b></td><td>'.$pasien->tinggi.'</td></tr>
			<tr><td><b>Berat</b></td><td>'.$pasien->berat.'</td></tr>
			<tr><td><b>Jenis Kelamin</b></td><td>'.$pasien->jenis_kelamin.'</td></tr>
			<tr><td><b>Warga_Negara</b></td><td>'.$pasien->warga_negara.'</td></tr>

			</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('show_rujukan', $data['array']); 
		$this->load->view('footer');
	}

	public function create_diagnose($n){
		session_start();
		
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
		
		$data['array']=array('n'=>$n);
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);

		//$this->load->view('header-pusat');
		$this->load->view('create_diagnose', $data['array']);
		$this->load->view('footer');
		
	}

public function save_diagnose($n){
		session_start();
				
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");		

			$tanggal = $_POST['tanggal'];
			$skor = $_POST['Skor'];
			$maloklusi= $_POST['Maloklusi'];
			$diagnose = $_POST['Diagnose'];
			$foto = $_POST['Foto'];

			$analisi = new analisi();
			$rujukan = new rujukan();
			$pengguna = new pengguna();
			$merawat = new merawat();
			$mengirim = new mengirim();

			$analisi->tanggal=$tanggal;
			$analisi->pasien_id=$n;
			$analisi->skor=$skor;
			$analisi->maloklusi_menurut_angka=$maloklusi;
			$analisi->diagnosis_rekomendasi=$diagnose;
			$pengguna->where('username', $_SESSION['pusat'])->get();
			$analisi->orto_id=$pengguna->id;
			$analisi->foto=$foto;

			$analisi->flag_mengirim='2';
			$analisi->save();

			$merawat->where('pasien_id', $n)->get();
			$mengirim->umum_id=$merawat->umum_id;
			$mengirim->pusat_id=$merawat->pusat_id;

			$analisi->flag_mengirim='2';

			$analisi->validate();
			if($analisi->valid){
				$analisi->save();
				redirect("pusat/send_reference/$n");

			}
			else{
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
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
		public function send_reference($n){
		session_start();
			
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
							
		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}		 

		//$data['array'] = array('n' => $n);
		$data['array'] = array('content' => $option, 'n'=> $n);	
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');				
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('send_reference', $data['array']);
		$this->load->view('footer');
	}

	public function save_reference($n){
		session_start();
			
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$kandidat1 = $_POST['nama'];

			$pengguna = new pengguna();
		 	$mengirim = new mengirim();
		 	$merawat = new merawat();
		 	$analisi = new analisi();
		 	$pusat = new pusat();

		 	$mengirim->kandidat1=$kandidat1;

		 	$pengguna->where('username', $_SESSION['pusat'])->get();		
		 	$mengirim->pusat_id= $pengguna->id;
		 	$analisi->where('pasien_id', $n);
		 	$analisi->order_by('id', 'desc')->get();

		 	$mengirim->analisis_id=$analisi->id;
	 	
	 		$merawat->where('pasien_id', $analisi->pasien_id)->get();
		 	$mengirim->umum_id=$merawat->umum_id;
			 	
		 	$mengirim->orto_id=$merawat->orto_id;
		 	$mengirim->pusat_id=$analisi->orto_id;
		 	
		 	$mengirim->validate();
		 	if($mengirim->valid){
		 		$mengirim->save();
		 		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		 	 				<strong>Well done!</strong> Diagnose has been sent.
							</div>", 'content' => '<a href="../read_data_citra">Back to patient list.</a>');
		 					$this->load->view('header-pusat', $data['menu']);
							$this->load->view('result-pusat');
							$this->load->view('footer');
		 	}

		 	else{
		 		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		 	 				Diagnose has not been sent.".$mengirim->error->tanggal."".$mengirim->error->kandidat1."".$mengirim->error->kandidat2."".$mengirim->error->kandidat3."".$mengirim->error->kandidat4."".$mengirim->error->kandidat5."
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
		
	}

	public function view_doctor($m){
	
	session_start();
	if(!isset($_SESSION['pusat']))
		redirect ("homepage");
	
	$pengguna = new Pengguna();
	$dokter_gigi = new dokter_gigi();
	$drg_ortodonti = new drg_ortodonti();
	$pengguna->where('id', $m)->get();
	$dokter_gigi->where('pengguna_id', $m)->get();


	$data['array']= array('content' => '<tr><td>Nama</td><td>' .$pengguna->nama.'</td><tr>
		<tr><td>Email</td><td>'.$pengguna->email.'</td></tr>
		<tr><td>Tanggal_Lahir</td><td>'.$pengguna->tanggal_lahir.'</td></tr>
		<tr><td>Tempat_Lahir</td><td>'.$pengguna->tempat_lahir.'</td></tr>
		<tr><td>Warga_Negara</td><td>'.$pengguna->warga_negara.'</td></tr>
		<tr><td>Jenis_kelamin</td><td>'.$pengguna->jenis_kelamin.'</td></tr>
		<tr><td>Agama</td><td>'.$pengguna->agama.'</td></tr>
		<tr><td>Foto</td><td>'.$pengguna->foto.'</td></tr>
		<tr><td>Kursus</td><td>'.$dokter_gigi->kursus.'</td></tr>
		<tr><td>Pendidikan_Dokter</td><td>'.$dokter_gigi->pendidikan_dokter.'</td></tr>
		<tr><td>Alamat_Praktik</td><td>'.$dokter_gigi->alamat_praktik.'</td></tr>
		<tr><td colspan="2"><a class="btn btn-primary" href="../verifyAcc/'.$m.'">Verify</a></td>'
		);
	
$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> 'active', 'inbox' => '', 'setting' => '');
	$this->load->view('header-pusat', $data['menu']);
	$this->load->view('view_doctor', $data['array']);
	$this->load->view('footer');
	}	

public function retrievejadwalp(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$jadwaljaga = new jadwal_jaga();
		$jadwaljaga-> get();
		$content="";
		if($jadwaljaga->result_count() != 0){
			$content = "<table class='table'>
						<tr>
							<td><center><b>Day</b><center></td>
							<td><center><b>Start Hour</center></b></td>
							<td><center><b>End Hour</center></b></td>
							<td><center><b>Doctor</center></b></td>
						</tr>";
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
		
		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('retrievejadwalp', $data['array']);
		$this->load->view('footer');
	}

	public function list_outbox_fkg(){
		session_start();
		if(!isset($_SESSION['pusat']))
			redirect ("homepage");
		
		$content="";
		$mengirim = new mengirim();
		$mengirim->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['pusat'])->get();		
		$lala = $pengguna->id;
		$pesan = new pesan();
		$pesan->get();
		$analisi = new analisi();
		$analisi->get();

		$content.='<table class="table">
				<tr>
				<td><center><b>Id Penerima</center></b></td>
				<td><center><b>Nama Penerima</center></b></td>
				<td><center><b>Keterangan</center></b></td>
				<td><center><b>Operation</center></b></td>
			</tr>';
		foreach($mengirim as $row){
			//foreach ($pesan as $row1) {
				if($row->admin_id==null && $row->pusat_id==$lala && $row->umum_id!=null){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->umum_id)->get();
					$content .= "<tr><td><center>".$row->umum_id."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Reference and Diagnosis</center></td>
									<td><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
				}
				else if($row->admin_id==null && $row->pusat_id==$lala && $row->orto_id!=null){
					echo 'lala';
					$nama_penerima1 = new pengguna();
					$nama_penerima1->where('id', $row->orto_id)->get();
					$content .= "<tr><td><center>".$row->orto_id."</center></a></td>
									<td><center>".$nama_penerima1->nama."</center></td>
									<td><center>Reference and Diagnosis</center></td>
									<td><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
				}

			//}
		} 
		foreach ($pesan as $row) {
			if($row->pengguna_id==$lala){
				$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->penerima_id)->get();
					$content .= "<tr><td><center>".$row->penerima_id."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Message</center></td>
									<td><center><a class='btn btn-primary' href='../pusat/outbox_message_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
			}
		}

		foreach($analisi as $row){
			//foreach ($pesan as $row1) {
				if($row->flag_mengirim==1 && $row->orto_id==$lala){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', '123142')->get();
					$content .= "<tr><td><center>".$nama_penerima->id."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Diagnosis To Admin</center></td>
									<td><center><a class='btn btn-primary' href='../pusat/view_diagnosis_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
			}
		}
				
		$content.='</table>';

		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('list_outbox_fkg');
		$this->load->view('footer');
	}

	public function view_reference_fkg($n){
		  session_start();
		  if(!isset($_SESSION['pusat']))
		  	redirect ("homepage");
		
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

		$data['array'] = array('content' => '<tr><td><b>Recipient id</b></td><td>'.$mengirim->umum_id.'</td></tr>
			<tr><td><b>Recipient name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Date</b></td><td>'.$mengirim->tanggal.'</td></tr>
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
			<tr><td><b>Kandidat 5</b></td><td>'.$mengirim->kandidat5.'</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('view_reference_fkg', $data['array']);
		$this->load->view('footer');
	}

		public function outbox_message_fkg($n){
		 session_start();
		 if(!isset($_SESSION['pusat']))
			redirect ("homepage");

		$pesan = new pesan();
		$pesan->where('id', $n)->get();
		$pengguna = new pengguna();
		$pengguna->where('id',$pesan->pengguna_id)->get();
		$nama_penerima = new pengguna();
		$nama_penerima->where('id', $pesan->penerima_id)->get();

		$data['array'] = array('content' => '<tr><td><b>Recipient id</b></td><td>'.$pesan->penerima_id.'</td></tr>
			<tr><td><b>Recipient Name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('outbox_message_fkg', $data['array']); 
		$this->load->view('footer');
	}

	
	public function view_diagnosis_fkg($n){
		  session_start();
		  if(!isset($_SESSION['pusat']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();

		$pengguna->where('username', $_SESSION['pusat'])->get();
		//$analisis_id= $mengirim->analisis_id;
		$analisis = new analisi();
		$analisis->where('id', $n)->get();
		$nama_admin = new pengguna();
		//$nama_admin->where('id', $mengirim->admin_id)->get();
		$nama_pasien = new pasien();
		$nama_pasien->where('id', $analisis->pasien_id)->get();

		$data['array'] = array('content' => '
			<tr><td><b>Recipient name</b></td><td>Admin</td></tr>
			<tr><td><b>Patients id</b></td><td>'.$analisis->pasien_id.'</td></tr>
			<tr><td><b>Patients name</b></td><td>'.$nama_pasien->nama.'</td></tr>
			<tr><td><b>PAR Scor</b></td><td>'.$analisis->skor.'</td></tr>
			<tr><td><b>Maloklusi</b></td><td>'.$analisis->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Diagnosis</b></td><td>'.$analisis->diagnosis_rekomendasi.'</td></tr>');

		$data['menu'] = array('home' => '', 'pasien' => 'active', 'jadwal'=> '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-pusat', $data['menu']);
		$this->load->view('view_diagnosis_fkg', $data['array']);
		$this->load->view('footer');
	}	
}
?>