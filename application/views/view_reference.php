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
                <h2 class="section-heading animated" data-animation="bounceInUp"><center>Reference Patient's List</ center></h2><hr>
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col-md-12">
                                            <nav>
                                                  <ul class="pager">
                                                    <?php
                                                        if($rujukan->result_count()!=0){

                                                                $content = "<table class='table table-hover'>";
                                                                $content .="<tr>
                                                                                <td><center><b><strong>Date</strong></b></center></td>
                                                                                <td><center><b><strong>Time</strong></b></center></td>
                                                                                <td><center><b><strong>From</strong></b></center></td>
                                                                                <td><center><b><strong>Action</strong></b></center></td>
                                                                                </tr>";

                                                            foreach($rujukan as $row){
                                                            $nama_pengirim = new pengguna();
                                                            $nama_pengirim->where('id', $row->pengirim_id)->get();
                                                                        
                                                            $analisi = new analisi();
                                                            $analisi->where('id',$row->analisi_id)->get();
                                                            $waktu=$row->waktu;
                                                            $splitWaktu = explode(" ", $waktu);
                                                            $date = $splitWaktu[0];
                                                            $time = $splitWaktu[1];

                                                            $pasien = new pasien();
                                                            $pasien->where('id',$analisi->pasien_id)->get();

                                                                    if($row->orto_id == $orto_id && $row->flag_membaca!=1){

                                                                            $content .= "<tr>
                                                                                        <td><center>".$date."</center></td>
                                                                                        <td><center>".$time."</center></td>
                                                                                        <td><center>".$nama_pengirim->nama."</center></td>
                                                                                        <td><center><a class='btn btn-primary' href='../orthodonti/detail_reference/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a> 
                                                                                    </tr>";
                                                                    }
                                                                    if($row->orto_id == $orto_id && $row->flag_membaca==1){
                                                                            $content .= "<tr>
                                                                                        <td><center><b>".$date."</b></center></td>
                                                                                        <td><center><b>".$time."</b></center></td>
                                                                                        <td><center><b>".$nama_pengirim->nama."</b></center></td>
                                                                                        <td><center><b><a class='btn btn-primary' href='../orthodonti/detail_reference/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></b></center></a> 
                                                                                    </tr>";
                                                                    }
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


                                                    if($rujukan->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('orthodonti/view_reference/'.$rujukan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($rujukan->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('orthodonti/view_reference/'.$rujukan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                                    <?php endif; ?>
                                                  </ul>
                                                </nav>
    </div>
    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->


</div>