<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	var $profile_construct;
	public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
    		session_start();
    	}
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

    public function home(){
    	$pengguna = new pengguna();
    	$pengguna->get();
    	if($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
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
			$data['menu'] = array('home' => 'active', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => '', 'profile_construct'=>$this->profile_construct, 'latlon'=>$latlon);
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('home-admin');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$data['menu'] = array('home' => 'active', 'profile_construct'=>$this->profile_construct, 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => '');
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('home');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
			$data['menu'] = array('home' => 'active', 'profile_construct'=>$this->profile_construct, 'pasien' => '', 'inbox' => '', 'setting' => '');
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('home');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$data['menu'] = array('home' => 'active', 'profile_construct'=>$this->profile_construct, 'pasien' => '', 'inbox' => '', 'setting' => '');
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('home');
		}
		$this->load->view('footer');
    }

	public function editProfile(){
	$pengguna = new pengguna();
	$pengguna->where('id', $_SESSION['id'])->get();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Nama = $_POST['Nama'];
		$Tempat_Lahir = $_POST['Tempat_Lahir'];
		$Tanggal_Lahir = $_POST['Tanggal_Lahir'];
		$Warga_Negara = $_POST['Warga_Negara'];
		$Agama = $_POST['Agama'];
		
		$pengguna = new pengguna();
		$pengguna->where('id', $_SESSION['id'])->update('nama',$Nama);
		$pengguna->where('id', $_SESSION['id'])->update('tempat_lahir',$Tempat_Lahir);
		$pengguna->where('id', $_SESSION['id'])->update('tanggal_lahir',$Tanggal_Lahir);
		$pengguna->where('id', $_SESSION['id'])->update('warga_negara',$Warga_Negara);
		$pengguna->where('id', $_SESSION['id'])->update('agama',$Agama);
		$pengguna->where('id', $_SESSION['id'])->get();

		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti' || $pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat' || $pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->update('kursus', $_POST['kursus']);
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->update('pendidikan_dokter', $_POST['pendidikan']);
			//$dokter_gigi->where('pengguna_id', $_SESSION['id'])->update('alamat_prakitk', $_POST['alamat']);	
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->update('kode_pos', $_POST['kodepos']);
			if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
				$drg_lain = new drg_lain();
				$drg_lain->where('pengguna_id', $_SESSION['id'])->update('kursus_ortodonti', $_POST['kursus_orthodonti']);
				$drg_lain->where('pengguna_id', $_SESSION['id'])->update('jadwal_praktik', $_POST['jadwal']);
			}
		}
		$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");	
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('edit_profile-admin', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$drg_lain->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('edit_profile-drg', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('edit_profile-orthodonti', $data['array']);
			$this->load->view('footer');
		}
	}else{
		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){	
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);	
			$this->load->view('header-admin', $data['menu']);
			$this->load->view('edit_profile-admin', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
			$dokter_gigi = new dokter_gigi();
			$drg_lain = new drg_lain();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$drg_lain->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos,
			'kursus_orthodonti'=> $drg_lain->kursus_ortodonti, 'jadwal'=>$drg_lain->jadwal_praktik);
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('edit_profile-drg', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('edit_profile-orthodonti', $data['array']);
			$this->load->view('footer');
		}
	}
	}

	public function changePassword(){
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$OldPassword = $_POST['OldPassword'];
			$NewPassword = $_POST['NewPassword'];
			$RNewPassword = $_POST['RNewPassword'];

			$pengguna = new pengguna();
			$pengguna->where('id', $_SESSION['id'])->get(); 
			
			if($pengguna->password == $OldPassword){
				if($NewPassword==$RNewPassword){
					$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
					if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");	
						$this->load->view('header-admin', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}
				}else{
					if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
						$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-admin', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword');
						$this->load->view('footer');
					}
				}		
			}else{
				$pengguna = new pengguna();
				if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-orthodonti', $data['menu']);
					$this->load->view('changepassword');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");
					$this->load->view('header-pusat', $data['menu']);
					$this->load->view('changepassword');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-admin', $data['menu']);
					$this->load->view('changepassword');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-drg', $data['menu']);
					$this->load->view('changepassword');
					$this->load->view('footer');
				}
			}
		}else{
			$pengguna = new pengguna();
			if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
				$this->load->view('header-orthodonti', $data['menu']);
				$this->load->view('changepassword');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
				$this->load->view('header-pusat', $data['menu']);
				$this->load->view('changepassword');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
				$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);	
				$this->load->view('header-admin', $data['menu']);
				$this->load->view('changepassword');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);	
				$this->load->view('header-drg', $data['menu']);
				$this->load->view('changepassword');
				$this->load->view('footer');
			}
		}	
	}
	
	public function logout(){	
		session_destroy();
		redirect('homepage');
	}

	public function send_message(){
		$pengguna = new pengguna();
		$pengguna->get();
		$tujuan="";
		foreach($pengguna as $row){
			$tujuan .= "<option value='".$row->id."'>".$row->nama." (".$row->email.")</option>";
		}

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$subject = $_POST['subject'];
			$isi = $_POST['isi'];

			$pesan = new pesan();
			$pengguna = new pengguna();

			$pengguna->where('id', $_SESSION['id'])->get();
			$pesan->pengguna_id=$pengguna->id;
			$pesan->penerima_id=$_POST['tujuan'];
			$pesan->subject=$subject;
			$pesan->isi=$isi;

			$pesan->validate();
			$data['array'] = array('content' => $tujuan);
			if($pesan->valid){
				$pesan->save();
				if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){	
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
					$this->load->view('header-drg', $data['menu']);
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
					$this->load->view('header-pusat', $data['menu']);
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
					$this->load->view('header-admin', $data['menu']);
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Message has been sent.
							</div>");
					$this->load->view('header-orthodonti', $data['menu']);
				}
			}
			else{
				if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){	
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'','setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
					$this->load->view('header-drg', $data['menu']);
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'','setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
					$this->load->view('header-pusat', $data['menu']);
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
					$this->load->view('header-admin', $data['menu']);	
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Message has been not sent</strong>".$pesan->error->subject."".$pesan->error->isi."".$pesan->error->penerima_id."
							</div>");
					$this->load->view('header-orthodonti', $data['menu']);	
				}
			}	
			$this->load->view('send_message', $data['array']);
			$this->load->view('footer');
			
		}else{
			$data['array'] = array('content' => $tujuan);	
			if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'', 'setting' => '');
				$this->load->view('header-drg', $data['menu']);
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=>'', 'setting' => '');
				$this->load->view('header-pusat', $data['menu']);
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
				$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'profile_construct'=>$this->profile_construct);
				$this->load->view('header-admin', $data['menu']);
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '');
				$this->load->view('header-orthodonti', $data['menu']);
			}
			$this->load->view('send_message', $data['array']);
			$this->load->view('footer');
		}
	}

	public function view_message($page = 1){
		$content="";
		$pesan = new pesan();
		$pesan->order_by('waktu', 'desc')->get();

		$pengguna = new pengguna;
		$pengguna->where('id', $_SESSION['id'])->get();		
 		$idPengguna = $pengguna->id;
 		$pesan->where('pengguna_id', $idPengguna)->get_paged($page, 10);

		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){	
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
			$data['array']=array('pesan'=>$pesan, 'pengguna_id'=>$idPengguna);
			$this->load->view('header-drg', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
			$data['array']=array('pesan'=>$pesan, 'pengguna_id'=>$idPengguna);
			$this->load->view('header-orthodonti', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'profile_construct'=>$this->profile_construct, 'content'=>$content);
			$data['array']=array('pesan'=>$pesan, 'pengguna_id'=>$idPengguna);
			$this->load->view('header-admin', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct,'jadwal'=>'', 'setting' => '', 'content'=>$content);
			$data['array']=array('pesan'=>$pesan, 'pengguna_id'=>$idPengguna);
			$this->load->view('header-pusat', $data['menu']);
		}

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

		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){	
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
			$this->load->view('header-drg', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
			$this->load->view('header-orthodonti', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => 'active', 'setting' => '', 'profile_construct'=>$this->profile_construct);
			$this->load->view('header-admin', $data['menu']);
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct,'jadwal'=>'', 'setting' => '');
			$this->load->view('header-pusat', $data['menu']);
		}



		
		$this->load->view('detail_message', $data['array']); 
		$this->load->view('footer');
	}
}

?>