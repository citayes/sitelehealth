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
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
							<h2 class="section-heading animated" data-animation="bounceInUp"><center>Daftar Semua Member Dokter</center></h2><hr>
						</div>
					</div>
					<div class="row">
								<nav>
                                                  <ul class="pager">
                                                    <?php
                                                    $temp = "";
                                                    if($content->where('fverifikasi', 'y')->count()!=0){
                                                        foreach($content->where('fverifikasi', 'y') as $row){
                                                            if($row->role != "admin" && $row->fverifikasi == "y"){
                                                                    $temp .= "
                                                                    <div class='col-md-4'>
                                                                        <div class='thumbnail'>
                                                                            <center><img alt='140x140' src='../../../".$row->foto."' style='width:125px; height:125px;' class='img-circle'></center>
                                                                            <div class='caption'>
                                                                                <h4><center>".$row->username."</center></h4>
                                                                                <center>
                                                                                <p>".$row->nama."</p>
                                                                                <p>".$row->email."</p>
                                                                                <p>".$row->role."</p>
                                                                                <p>
                                                                                    <a class='btn btn-primary' href='../view/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Details</span></a>
                                                                                    <a class='btn btn-danger' href='../delete1/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'> Delete </span></a> 
                                                                                </p>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                    </div>";
                                                            //$data['array']= array('content' => $temp);      
                                                            }
                                                        }

                                                         echo $temp;
                                                    }     //var_dump($temp);   
                                                    if($content->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('admin/retrieve/'.$content->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($content->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('admin/retrieve/'.$content->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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
<!-- /#wrapper -->