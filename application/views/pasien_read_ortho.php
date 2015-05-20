<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['orthodonti'])->get();
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
                                if($pasien->where('doktergigi_id', $doktergigi_id)->count()!=0){
                                 $content ='<form method="post" action="../search_patient/1"><div class="col-md-9"></div><div class="col-md-3"><div class="input-group"><input type="text" name="nama" size="35" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Go!</button>
                                            </span></div></div></form>'; 
                                 $content .= "<table class='table table-hover'>";
                                 $content .="<tr>
                                                 <td><center><b><strong>Name</strong></b></center></td>
                                                 <td><center><b><strong>Age</strong></b></center></td>
                                                 <td><center><b><strong>Height</strong></b></center></td>
                                                 <td><center><b><strong>Weight</strong></b></center></td>
                                                 <td><center><b><strong>Gender</strong></b></center></td>
                                                 <td><center><b><strong>Action</strong></b></center></td>
                                                 </tr>";
                                 foreach($pasien as $row){
                                         $content .= "<tr>
                                                         <td><center>".$row->nama."</center></td>
                                                         <td><center>".$row->umur."</center></td>
                                                         <td><center>".$row->tinggi."</center></td>
                                                         <td><center>".$row->berat."</center></td>
                                                         <td><center>".$row->jenis_kelamin."</center></td>
                                                         <td><center><a class='btn btn-primary' href='../read/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
                                                             <a class='btn btn-warning' href='../pasien_update2_ortho/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
                                                             <a class='btn btn-danger' href='../delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                                                             </center>
                                                         </td>
                                                     </tr>";
                                     }
                                 $content .= "</table>";
                                 echo $content;
                                }else{
                                    $content = "<div class='alert alert-danger alert-dismissible' role='alert'>
                                     <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                     You dont have patient.
                                     </div>";
                                     echo $content; 
                                }
                            if($pasien->paged->has_previous)
                            {?>
                            <li class="previous"><a href="<?= site_url('orthodonti/pasien_read_ortho/'.$pasien->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                            
                            <?php } elseif($pasien->paged->has_next)
                            {?>
                            <li class="next"><a href="<?= site_url('orthodonti/pasien_read_ortho/'.$pasien->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                            <?php } ?>
                          </ul>
                        </nav>
                    </div>
					</div>
					<div class="col-md-1">
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
