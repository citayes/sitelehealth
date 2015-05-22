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
							<h2 class="section-heading animated" data-animation="bounceInUp"><center>Central Diagnose List</center></h2><hr>
						</div>
					</div>
				</div>
				<div class='col-md-1'>
				</div>
				<div class="col-md-10">
                              <nav>
                      <ul class="pager">
                        <?php
                          if($analisi->result_count() != 0){
                                $content = "<table class='table'>
                                            <tr>
                                                <td><center><b>Date</b><center></td>
                                                <td><center><b>Patient's name</center></b></td>
                                                <td><center><b>FKG UI's Id</center></b></td>
                                                <td><center><b>Operation</center></b></td>
                                            </tr>";
                                foreach($analisi as $row){
                                    if($row->flag_mengirim=='1' && $row->flag_membaca!=1){
                                        $pasien = new pasien();
                                        $pasien->where('id', $row->pasien_id)->get();
                                        $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                     <td><center>".$pasien->nama."</center></td>
                                                     <td><center>".$row->orto_id."</center></td>
                                                     <td><center><a class='btn btn-primary' href='../read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></td></tr>";
                                    }
                                    else if($row->flag_mengirim=='1' && $row->flag_membaca==1){
                                        $pasien = new pasien();
                                        $pasien->where('id', $row->pasien_id)->get();
                                        $content .= "<tr><td><b><center>".$row->waktu."</center></a></b></td>
                                                     <td><b><center>".$pasien->nama."</center></b></td>
                                                     <td><b><center>".$row->orto_id."</center></b></td>
                                                     <td><b><center><a class='btn btn-primary' href='../read_diagnosa/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'> Detail</span></a></center></b></td></tr>";
                                                                                                                     }
                                }
                                $content .=  "</table>";
                                echo $content;
                            }
                        if($analisi->paged->has_previous): ?>
                        <li class="previous"><a href="<?= site_url('admin/diagnosa/'.$analisi->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                        
                        <?php elseif($analisi->paged->has_next): ?>
                        <li class="next"><a href="<?= site_url('admin/diagnosa/'.$analisi->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                        <?php endif; ?>
                      </ul>
                </nav>
                <div class='col-md-1'>
				</div>    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
</div>


