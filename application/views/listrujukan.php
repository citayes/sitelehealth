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
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>List Patients</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
        <div class="col-md-10">
            <nav>
                                                  <ul class="pager">
                                                    <?php
                                                        if($merawat->result_count!==0){
                                                                    $content .='<table class="table">
                                                                                <tr>
                                                                                    <td><center><b>Date</b></center></td>
                                                                                    <td><center><b>Patients Name</b></center></td>
                                                                                    <td><center><b>Dentist Name</b></center></td>
                                                                                    <td><center><b>Orthodontist Name</b></center></td>
                                                                                    <td><center><b>Operation</b></center></td>
                                                                                </tr>';
                                                                    foreach($merawat as $row){
                                                                        $pasien = new pasien();
                                                                        $pasien->where('id', $row->pasien_id)->get();
                                                                        if($row->flag_membaca!=1){
                                                                        $content .= "<tr><td><center>".$row->waktu."</center></td>
                                                                                        <td><center>".$pasien->nama."</center></td>
                                                                                        <td><center>".$pasien->nama."</center></td>
                                                                                        <td><center>".$pasien->nama."</center></td>
                                                                                        <td><center><a class='btn btn-primary' href='../show_rujukan/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td>
                                                                                        </tr>";
                                                                        }
                                                                        if($row->flag_membaca==1){
                                                                        $content .= "<tr><td><b><center>".$row->waktu."</center></b></td>
                                                                                        <td><b><center>".$pasien->nama."</center></b<</td>
                                                                                        <td><b><center>".$pasien->nama."</center></b></td>
                                                                                        <td><b><center>".$pasien->nama."</center></b></td>
                                                                                        <td><b><center><a class='btn btn-primary' href='../show_rujukan/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></b></td>
                                                                                        </tr>";
                                                                        }
                                                                    }
                                                                    $content .= '</table>';
                                                                    echo $content;
                                                                }

                                                    if($merawat->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('pusat/listujukan/'.$merawat->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($merawat->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('pusat/listrujukan/'.$merawat->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                                    <?php endif; ?>
                                                  </ul>
                                                </nav>
        </div>
        <div class="col-md-1"></div>
	</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>