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
								<h2 class="section-heading animated" data-animation="bounceInUp"><center>List of Medical Record</center></h2><hr>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
                        <?php if(isset($content)) echo $content;?>
                        <nav>
                          <ul class="pager">
                            <?php
                                $content = "";
                                  $content = "<table class='table table-hover'>";
                                    $content .="<thead><tr>
                                                    <td><center><b><strong>ID Medical Record</strong></b></center></td>
                                                    <td><center><b><strong>Date</strong></b></center></td>
                                                    <td><center><b><strong>Operation</strong></b></center></td>
                                                    </tr>
                                                </thead>";
                                    foreach($medical_record as $row){
                                        if($row->dokter_gigi_id == $dokter_gigi_id && $row->pasien_id==$pasien_id){
                                            $content .= "<tr>
                                                        <td><center>".$row->id."</center></td>
                                                        <td><center>".$row->tanggal."</center></td>
                                                        <td><center><a class='btn btn-primary' href='../view_medical_record/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
                                                        </center></td></tr>";
                                        }
                                    }
                                    $content .= "</table>";
                                    echo $content;
                            if($medical_record->paged->has_previous): ?>
                            <li class="previous"><a href="<?= site_url('doktergigi/list_medical_record/'.$medical_record->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                            
                            <?php elseif($medical_record->paged->has_next): ?>
                            <li class="next"><a href="<?= site_url('doktergigi/list_medical_record/'.$medical_record->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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