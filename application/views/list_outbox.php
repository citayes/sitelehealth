<script>
    function message(){
        document.getElementById('judul').innerHTML="Messages Sent";
    }
    function reference(){
        document.getElementById('judul').innerHTML="Reference and Diagnosis"
    }
</script>
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
                    <center><h1>Outbox</h1></center>    
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#panel-346120" data-toggle="tab" onclick="reference()">Reference and Diagnosis</a>
                        </li>
                        <li>
                            <a href="#panel-486345" data-toggle="tab" onclick="message()">Messages</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-346120">
                            <!-- /#sidebar-wrapper -->
                            <!-- Page Content -->
                            <div id="page-content-wrapper">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                       $content.='<table class="table">
                                                                    <tr>
                                                                    <td><center><b>Time</center></b></td>
                                                                    <td><center><b>To</center></b></td>
                                                                    <td><center><b>Information</center></b></td>
                                                                    <td><center><b>Operation</center></b></td>
                                                                </tr>';
                                                         foreach($mengirim as $row){
                                                                if($row->umum_id!=null && $row->admin_id!=null && $row->flag_outbox!=1){
                                                                    $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->umum_id)->get();
                                                                    $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                    <td><center>".$nama_penerima->nama."</center></td>
                                                                                    <td><center>Reference and Diagnosis</center></td>
                                                                                    <td><center><a class='btn btn-primary' href='../view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                                }
                                                                else if($row->orto_id!=null && $row->admin_id!=null && $row->flag_outbox!=1){
                                                                    echo 'lala';
                                                                    $nama_penerima1 = new pengguna();
                                                                    $nama_penerima1->where('id', $row->orto_id)->get();
                                                                    $content .=
                                                                    "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                    <td><center>".$nama_penerima1->nama."</center></td>
                                                                                    <td><center>Reference and Diagnosis</center></td>
                                                                                    <td><center><a class='btn btn-primary' href='../view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                                }
                                                                else if($row->umum_id!=null && $row->admin_id!=null && $row->flag_outbox==1){
                                                                    $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->umum_id)->get();
                                                                    $content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                    <td><center><b>".$nama_penerima->nama."</b></center></td>
                                                                                    <td><center><b>Reference and Diagnosis</b></center></td>
                                                                                    <td><center><b><a class='btn btn-primary' href='../view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";                   
                                                                }
                                                                else if($row->orto_id!=null && $row->admin_id!=null && $row->flag_outbox==1){
                                                                    echo 'lala';
                                                                    $nama_penerima1 = new pengguna();
                                                                    $nama_penerima1->where('id', $row->orto_id)->get();
                                                                    $content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                    <td><b><center>".$nama_penerima1->nama."</center></b></td>
                                                                                    <td><<b>center>Reference and Diagnosis</center></b></td>
                                                                                    <td><center><b><a class='btn btn-primary' href='../view_reference_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";
                                                                }
                                                            
                                                        }
                                                        $content .= "</table>";
                                                        echo $content;
                                                        //var_dump($mengirim->paged->has_next);
                                                    if($mengirim->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('admin/list_outbox/'.$mengirim->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    <?php elseif($mengirim->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('admin/list_outbox/'.$mengirim->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    

                        <div class="tab-pane" id="panel-486345">
                            <!-- /#sidebar-wrapper -->
                            <!-- Page Content -->
                            <div id="page-content-wrapper">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <nav>
                                                  <ul class="pager">
                                                    <?php
                                                       $content1.='<table class="table">
                                                            <tr>
                                                            <td><center><b>Time</center></b></td>
                                                            <td><center><b>To</center></b></td>
                                                            <td><center><b>Information</center></b></td>
                                                            <td><center><b>Operation</center></b></td>
                                                        </tr>';
                                                        foreach ($pesan as $row) {
                                                            if($row->pengguna_id==$pengguna_id && $row->flag_outbox!=1){
                                                                $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->penerima_id)->get();
                                                                    $content1 .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                    <td><center>".$nama_penerima->nama."</center></td>
                                                                                    <td><center>Message</center></td>
                                                                                    <td><center><a class='btn btn-primary' href='../outbox_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            if($row->pengguna_id==$pengguna_id && $row->flag_outbox==1){
                                                                $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->penerima_id)->get();
                                                                    $content1 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                    <td><b><center>".$nama_penerima->nama."</center></b></td>
                                                                                    <td><b><center>Message</center></b></td>
                                                              <td><center><b><a class='btn btn-primary' href='../outbox_message_admin/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></b></center></td></tr>";
                                                            }
                                                        }
                                                        $content1 .= "</table>";
                                                        echo $content1;
                                                    if($pesan->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('admin/list_outbox/'.$pesan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($pesan->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('admin/list_outbox/'.$pesan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                                                    <?php endif; ?>
                                                  </ul>
                                                </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                              
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->
