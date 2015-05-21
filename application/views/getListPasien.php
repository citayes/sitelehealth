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
                <h2 class="section-heading animated" data-animation="bounceInUp"><center>List of Messages</center></h2><hr>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-md-12">
                    <nav>
                        <ul class="pager">
                            <?php
                                $content =""; 
                                if($pasien->where('doktergigi_id', $doktergigi_id)->count()!=0){
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
                                                         <td><center><a class='btn btn-primary' href='../getPasien/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
                                                             <a class='btn btn-warning' href='../pasien_update_drg/".$row->id."'><span class='glyphicon glyphicon-pencil' aria-hidden='false'></span></a>
                                                             <a class='btn btn-danger' href='../delete_drg/".$row->id."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
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
                                //echo $content;
                                    if($pasien->paged->has_previous): 
                                            ?>
                                    <li class="previous"><a href="<?= site_url('doktergigi/getListPasien/'.$pasien->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                                  
                                    <?php elseif($pasien->paged->has_next): ?>
                                    <li class="next"><a href="<?= site_url('doktergigi/getListPasien/'.$pasien->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                    <?php endif; ?>
                            </ul>
                        </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
</div>
</div>