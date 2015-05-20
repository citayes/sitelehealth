<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	//lancar
	public function index(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->get();
		$latlon=array();
		$i=0;
		foreach ($dokter_gigi as $row) {
			$latlon[$i]=$dokter_gigi->latitude;
			$latlon[$i].=",";
			$latlon[$i].=$dokter_gigi->longitude;
			$i++;
		}
		$data['menu'] = array('home' => 'active', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'latlon'=>$latlon);
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('admin');
		$this->load->view('footer');
	}

	//lancar
	public function verify(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('fverifikasi', 'n')->get();
		$temp = "";
		foreach($pengguna as $row){
							$temp .= "
							<div class='col-md-4'>
								<div class='thumbnail'>
									<center><img alt='140x140' src='../../".$row->foto."' style='width:125px; height:125px;' class='img-circle'></center>
									<div class='caption'>
										<h4><center>".$row->username."</center></h4>
										<center>
										<p>".$row->nama."</p>
										<p>".$row->email."</p>
										<p>".$row->role."</p>
										<p>
											<a class='btn btn-primary' href='../admin/view_data_dokter/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Details</span></a> 
											<a class='btn btn-danger' href='../admin/decline/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'> Decline</span></a>
										</p>
										</center>
									</div>
								</div>
							</div>";
					$data['array']= array('content' => $temp);
		
		}
		$data['array']= array('content' => $temp);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('verify', $data['array']);
		$this->load->view('footer');	
	}


	public function view($m){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$pengguna = new pengguna();
		$pengguna->where('id', $m)->get();
		$dokter_gigi = new dokter_gigi();
		$dokter_gigi->where('pengguna_id', $m)->get();

		$data['array'] = array('nama' => $pengguna->nama, 'email' =>  $pengguna->email, 'tanggallahir' => $pengguna->tanggal_lahir,
			'tempatlahir' => $pengguna->tempat_lahir, 'warganegara' => $pengguna->warga_negara, 'foto'=>$pengguna->foto, 'jeniskelamin' => $pengguna->jenis_kelamin,
			'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus, 'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat' => $dokter_gigi->alamat_praktik);

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('view', $data['array']);
		$this->load->view('footer');

	}

	//lancar
	public function verifyAcc($m){
	session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

	$pengguna = new pengguna();
	$pengguna->where('id', $m)->update('fverifikasi', 'y');
	$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
	 		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	 			<strong>Well done!</strong> Account has been verified.
	 		</div>");
	$config = Array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'ssl://smtp.googlemail.com',
	  'smtp_port' => 465,
	  'smtp_user' => 'cita.indraswari@gmail.com', // change it to yours
	  'smtp_pass' => 'jowoon151294', // change it to yours
	  'mailtype' => 'html',
	  'charset' => 'iso-8859-1',
	  'wordwrap' => TRUE
	);
		//$message = $Umur;
	$pengguna->where('id', $m)->get();
	$email = $pengguna->email;
	$username = $pengguna->username;
	$message = $pengguna->password;
		$this->load->library('email', $config);
	  $this->email->set_newline("\r\n");
	  $this->email->from('cita.indraswari@gmail.com'); // change it to yours
	  $this->email->to($email);// change it to yours
	  $this->email->subject('Account Telehealth Orthodontist has been verified');
	  $this->email->message('Username : '.$username. '  , Password : ' .$message. '');
	  $this->email->send();

	$data['array'] = array('content' => '<a href="../verify">Back to verify.</a>');
	$this->load->view('header-admin', $data['menu']);
	$this->load->view('result-admin', $data['array']);
	$this->load->view('footer');
			
	}
	public function decline($id){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->delete($id);
		if($status)
			redirect("drg/pasien_read");
			// $status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
			// 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			// 		<strong>Well done!</strong> Account successfully deleted.
			// 	</div>");
			// $status['array']=array('content' => '<a href="verify">Back to verify.</a>');
			// $this->load->view('header-admin', $status['menu']);
			// $this->load->view('result-admin', $status['array']);
			// $this->load->view('footer');
		
	}

	public function change(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new Pengguna();
			$pengguna->where('username', $_SESSION['admin'])->get();

			$isRegistered = $pengguna->result_count() == 0 ? false : true;
			if($isRegistered){
				if($pengguna->username==$_SESSION['admin']){
					if($pengguna->password == $OldPassword){
						if($NewPassword==$RNewPassword){
							$pengguna->where('username', $_SESSION['admin'])->update('password',$NewPassword);
							$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Password has been changed.
									</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('changepassword-admin');
							$this->load->view('footer');
						}else{
							$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Warning!</strong> Wrong new password.
									</div>");	
							$this->load->view('header-admin', $data['menu']);
							$this->load->view('changepassword-admin');
							$this->load->view('footer');
						}
					}else{
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Wrong password.
							</div>");	
					$this->load->view('header-admin', $data['menu']);
					$this->load->view('changepassword-admin');
					$this->load->view('footer');
					}
				}
			}
		}else{
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('changepassword-admin');
		$this->load->view('footer');
		}	
	}


	public function register(){
		//session_start();
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$Username = $_POST['Username'];
			$Password = $_POST['Password'];
			$Email = $_POST['Email'];
			$Nama = $_POST['Nama'];
			$Tempat_Lahir = $_POST['Tempat_Lahir'];
			$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
			$Warga_Negara = $_POST['Warga_Negara'];
			$Jenis_Kelamin = $_POST['Jenis_Kelamin'];
			if($Jenis_Kelamin=='Laki-laki'){
				$Foto='uploads/images/man.png';
			}
			else{
				$Foto='uploads/images/woman.png';
			}
			$Agama = $_POST['Agama'];

			$Pendidikan = $_POST['Pendidikan'];
			$Kursus = $_POST['Kursus'];	
			$Alamat = $_POST['Alamat'];
			$Kodepos =$_POST['Kodepos'];
			$Role = $_POST['Role'];

			$pengguna = new pengguna();
			$dokter_gigi = new dokter_gigi();
			$drg_ortodonti = new drg_ortodonti();

			$pengguna->where('username', $Username)->get();
			
			$isRegistered = $pengguna->result_count() == 0 ? false : true;

			if($isRegistered==false){			
				   $pengguna->username =$Username;
				   $pengguna->password = $Password;
				   $pengguna->nama = $Nama;
				   $pengguna->tanggal_lahir = $Tanggal_Lahir;
				   $pengguna->tempat_lahir = $Tempat_Lahir;
				   $pengguna->warga_negara = $Warga_Negara;
				   $pengguna->jenis_kelamin = $Jenis_Kelamin;
				   $pengguna->agama = $Agama;
				   $pengguna->foto = $Foto;
				   $pengguna->fverifikasi = 'y';
				   $pengguna->email = $Email;
				   
				   $pengguna->role = $Role;
				   
				   $pengguna->validate();
				   if($pengguna->valid){
				   		$pengguna->save();
				   		$pengguna->where('username', $Username)->get();
					
						$dokter_gigi->pengguna_id= $pengguna->id;
						$dokter_gigi->kursus = $Kursus;
						$dokter_gigi->pendidikan_dokter = $Pendidikan;
						$dokter_gigi->alamat_praktik = $Alamat;
						$dokter_gigi->kode_pos = $Kodepos;

						$dokter_gigi->validate();
						if($dokter_gigi->valid){
							$dokter_gigi->save();
							$drg_ortodonti->doktergigi_id=$pengguna->id;
							$drg_ortodonti->save();
							
							$config = Array(
							  'protocol' => 'smtp',
							  'smtp_host' => 'ssl://smtp.googlemail.com',
							  'smtp_port' => 465,
							  'smtp_user' => 'cita.indraswari@gmail.com', // change it to yours
							  'smtp_pass' => 'jowoon151294', // change it to yours
							  'mailtype' => 'html',
							  'charset' => 'iso-8859-1',
							  'wordwrap' => TRUE
							);

							$Email1 = $Email;
								$this->load->library('email', $config);
							  $this->email->set_newline("\r\n");
							  $this->email->from('cita.indraswari@gmail.com'); // change it to yours
							  $this->email->to($Email1);// change it to yours
							  $this->email->subject('Konfirmasi Pendaftaran Telehealth Orthodontist');
							  $this->email->message('Username : '.$Username. '  , Password : ' .$Password. '');
							if($this->email->send())
							{
									$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  					<strong>Well done!</strong> Account has been created. Email sent.
									</div>");	
									$this->load->view('header-admin', $data['menu']);
									$this->load->view('register');
									$this->load->view('footer');
							}
							else
							{
									$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  					<strong>Warning!</strong> Email not sent.
										</div>");	
									$this->load->view('header-admin', $data['menu']);
									$this->load->view('register');
									$this->load->view('footer');
							}
						}else{
									$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  					<strong>Warning!</strong> Account has not created.".$dokter_gigi->error->kursus."".$dokter_gigi->error->pendidikan_dokter."".$dokter_gigi->error->alamat_prakitk."".$dokter_gigi->error->kode_pos."
										</div>");	
									$this->load->view('header-admin', $data['menu']);
									$this->load->view('register');
									$this->load->view('footer');
						}
				   }else{
				   		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-warning alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					  					<strong>Warning!</strong> Account has not created.".$pengguna->error->username."".$pengguna->error->password."".$pengguna->error->email."".$pengguna->error->nama."".$pengguna->error->email."".$pengguna->error->tanggal_lahir."".$pengguna->error->tempat_lahir."".$pengguna->error->warga_negara."".$pengguna->error->jenis_kelamin."".$pengguna->error->agama."".$pengguna->error->role."
										</div>");	
									$this->load->view('header-admin', $data['menu']);
									$this->load->view('register');
									$this->load->view('footer');

				   }										
			}else{
				$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Warning!</strong> Username has been registered.
							</div>");	
				$this->load->view('header-admin', $data['menu']);
				$this->load->view('register');
				$this->load->view('footer');
					
			}
	
		}else{
			$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('register');
			$this->load->view('footer');
		}
	}

		//lancar
	public function retrieve(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$pengguna = new pengguna();
			$pengguna->get();
			$temp = "";
			foreach($pengguna as $row){
				if($row->role != "admin" && $row->fverifikasi == "y"){
						$temp .= "
						<div class='col-md-4'>
							<div class='thumbnail'>
								<center><img alt='140x140' src='../../".$row->foto."' style='width:125px; height:125px;' class='img-circle'></center>
								<div class='caption'>
									<h4><center>".$row->username."</center></h4>
									<center>
									<p>".$row->nama."</p>
									<p>".$row->email."</p>
									<p>".$row->role."</p>
									<p>
										<a class='btn btn-primary' href='../admin/view/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Details</span></a>
										<a class='btn btn-danger' href='../admin/delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'> Delete </span></a> 
									</p>
									</center>
								</div>
							</div>
						</div>";
				$data['array']= array('content' => $temp);		
			}
			}
		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('retrieve', $data['array']);
		$this->load->view('footer');
	
	}

	public function view_data_dokter($m){
	
	session_start();
	if(!isset($_SESSION['admin']))
		redirect ("homepage");
	
	$pengguna = new Pengguna();
	$dokter_gigi = new dokter_gigi();
	$drg_ortodonti = new drg_ortodonti();
	$pengguna->where('id', $m)->get();
	$dokter_gigi->where('pengguna_id', $m)->get();


	$data['array']= array('content' => '<tr><td>Name</td><td>' .$pengguna->nama.'</td><tr>
		<tr><td>Email</td><td>'.$pengguna->email.'</td></tr>
		<tr><td>Date of Birth</td><td>'.$pengguna->tanggal_lahir.'</td></tr>
		<tr><td>TPlace of Birth</td><td>'.$pengguna->tempat_lahir.'</td></tr>
		<tr><td>Nationality</td><td>'.$pengguna->warga_negara.'</td></tr>
		<tr><td>Gender</td><td>'.$pengguna->jenis_kelamin.'</td></tr>
		<tr><td>Religion</td><td>'.$pengguna->agama.'</td></tr>
		<tr><td>Photo</td><td>'.$pengguna->foto.'</td></tr>
		<tr><td>Course</td><td>'.$dokter_gigi->kursus.'</td></tr>
		<tr><td>Education</td><td>'.$dokter_gigi->pendidikan_dokter.'</td></tr>
		<tr><td>Clinic Address</td><td>'.$dokter_gigi->alamat_praktik.'</td></tr>
		<tr><td colspan="2"><a class="btn btn-primary" href="../verifyAcc/'.$m.'">Verify</a></td>'
		);
	
	$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
	$this->load->view('header-admin', $data['menu']);
	$this->load->view('view_data_dokter', $data['array']);
	$this->load->view('footer');
	}


	public function logout(){	
		session_start();
		//hapus session
		session_destroy();
		//alihkan kehalaman login (index.php)
		redirect('homepage');
	}

	public function delete(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('delete');
		$this->load->view('footer');

		$pengguna = new Pengguna();
	}
		
	public function update(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('update');
		$this->load->view('footer');

		$pengguna = new Pengguna();
	}

	public function listupdate(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$data['menu'] = array('home' => '', 'manage' => 'active', 'jadwal' => '', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('listupdate');
		$this->load->view('footer');

	}

	public function edit_profile(){
	session_start();
	if(!isset($_SESSION['admin']))
		redirect ("homepage");
	$pengguna = new pengguna();
	$pengguna->where('username', $_SESSION['admin'])->get();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Nama = $_POST['Nama'];
		$Tempat_Lahir = $_POST['Tempat_Lahir'];
		$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
		$Warga_Negara = $_POST['Warga_Negara'];
		$Agama = $_POST['Agama'];
		
		$pengguna = new pengguna();
		//$pengguna->where('username', $_SESSION['admin'])->get();
		$pengguna->where('username', $_SESSION['admin'])->update('nama',$Nama);
		$pengguna->where('username', $_SESSION['admin'])->update('tempat_lahir',$Tempat_Lahir);
		$pengguna->where('username', $_SESSION['admin'])->update('tanggal_lahir',$Tanggal_Lahir);
		$pengguna->where('username', $_SESSION['admin'])->update('warga_negara',$Warga_Negara);
		$pengguna->where('username', $_SESSION['admin'])->update('agama',$Agama);
		$pengguna->where('username', $_SESSION['admin'])->get();
		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('edit_profile-admin', $data['array']);
		$this->load->view('footer');

	}else{
		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('edit_profile-admin', $data['array']);
		$this->load->view('footer');
	}
}

	//lancar
	function do_upload(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$config['upload_path'] = './uploads/images';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = md5($_SESSION['admin']);
		$config['overwrite'] = true;

 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()){
			$status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Warning !</strong> Upload failure.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-admin', $status['menu']);
			$this->load->view('result-admin', $status['array']);
			$this->load->view('footer');		
		}
		else{
			$data = $this->upload->data();
			$temp ="uploads/images/";
			$temp .= $config['file_name'];
			$temp .= $data['file_ext'];
			$pengguna = new pengguna();
			$pengguna->where('username', $_SESSION['admin'])->update('foto', $temp);

			$status['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Well done!</strong> Photo profile successfully changed.
				</div>");
			$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
			$this->load->view('header-admin', $status['menu']);
			$this->load->view('result-admin', $status['array']);
			$this->load->view('footer');
			//$this->load->vfprintf(handle, format, args)iew('admin', $data);
		}
	}


		public function delete1($id){
			session_start();
			if(!isset($_SESSION['admin']))
				redirect ("homepage");

		$this->load->model('penggunas');
		$status = $this->penggunas->delete($id);
		if($status)
			redirect("admin/retrieve");
		
	}

		

	public function diagnosa(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$analisi = new analisi();
		$analisi->order_by('id', 'desc')->get();
		$content="";
		if($analisi->result_count() != 0){
			$content = "<table class='table table-hover'>
						<thead>
						<tr>
							<td><center><b>Date</b><center></td>
							<td><center><b>Patient's name</center></b></td>
							<td><center><b>FKG UI's Id</center></b></td>
							<td><center><b>Operation</center></b></td>
						</tr>
						</thead>";
			foreach($analisi as $row){
				if($row->flag_mengirim=='1' && $row->flag_membaca!=1){
					$pasien = new pasien();
					$pasien->where('id', $row->pasien_id)->get();
					$content .= "<tr><td><center>".$row->waktu."</center></a></td>
								 <td><center>".$pasien->nama."</center></td>
								 <td><center>".$row->orto_id."</center></td>
								 <td><center><a class='btn btn-primary' href='../admin/read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td></tr>";
				}
				else if($row->flag_mengirim=='1' && $row->flag_membaca==1){
					$pasien = new pasien();
					$pasien->where('id', $row->pasien_id)->get();
					$content .= "<tr><td><b><center>".$row->waktu."</center></a></b></td>
								 <td><b><center>".$pasien->nama."</center></b></td>
								 <td><b><center>".$row->orto_id."</center></b></td>
								 <td><b><center><a class='btn btn-primary' href='../admin/read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></b></td></tr>";
				}
			}
			$content .=  "</table>";
			$data['array']=array('content'=>$content);
		}
		else{
			$data['array']=array();
		}
		
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('diagnosa', $data['array']);
		$this->load->view('footer');
	}

	public function read_diagnosa($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$analisi = new analisi();
		$analisi->where('id', $n)->get();
		$analisi1 = new analisi();
		$analisi1->where('id', $n)->update('flag_membaca', '2');
		$splitTimeStamp = explode(" ",$analisi->waktu);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1];
		$pengguna = new pengguna();
		$pengguna->where('id', $analisi->orto_id)->get();

		$data['array'] = array('content' => '<tr><td><b>Date</b></td><td>'.$date.'</td></tr>
			<tr><td><b>Time</b></td><td>'.$time.'</td></tr>
			<tr><td><b>From FKG UI</b></td><td>'.$pengguna->nama.'</td`></tr>
			<tr><td><b>Id pasien</b></td><td>'.$analisi->pasien_id.'</td></tr>
			<tr><td><b>PAR Score</b></td><td>'.$analisi->skor.'</td></tr>
			<tr><td><b>Malocclusion</b></td><td>'.$analisi->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Recommendation</b></td><td>'.$analisi->diagnosis_rekomendasi.'</td></tr>
			<tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="../../../'.$analisi->foto.'"></center></tr></td>
			<tr><td colspan="2"><form method="post" action="../send_rujukan/'.$n.'"><center><button type="submit" class="btn btn-primary ">Send Reference</button></center></form>
			</td></tr>');

		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('read_diagnosa', $data['array']); 
		$this->load->view('footer');
	}

	public function send_rujukan($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti' && $row->fverifikasi=='y')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}

		$data['array'] = array('n' => $n, 'option' =>$option);
		//$data['array'] = array('content' => $option, 'n'=> $n);					
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('send_rujukan', $data['array']);
		$this->load->view('footer');
	}

	public function send_rujukan_lagi($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$tanggal = $_POST['tanggal'];
		 	$kandidat1 = $_POST['nama'];
			
		 	$mengirim = new mengirim();
		 	$merawat = new merawat();
		 	$analisi = new analisi();
		 	$admin = new admin();
		 	$pengguna = new pengguna();

		 	$mengirim->tanggal=$tanggal;
	 		$mengirim->kandidat1=$kandidat1;
	 		$pengguna->where('username', $_SESSION['admin'])->get();		
	 		//echo ($pengguna->id);
	 		$mengirim->admin_id= $pengguna->id;
	 		$mengirim->analisis_id=$n;
	 		$analisi->where('id', $n)->get();
	 		$lala= $analisi->pasien_id;
	 		$merawat->where('pasien_id', $lala)->get();
	 		$mengirim->umum_id=$merawat->umum_id;
	 		$mengirim->orto_id=$merawat->orto_id;
	 		$mengirim->pusat_id=$analisi->orto_id;
	 		//$mengirim->save();

	 		$mengirim->validate();
	 		if($mengirim->valid){
	 			$mengirim->save();
		 			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Referral has been sent.
								</div>");	
		 		$data['array'] = array('content' => '<a href ="../diagnosa">Back to diagnosa.</a>');
				$this->load->view('header-admin', $data['menu']);
				$this->load->view('result-admin', $data['array']);
				$this->load->view('footer');
	 		}
	 		else{
	 			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					Referral has not been sent.".$mengirim->error->tanggal."".$mengirim->error->kandidat1."".$mengirim->error->kandidat2."".$mengirim->error->kandidat3."".$mengirim->error->kandidat4."".$mengirim->error->kandidat5."
							</div>");	
	 					$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti' && $row->fverifikasi=='y')
				$option .= "<option value='".$row->nama."'>".$row->nama."</option>";
		}
	 					$data['array'] = array('n' => $n, 'option' =>$option);
		//$data['array'] = array('content' => $option, 'n'=> $n);					
		//data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('send_rujukan', $data['array']);
		$this->load->view('footer');
	 		}
	 		
	 			 							
		}
	}	

		public function createjadwal($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");



		$option="";
		
		$pengguna = new pengguna();
		$pengguna->get();
		foreach ($pengguna as $row) {
			if($row->role == 'orthodonti' && $row->fverifikasi=='y')
				$option .= "<option value='".$row->id."'>".$row->nama."</option>";
		}
		$jadwal_jaga = new jadwal_jaga();
		$jadwal_jaga->where('id', $n)->get();

		$data['array'] = array('option' =>$option, 'jam_mulai'=> $jadwal_jaga->jam_mulai, 'jam_selesai'=>$jadwal_jaga->jam_selesai, 'n'=>$n);
		//$data['array'] = array('content' => $option, 'n'=> $n);					
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => 'active', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('createjadwal', $data['array']);
		$this->load->view('footer');
	}



		public function savejadwal($n){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 	$mulai = $_POST['Start'];
			$selesai = $_POST['End'];
			$Dokter = $_POST['Doctor'];

		 	$pengguna = new pengguna();
		 	$jadwaljaga = new jadwal_jaga();
		 	$pengguna1 = new pengguna();

			//$jadwaljaga->where('id', $n)->update('hari',$hari);
		 	$jadwaljaga->where('id', $n)->update('jam_mulai', $mulai);
		 	$jadwaljaga->where('id', $n)->update('jam_selesai', $selesai);
			$jadwaljaga->where('id', $n)->update('drg_ortodonti_id', $Dokter);

			


	 		$pengguna->where('username', $_SESSION['admin'])->get();
	 		$jadwaljaga->where('id', $n)->update('admin_id', $pengguna->id);


	 		// $jadwaljaga->validate();
	 		// if($jadwaljaga->valid){

	 			redirect("admin/retrievejadwal");
	 			
		}

		//$data['array'] = array('option' =>$option);
		//$data['array'] = array('content' => $option, 'n'=> $n);					
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => 'active', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('createjadwal');
		$this->load->view('footer');
	}
		public function retrievejadwal(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");

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
							<td><center><b>Operation</b></center></td>
						</tr>
						</thead>";
			foreach($jadwaljaga as $row){
				$pengguna = new pengguna();
				$pengguna-> where('id',$row->drg_ortodonti_id)->get();
					$content .= "<tr><td><center>".$row->hari."</center></a></td>
								 <td><center>".$row->jam_mulai."</center></td>
								 <td><center>".$row->jam_selesai."</center></td>
								 <td><center>".$pengguna->nama."</center></td>
								 <td><center><a class='btn btn-warning' href='../admin/createjadwal/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'> Update</span></a>
								 </center></td></tr>";
			}
			$content .=  "</table>";
			$data['array']=array('content'=>$content);
		}
		else{
			$data['array']=array();
		}
		
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => 'active', 'inbox' => '', 'setting' => '');	
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('retrievejadwal', $data['array']);
		$this->load->view('footer');
	}

	public function list_outbox(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		
		$content="";
		$content1="";
		$mengirim = new mengirim();
		$mengirim->get();
		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['admin'])->get();		
		$lala = $pengguna->id;
		$pesan = new pesan();
		$pesan->get();
		$content.='<table class="table table-hover">
				<thead>
				<tr>
				<td><center><b>Time</center></b></td>
				<td><center><b>To</center></b></td>
				<td><center><b>Information</center></b></td>
				<td><center><b>Operation</center></b></td>
				</tr>
				</thead>';
		$content1.='<table class="table table-hover">
				<thead>
				<tr>
				<td><center><b>Time</center></b></td>
				<td><center><b>To</center></b></td>
				<td><center><b>Information</center></b></td>
				<td><center><b>Operation</center></b></td>
				</tr>
				</thead>';
		foreach($mengirim->order_by('id', 'desc')->get() as $row){
			//foreach ($pesan as $row1) {

				if($row->umum_id!=null && $row->admin_id!=null && $row->flag_outbox!=1){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->umum_id)->get();
					$content .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Reference and Diagnosis</center></td>
									<td><center><a class='btn btn-primary' href='../admin/view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
				}
				else if($row->orto_id!=null && $row->admin_id!=null && $row->flag_outbox!=1){
					echo 'lala';
					$nama_penerima1 = new pengguna();
					$nama_penerima1->where('id', $row->orto_id)->get();
					$content .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>".$nama_penerima1->nama."</center></td>
									<td><center>Reference and Diagnosis</center></td>
									<td><center><a class='btn btn-primary' href='../admin/view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
				}
				else if($row->umum_id!=null && $row->admin_id!=null && $row->flag_outbox==1){
					$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->umum_id)->get();
					$content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><center><b>".$nama_penerima->nama."</b></center></td>
									<td><center><b>Reference and Diagnosis</b></center></td>
									<td><center><b><a class='btn btn-primary' href='../admin/view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";					
				}
				else if($row->orto_id!=null && $row->admin_id!=null && $row->flag_outbox==1){
					echo 'lala';
					$nama_penerima1 = new pengguna();
					$nama_penerima1->where('id', $row->orto_id)->get();
					$content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><b><center>".$nama_penerima1->nama."</center></b></td>
									<td><<b>center>Reference and Diagnosis</center></b></td>
									<td><center><b><a class='btn btn-primary' href='../admin/view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";
				}
			
		} 
		foreach ($pesan->order_by('id', 'desc')->get() as $row) {
			if($row->pengguna_id==$lala && $row->flag_outbox!=1){
				$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->penerima_id)->get();
					$content1 .= "<tr><td><center>".$row->waktu."</center></a></td>
									<td><center>".$nama_penerima->nama."</center></td>
									<td><center>Message</center></td>
									<td><center><a class='btn btn-primary' href='../admin/outbox_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
			}
			if($row->pengguna_id==$lala && $row->flag_outbox==1){
				$nama_penerima = new pengguna();
					$nama_penerima->where('id', $row->penerima_id)->get();
					$content1 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
									<td><b><center>".$nama_penerima->nama."</center></b></td>
									<td><b><center>Message</center></b></td>
									<td><center><b><a class='btn btn-primary' href='../admin/outbox_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";
			}
		}
				
		$content.='</table>';
		$content1.='</table>';

		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content, 'content1'=>$content1);
		//$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('list_outbox');
		$this->load->view('footer');
	}

		public function view_reference_admin($n){
		  session_start();
		  if(!isset($_SESSION['admin']))
		  	redirect ("homepage");
		
		$pengguna = new pengguna();
		$pengguna->where('username', $_SESSION['admin'])->get();
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
			<tr><td><b>Recipient ID</b></td><td>'.$mengirim->umum_id.'</td></tr>
			<tr><td><b>Recipient Name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Admins Name</b></td><td>'.$nama_admin->nama.'</td></tr>
			<tr><td><b>Doctors Name</b></td><td>'.$nama_pusat->nama.'</td></tr>
			<tr><td><b>Patients ID</b></td><td>'.$analisis->pasien_id.'</td></tr>
			<tr><td><b>Patients Name</b></td><td>'.$nama_pasien->nama.'</td></tr>
			<tr><td><b>PAR Score</b></td><td>'.$analisis->skor.'</td></tr>
			<tr><td><b>Malocclusion</b></td><td>'.$analisis->maloklusi_menurut_angka.'</td></tr>
			<tr><td><b>Diagnosis</b></td><td>'.$analisis->diagnosis_rekomendasi.'</td></tr>
			<tr><td><center><img alt="140x140" src="../../'.$analisis->foto.'" style="width:125px; height:125px;" class="img-circle"></center></tr></td>
			<tr><td><b>Candidate 1</b></td><td>'.$mengirim->kandidat1.'</td></tr>
			<tr><td><b>Candidate 2</b></td><td>'.$mengirim->kandidat2.'</td></tr>
			<tr><td><b>Candidate 3</b></td><td>'.$mengirim->kandidat3.'</td></tr>
			<tr><td><b>Candidate 4</b></td><td>'.$mengirim->kandidat4.'</td></tr>
			<tr><td><b>Candidate 5</b></td><td>'.$mengirim->kandidat5.'</td></tr>');

		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('view_reference_admin', $data['array']);
		$this->load->view('footer');
	}

	public function send_message_admin(){
		session_start();
		if(!isset($_SESSION['admin']))
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

			$pengguna->where('username', $_SESSION['admin'])->get();
			$pesan->pengguna_id=$pengguna->id;
			$pesan->penerima_id=$_POST['tujuan'];
			$pesan->subject=$subject;
			$pesan->isi=$isi;

			$pesan->validate();
			if($pesan->valid){
				$pesan->save();	
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
			}
			else{
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
				  					
				  			// 		
									// </div>");
			}
			$data['array'] = array('content' => $tujuan);	
			//$data['menu'] = array('home' => '', 'pasien' => 'active', 'inbox' => '', 'setting' => '');		
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('send_message_admin', $data['array']);
			$this->load->view('footer');
			
		}else{

			$data['array'] = array('content' => $tujuan);	
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');		
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('send_message_admin', $data['array']);
			$this->load->view('footer');
		}

	}



	public function list_pengguna_admin(){
 	 session_start();
		  if(!isset($_SESSION['admin']))
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
									<td><center><a class='btn btn-primary' href='../admin/send_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> </center></td>
								</tr>";
				
			}
			$content .= "</table>";
			$data['array']=array('content'=> $content);
		}

		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('list_pengguna_admin', $data['array']);
		$this->load->view('footer');

	}

	public function view_message_admin(){
		session_start();
		if(!isset($_SESSION['admin']))
			redirect ("homepage");
		$content="";
		$pesan = new pesan();
		$pesan->get();

		$pengguna = new pengguna;
		$pengguna->where('username', $_SESSION['admin'])->get();		
 		$idPengguna = $pengguna->id;
		$content .= '<table class="table table-hover">
				<thead>
				<tr>
					<td><center><b>From</center></b></td>
					<td><center><b>Subject</center></b></td>
					<td><center><b>Action</center></b></td>
				</tr>
				</thead>';				
		foreach($pesan as $row){
			if($row->penerima_id==$idPengguna){
				$nama_pengirim = new pengguna();
				$nama_pengirim->where('id', $row->pengguna_id)->get();
				$content .= "<tr><td><center>".$nama_pengirim->nama."</center></a></td>
								<td><center>".$row->subject."</center></td>
								<td><center><a class='btn btn-primary' href='../admin/detail_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td>
							</tr>";
			}
		}
		$content.='</table>';
		
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'content'=>$content);
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('view_message_admin');
		$this->load->view('footer');
	}
	
		public function detail_message_admin($n){
		 session_start();
		 if(!isset($_SESSION['admin']))
			redirect ("homepage");

		$pesan = new pesan();
		$pesan->where('id', $n)->get();
		$pengguna = new pengguna();
		$pengguna->where('id',$pesan->pengguna_id)->get();
		$data['array'] = array('content' => '<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('detail_message_admin', $data['array']); 
		$this->load->view('footer');
	}

		public function outbox_message_admin($n){
		 session_start();
		 if(!isset($_SESSION['admin']))
			redirect ("homepage");

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
			<tr><td><b>Recipient ID</b></td><td>'.$pesan->penerima_id.'</td></tr>

			<tr><td><b>Recipient Name</b></td><td>'.$nama_penerima->nama.'</td></tr>
			<tr><td><b>Subject</b></td><td>'.$pesan->subject.'</td></tr>
			<tr><td><b>Sender</b></td><td>'.$pengguna->nama.'</td></tr>
			<tr><td><b>Message</b></td><td>'.$pesan->isi.'</td></tr>
			</td></tr>');


		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '');
		$this->load->view('header-admin', $data['menu']);
		$this->load->view('outbox_message_admin', $data['array']); 
		$this->load->view('footer');
	}

}
?>