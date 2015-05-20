<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
   echo $profile_construct;
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
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Diagnosis List</ center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<nav>
          <ul class="pager">
           <?php
                if($mengirim->where('orto_id', $orto_id)->count()!=0){
                    $content ='<form method="post" action="../search_patient/1"><div class="col-md-9"></div><div class="col-md-3"><div class="input-group"><input type="text" name="nama" size="35" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Go!</button>
                                            </span></div></div></form>'; 
                    $content.='<table class="table">
                        <tr>
                        <td><center><b>Date</center></b></td>
                        <td><center><b>Doctors ID</center></b></td>
                        <td><center><b>Doctors Name</center></b></td>
                        <td><center><b>Operation</center></b></td>
                    </tr>';
                foreach($mengirim as $row){
                    if($row->orto_id==$orto_id && $row->pusat_id!=null && $row->flag_membaca!=1){
                        $nama_pusat = new pengguna();
                        $nama_pusat->where('id', $row->pusat_id)->get();
                        $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                        <td><center>".$row->umum_id."</center></td>
                                        <td><center>".$nama_pusat->nama."</center></td>
                                        <td><center><a class='btn btn-primary' href='../drg/reference_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                    }
                    else if($row->orto_id==$orto_id && $row->pusat_id!=null && $row->flag_membaca==1){
                        $nama_pusat = new pengguna();
                        $nama_pusat->where('id', $row->pusat_id)->get();
                        $content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                        <td><b><center>".$row->umum_id."</center></b></td>
                                        <td><b><center>".$nama_pusat->nama."</center></b></td>
                                        <td><b><center><a class='btn btn-primary' href='../drg/reference_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                    }
                }
                $content .= "</table>";
                echo $content;
            }
            else{
                     $content = "<div class='alert alert-danger alert-dismissible' role='alert'>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                You dont have patient.
                                </div>";
                    echo $content; 
            } 

            if($mengirim->paged->has_previous): ?>
            <li class="previous"><a href="<?= site_url('orthodonti/list_reference/'.$mengirim->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
            
            <?php elseif($mengirim->paged->has_next): ?>
            <li class="next"><a href="<?= site_url('orthodonti/list_reference/'.$mengirim->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
            <?php endif; ?>
          </ul>
        </nav>
	</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->


</div>