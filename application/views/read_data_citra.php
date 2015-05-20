<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['pusat'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
        <p><b>".$pengguna->nama."</b><br>
        <p>".$pengguna->username."<br>
        <p>".$pengguna->email."<br>
        <p>".$pengguna->role."</p></center>";
        echo $profile;
    ?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mar-bot40">
						<div class="col-md-offset-3 col-md-6">
							<div class="section-header">
								<h2 class="section-heading animated" data-animation="bounceInUp"><center>List of Patients</center></h2><hr>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
						<nav>
                                                  <ul class="pager">
                                                    <?php
                                                        if($merawat->result_count()!=0){
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
                                                            $pasien = new pasien();
                                                            $pasien->where('id',$row->pasien_id)->get();
                                                            $content .= "<tr>
                                                                            <td><center>".$pasien->nama."</center></td>
                                                                            <td><center>".$pasien->umur."</center></td>
                                                                            <td><center>".$pasien->tinggi."</center></td>
                                                                            <td><center>".$pasien->berat."</center></td>
                                                                            <td><center>".$pasien->jenis_kelamin."</center></td>
                                                                            <td><center><a class='btn btn-primary' href='../read2/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a> 
                                                                                
                                                                            </center></td></tr>";
                                                            }
                                                            $content .= "</table>";
                                                            echo $content;
                                                        }

                                                    if($merawat->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('pusat/read_data_citra/'.$merawat->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($merawat->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('pusat/read_data_citra/'.$merawat->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                                    <?php endif; ?>
                                                  </ul>
                                                </nav>
					</div>
					<div class="col-md-1">
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>



<div class="container">
	
</div>