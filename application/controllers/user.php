<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function editProfile(){
	session_start();
	if(!isset($_SESSION['id']))
		redirect ("homepage");
	
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
		$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  					<strong>Well done!</strong> Profile has been updated.
							</div>");
		if($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama);
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
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
			$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
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
			$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-drg', $data['menu']);
			$this->load->view('edit_profile-drg', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-pusat', $data['menu']);
			$this->load->view('edit_profile-pusat', $data['array']);
			$this->load->view('footer');
		}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
			$dokter_gigi = new dokter_gigi();
			$dokter_gigi->where('pengguna_id', $_SESSION['id'])->get();
			$data['array'] = array('nama' => $pengguna->nama, 'tempat_lahir' => $pengguna->tempat_lahir, 'tanggal_lahir' => $pengguna->tanggal_lahir, 
			'warga_negara' => $pengguna->warga_negara, 'agama' => $pengguna->agama, 'kursus' => $dokter_gigi->kursus,
			'pendidikan' => $dokter_gigi->pendidikan_dokter, 'alamat'=> $dokter_gigi->alamat_prakitk, 'kodepos'=> $dokter_gigi->kode_pos);
			$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
			$this->load->view('header-orthodonti', $data['menu']);
			$this->load->view('edit_profile-orthodonti', $data['array']);
			$this->load->view('footer');
		}
	}
	}

	public function changePassword(){
		session_start();
		if(!isset($_SESSION['id']))
			redirect ("homepage");

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
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword-orthodonti');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword-pusat');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");	
						$this->load->view('header-admin', $data['menu']);
						$this->load->view('changepassword-admin');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
						$pengguna->where('id', $_SESSION['id'])->update('password',$NewPassword);
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Well done!</strong> Password has been changed.
								</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword-drg');
						$this->load->view('footer');
					}
				}else{
					if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-orthodonti', $data['menu']);
						$this->load->view('changepassword-orthodonti');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");
						$this->load->view('header-pusat', $data['menu']);
						$this->load->view('changepassword-pusat');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
						$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-admin', $data['menu']);
						$this->load->view('changepassword-admin');
						$this->load->view('footer');
					}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
						$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			  					<strong>Warning!</strong> Wrong new password.
								</div>");	
						$this->load->view('header-drg', $data['menu']);
						$this->load->view('changepassword-drg');
						$this->load->view('footer');
					}
				}		
			}else{
				$pengguna = new pengguna();
				if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-orthodonti', $data['menu']);
					$this->load->view('changepassword-orthodonti');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");
					$this->load->view('header-pusat', $data['menu']);
					$this->load->view('changepassword-pusat');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
					$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-admin', $data['menu']);
					$this->load->view('changepassword-admin');
					$this->load->view('footer');
				}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
					$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  					<strong>Warning!</strong> Wrong password.
						</div>");	
					$this->load->view('header-drg', $data['menu']);
					$this->load->view('changepassword-drg');
					$this->load->view('footer');
				}
			}
		}else{
			$pengguna = new pengguna();
			if($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');
				$this->load->view('header-orthodonti', $data['menu']);
				$this->load->view('changepassword-orthodonti');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'pusat'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'jadwal'=> '', 'inbox' => '', 'setting' => 'active');
				$this->load->view('header-pusat', $data['menu']);
				$this->load->view('changepassword-pusat');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'admin'){
				$data['menu'] = array('home' => '', 'manage' => '', 'jadwal' => '', 'inbox' => '', 'setting' => 'active');	
				$this->load->view('header-admin', $data['menu']);
				$this->load->view('changepassword-admin');
				$this->load->view('footer');
			}elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
				$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active');	
				$this->load->view('header-drg', $data['menu']);
				$this->load->view('changepassword-drg');
				$this->load->view('footer');
			}
		}	
	}
}

?>