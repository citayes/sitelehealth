<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doktergigi extends CI_Controller {
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

    public function pasien(){
        $pengguna = new pengguna();
        $pengguna->where('id', $_SESSION['id'])->get();
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
                    if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Well done!</strong> Patient has been created.
                                    </div>");
                            $this->load->view('header-drg', $data['menu']);
                    }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){ 
                        $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Well done!</strong> Patient has been created.
                                    </div>");
                            $this->load->view('header-orthodonti', $data['menu']);
                        }
                }
                else{
                    if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                         $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    Patient has not been created. ".$Pasien->error->nama." ".$Pasien->error->tempat_lahir." ".$Pasien->error->tanggal_lahir." ".$Pasien->error->umur." ".$Pasien->error->alamat_rumah." ".$Pasien->error->tinggi." ".$Pasien->error->berat." ".$Pasien->error->jenis_kelamin."".$Pasien->error->warga_negara."".$Pasien->error->agama."
                                    </div>");
                        $this->load->view('header-drg', $data['menu']);
                    }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){ 
                         
                         $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    Patient has not been created. ".$Pasien->error->nama." ".$Pasien->error->tempat_lahir." ".$Pasien->error->tanggal_lahir." ".$Pasien->error->umur." ".$Pasien->error->alamat_rumah." ".$Pasien->error->tinggi." ".$Pasien->error->berat." ".$Pasien->error->jenis_kelamin."".$Pasien->error->warga_negara."".$Pasien->error->agama."
                                    </div>");
                            $this->load->view('header-orthodonti', $data['menu']);
                    }
            } 
            $this->load->view('pasien');
            $this->load->view('footer');

        }else{
            if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
                $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
                $this->load->view('header-drg', $data['menu']);
                $this->load->view('pasien');
                $this->load->view('footer');
            }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){ 
                $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
                $this->load->view('header-orthodonti', $data['menu']);
                $this->load->view('pasien');
                $this->load->view('footer');
            }
        }

    }

    public function getListPasien($page = 1){
        $pengguna = new pengguna();
        $pengguna->where('id', $_SESSION['id'])->get();
        $idDokter = $pengguna->id;
        $pasien = new pasien();
        $pasien->order_by('id', 'desc');
        $pasien->where('doktergigi_id', $idDokter)->get_paged($page, 10);

        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-drg', $data['menu']);
        }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-orthodonti', $data['menu']);
        }
        
        $data['array']=array('pasien'=>$pasien, 'doktergigi_id'=>$idDokter);
        $this->load->view('getListPasien', $data['array']);
        $this->load->view('footer');
    }

    public function getPasien($n){
        $pasien = new pasien();
        //$pasien->get();
        $pengguna = new pengguna();
        $pengguna->where('id', $_SESSION['id'])->get();

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

        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-drg', $data['menu']);
        }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-orthodonti', $data['menu']);
        }

        //$data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
        //$this->load->view('header-drg', $data['menu']);
        $this->load->view('read', $data['array']); 
        $this->load->view('footer');
    }

    public function medical_record($n){
        $data['array'] = array('n' => $n);
        $pengguna = new pengguna();
        $pengguna->where('id', $_SESSION['id'])->get();

        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                    $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
                    $this->load->view('header-drg', $data['menu']);
                    $this->load->view('medical_record', $data['array']);
                    $this->load->view('footer');
        }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
                    $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
                    $this->load->view('header-orthodonti', $data['menu']);
                    $this->load->view('medical_record', $data['array']);
                    $this->load->view('footer');
        }

    }

    public function simpan_medical_record($n){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tanggal = $_POST['tanggal'];
            $jam = $_POST['jam'];
            $deskripsi = $_POST['deskripsi'];

            $pengguna = new pengguna();
            $medical_record = new medical_record();

            $pengguna->where('id', $_SESSION['id'])->get();      
                $medical_record->dokter_gigi_id= $pengguna->id;
            $medical_record->tanggal=$tanggal;
            $medical_record->jam=$jam;
            $medical_record->deskripsi=$deskripsi;
            $medical_record->pasien_id=$n;

            $medical_record->validate();
            if($medical_record->valid){
                $medical_record->save();
                // $data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
                // $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                //          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          //                    <strong>Well done!</strong> Patient data has been saved.
                //          </div>");
                //          $this->load->view('header-drg', $data['menu']);
                //          $this->load->view('result-drg', $data['array']);
                //          $this->load->view('footer');
                if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                    redirect("doktergigi/choose_image_drg/$medical_record->id");
                }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
                    redirect("doktergigi/choose_image_drg/$medical_record->id");
                }
           
            }
            else{
                if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                    $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    Patient data not been created.".$medical_record->error->tanggal."".$medical_record->error->jam."".$medical_record->error->deskripsi."
                                    </div>");
                    $data['array'] = array('n' => $n);
                        //$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
                    $this->load->view('header-drg', $data['menu']);
                }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
                    $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    Patient data not been created.".$medical_record->error->tanggal."".$medical_record->error->jam."".$medical_record->error->deskripsi."
                                    </div>");
                    $data['array'] = array('n' => $n);
                        //$data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct);
                        $this->load->view('header-drg', $data['menu']);
                }                    
            }
        }
    }

    function choose_image_drg($n){
        $data['array']=array('n'=>$n);
        $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
        $pengguna = new pengguna();
            $pengguna->where('id', $_SESSION['id'])->get();

        //$this->load->view('header-pusat');
        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
            $this->load->view('header-drg', $data['menu']);
            $this->load->view('choose_image_drg', $data['array']);
            $this->load->view('footer');
          
        }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
            $this->load->view('header-orthodonti', $data['menu']);
            $this->load->view('choose_image_drg', $data['array']);
            $this->load->view('footer');
        }

        
    }

    function upload_image_drg($n){
        $config['upload_path'] = './uploads/citra';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = '200';
        $config['max_width']  = '2000';
        $config['max_height']  = '2000';
        $config['file_name'] = md5($n);
        //$config['overwrite'] = true;

 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload()){
            echo $this->upload->display_errors();
            if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                $status['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Warning !</strong> Upload failure.
                    </div>");
                //$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
                
                $data['array']=array('n'=>$n);
                $this->load->view('header-drg', $status['menu']);
                $this->load->view('choose_image_drg', $data['array']);
                $this->load->view('footer');
            }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
                $status['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Warning !</strong> Upload failure.
                    </div>");
                //$status['array']=array('content' => '<a href="edit_profile">Back to profile.</a>');
                
                $data['array']=array('n'=>$n);
                $this->load->view('header-orthodonti', $status['menu']);
                $this->load->view('choose_image_drg', $data['array']);
                $this->load->view('footer');
            }
        }
        else{
            $data = $this->upload->data();
            $temp ="uploads/citra/";
            $temp .= $config['file_name'];
            $temp .= $data['file_ext'];

            $pengguna = new pengguna();
            $pengguna->where('id', $_SESSION['id'])->get();

            $medical_record = new medical_record();
            $medical_record->where('id',$n)->update('foto', $temp);

            //$status['array']=array('content' => '<a href="../send_reference/'.$n.'">Send reference.</a>');

            if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){ 
                    $data['array']=array('n'=>$n);
                                $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <strong>Well done!</strong> medical record has been created.
                            </div>", 'content' => '<a href="../getListPasien">Back to patient list.</a>');
                            $this->load->view('header-drg', $data['menu']);
                    $this->load->view('result-drg');
                }elseif($pengguna->where('id', $_SESSION['id'])->get()->role == 'orthodonti'){
                    $data['array']=array('n'=>$n);
                                $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'jadwal'=> '', 'inbox' => '', 'setting' => '', 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <strong>Well done!</strong> medical record has been created.
                            </div>", 'content' => '<a href="../getListPasien">Back to patient list.</a>');
                            $this->load->view('header-drg', $data['menu']);
                    $this->load->view('result-orthodonti');
            }
        $this->load->view('footer');
        }
    }

    public function list_medical_record($n, $page = 1){
        $medical_record = new medical_record();
        $pasien = new pasien();

        $pengguna = new pengguna();
        $idDokter = $_SESSION['id'];



        $medical_record->order_by('tanggal', 'desc');
        $medical_record->where('pasien_id', $n)->get_paged($page, 10);
      
        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){    
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-drg', $data['menu']);
        }else{
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-orthodonti', $data['menu']);
        }
        $data['array']=array('medical_record' => $medical_record, 'pasien_id' => $n, 'dokter_gigi_id' => $idDokter);
        $this->load->view('list_medical_record', $data['array']);
        $this->load->view('footer');

    }

    public function view_medical_record($n){
        $medical_record = new medical_record();
        $medical_record->where('id', $n)->get();

        $pengguna = new pengguna();
            $pengguna->where('id', $_SESSION['id'])->get();

        $data['array'] = array('content' => '<tr><td><b>Medical Record ID</b></td><td>'.$medical_record->id.'</td></tr>
            <tr><td><b>Date</b></td><td>'.$medical_record->tanggal.'</td></tr>
            <tr><td><b>Time</b></td><td>'.$medical_record->jam.'</td></tr>
            <tr><td><b>Description</b></td><td>'.$medical_record->deskripsi.'</td></tr>
            <tr><td colspan="2"><b>Photo</b><br><center><img alt="140x140" src="'.base_url().''.$medical_record->foto.'"></center></tr></td>
            <td><form method="post" action="../send_data/'.$n.'"><button type="submit" class="btn btn-primary ">Send to FKG UI</button></form>
            </td></tr>');
        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-drg', $data['menu']);
        }else{
            $data['menu'] = array('home' => '', 'pasien' => 'active', 'profile_construct'=>$this->profile_construct, 'inbox' => '', 'setting' => '');
            $this->load->view('header-orthodonti', $data['menu']);
        }
        $this->load->view('view_medical_record', $data['array']); 
        $this->load->view('footer');
    }

    public function send_data($n){
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pengguna = new pengguna();
            $merawat = new merawat();

                $pengguna->where('id', $_SESSION['id'])->get();
                $id = $pengguna->id;
                $merawat->medicalrecord_id=$n;
                $merawat->umum_id= $id;
                $medical_record = new medical_record();
                $medical_record->where('id', $n)->get();
                $merawat->pasien_id=$medical_record->pasien_id;
                $merawat->save();

                if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
                    $data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
                    $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <strong>Well done!</strong> Patient data has been sent.
                                        </div>");
                    $this->load->view('header-drg', $data['menu']);
                    $this->load->view('result-drg', $data['array']);
                }else{
                    $data['array']= array('content' => '<a href ="../pasien_read">Back to Patient List.</a>');
                    $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => '', 'setting' => 'active', 'profile_construct'=>$this->profile_construct, 'status'=> "<div class='alert alert-success alert-dismissible' role='alert'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <strong>Well done!</strong> Patient data has been sent.
                                        </div>");
                    $this->load->view('header-orthodonti', $data['menu']);
                    $this->load->view('result-orthodonti', $data['array']);
                }                        
            
            }


        
        $this->load->view('footer');
        }

        public function list_reference($page = 1){
        $content="";
        $mengirim = new mengirim();
        $mengirim->order_by('waktu', 'desc')->get();

        $pengguna = new pengguna;
        $pengguna->where('id', $_SESSION['id'])->get();   
        $lala = $pengguna->id;
        
        //echo $mengirim->count();
        if($pengguna->where('id', $_SESSION['id'])->get()->role == 'umum'){
            $mengirim->where('umum_id', $lala)->get_paged($page, 10);
            $data['array']=array('mengirim'=>$mengirim, 'orto_id'=>$lala, 'umum_id' => $lala);
            $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
            $this->load->view('header-drg', $data['menu']);
            $this->load->view('list_reference', $data['array']);

        }else{
            $mengirim->where('orto_id', $lala)->get_paged($page, 10);
            $data['array']=array('mengirim'=>$mengirim, 'orto_id'=>$lala);
            $data['menu'] = array('home' => '', 'pasien' => '', 'inbox' => 'active', 'profile_construct'=>$this->profile_construct, 'setting' => '', 'content'=>$content);
            $this->load->view('header-orthodonti', $data['menu']);
            $this->load->view('list_reference', $data['array']);

        }

                $this->load->view('footer');
    }

}

?>