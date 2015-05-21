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
                                $content = '<table class="table">
                                    <thead>
                                    <tr>
                                        <td><center><b>Date</center></b></td>
                                        <td><center><b>From</center></b></td>
                                        <td><center><b>Subject</center></b></td>
                                        <td><center><b>Action</center></b></td>
                                    </tr>
                                    </thead>';
                                    //var_dump($pengguna_id);
                                    foreach($pesan as $row){
                                        if($row->flag_membaca!=1){
                                            $nama_pengirim = new pengguna();
                                            $nama_pengirim->where('id', $row->pengguna_id)->get();
                                            $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                            <td><center>".$nama_pengirim->nama."</center></a></td>
                                                            <td><center>".$row->subject."</center></td>
                                                            <td><center><a class='btn btn-primary' href='../user/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></center></td>
                                                        </tr>";
                                        }
                                        else if($row->flag_membaca==1){
                                            $nama_pengirim = new pengguna();
                                            $nama_pengirim->where('id', $row->pengguna_id)->get();
                                            $content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                            <td><b><center>".$nama_pengirim->nama."</center></b></a></td>
                                                            <td><b><center>".$row->subject."</center></b></td>
                                                            <td><center><b><a class='btn btn-primary' href='../user/detail_message/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></b></center></td>
                                                        </tr>";
                                        }
                                    }
                                $content.='</table>';
                                echo $content;
                                    if($pesan->paged->has_previous): 
                                            ?>
                                    <li class="previous"><a href="<?= site_url('user/view_message/'.$pesan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                                  
                                    <?php elseif($pesan->paged->has_next): ?>
                                    <li class="next"><a href="<?= site_url('user/view_message/'.$pesan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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