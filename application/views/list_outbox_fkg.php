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
                            <a href="#panel-346120" data-toggle="tab">References</a>
                        </li>
                        <li>
                            <a href="#panel-486345" data-toggle="tab">Messages</a>
                        </li>
                        <li>
                            <a href="#panel-111111" data-toggle="tab">Diagnosis Sent to Admin</a>
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
                                        <div class="row mar-bot40">
                                            <div class="col-md-offset-3 col-md-6">
                                                <div class="section-header">
                                                    <center><h2 class="section-heading animated" data-animation="bounceInUp">References Sent</h2></center><hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                 <nav>
                                                  <ul class="pager">
                                                    <?php
                                                        $content.='<table class="table">
                                                                        <tr>
                                                                        <td><center><b>Time</center></b></td>
                                                                        <td><center><b>Recipient Name</center></b></td>
                                                                        <td><center><b>Information</center></b></td>
                                                                        <td><center><b>Operation</center></b></td>
                                                                    </tr>';//halo
                                                       foreach($mengirim as $row){
            //foreach ($pesan as $row1) {
                                                            if($row->admin_id==null && $row->pusat_id==$pusat_id && $row->umum_id!=null && $row->flag_outbox!=1){
                                                                $nama_penerima = new pengguna();

                                                                $nama_penerima->where('id', $row->umum_id)->get();
                                                                $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                <td><center>".$nama_penerima->nama."</center></td>
                                                                                <td><center>Reference and Diagnosis</center></td>
                                                                                <td><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->admin_id==null && $row->pusat_id==$pusat_id && $row->orto_id!=null && $row->flag_outbox!=1){
                                                                //echo 'lala';
                                                                $nama_penerima1 = new pengguna();
                                                                $nama_penerima1->where('id', $row->orto_id)->get();
                                                                $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                <td><center>".$nama_penerima1->nama."</center></td>
                                                                                <td><center>Reference and Diagnosis</center></td>
                                                                                <td><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->admin_id==null && $row->pusat_id==$pusat_id && $row->umum_id!=null && $row->flag_outbox==1){
                                                                $nama_penerima = new pengguna();

                                                                $nama_penerima->where('id', $row->umum_id)->get();
                                                                $content .= "<tr><td><b><center>".$row->waktu."</center></a></b></td>
                                                                                <td><b><center>".$nama_penerima->nama."</center></b></td>
                                                                                <td><b><center>Reference and Diagnosis</center></b></td>
                                                                                <td><b><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                            }
                                                            else if($row->admin_id==null && $row->pusat_id==$pusat_id && $row->orto_id!=null  && $row->flag_outbox==1){
                                                                //echo 'lala';
                                                                $nama_penerima1 = new pengguna();
                                                                $nama_penerima1->where('id', $row->orto_id)->get();
                                                                $content .= "<tr><td><b><center>".$row->waktu."</center></a></b></td>
                                                                                <td><b><center>".$nama_penerima1->nama."</center></b></td>
                                                                                <td><b><center>Reference and Diagnosis</center></b></td>
                                                                                <td><b><center><a class='btn btn-primary' href='../pusat/view_reference_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                            }

                                                        //}
                                                    }
                                                        $content .= "</table>";
                                                        echo $content;
                                                    if($mengirim->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('pusat/list_outbox_fkg/'.$mengirim->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($mengirim->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('pusat/list_outbox_fkg/'.$mengirim->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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

                <div class="tab-pane" id="panel-486345">
                    <!-- /#sidebar-wrapper -->
                    <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row mar-bot40">
                                        <div class="col-md-offset-3 col-md-6">
                                            <div class="section-header">
                                                <center><h2 class="section-heading animated" data-animation="bounceInUp">Messages Sent</h2></center><hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <nav>
                                                  <ul class="pager">
                                                    <?php
                                                       $content1.='<table class="table">
                                                            <tr>
                                                            <td><center><b>Time</center></b></td>
                                                            <td><center><b>Recipient Name</center></b></td>
                                                            <td><center><b>Information</center></b></td>
                                                            <td><center><b>Operation</center></b></td>
                                                        </tr>';
                                                       foreach ($pesan->order_by('id', 'desc')->get() as $row) {
                                                            if($row->pengguna_id==$pengguna_id && $row->flag_outbox!=1){
                                                                $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->penerima_id)->get();
                                                                    $content1 .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                    <td><center>".$nama_penerima->nama."</center></td>
                                                                                    <td><center>Message</center></td>
                                                                                    <td><center><a class='btn btn-primary' href='../pusat/outbox_message_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->pengguna_id==$pengguna_id && $row->flag_outbox==1){
                                                                $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->penerima_id)->get();
                                                                    $content1 .= "<tr><td><b><center>".$row->waktu."</center><b></a></td>
                                                                                    <td><b><center>".$nama_penerima->nama."</center><b></td>
                                                                                    <td><b><center>Message</center><b></td>
                                                                                    <td><b><center><a class='btn btn-primary' href='../pusat/outbox_message_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                            }
                                                        }
                                                        $content1 .= "</table>";
                                                        echo $content1;
                                                    if($pesan->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('pusat/list_outbox_fkg/'.$pesan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($pesan->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('pusat/list_outbox_fkg/'.$pesan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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
                 <div class="tab-pane" id="panel-111111">
                    <!-- /#sidebar-wrapper -->
                    <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row mar-bot40">
                                        <div class="col-md-offset-3 col-md-6">
                                            <div class="section-header">
                                                <center><h2 class="section-heading animated" data-animation="bounceInUp">Diagnosis Sent to Admin</h2></center><hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <nav>
                                                  <ul class="pager">
                                                    <?php
                                                       $content2.='<table class="table">
                                                            <tr>
                                                            <td><center><b>Time</center></b></td>
                                                            <td><center><b>Recipient Name</center></b></td>
                                                            <td><center><b>Information</center></b></td>
                                                            <td><center><b>Operation</center></b></td>
                                                        </tr>';
                                                       foreach($analisi as $row){
            //foreach ($pesan as $row1) {
                                                                if($row->flag_mengirim==1 && $row->orto_id==$orto_id && $row->flag_outbox!=1){
                                                                    $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', '123142')->get();
                                                                    $content2 .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                    <td><center>".$nama_penerima->nama."</center></td>
                                                                                    <td><center>Diagnosis send To Admin</center></td>
                                                                                    <td><center><a class='btn btn-primary' href='../pusat/view_diagnosis_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->flag_mengirim==1 && $row->orto_id==$orto_id && $row->flag_outbox==1){
                                                                    $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', '123142')->get();
                                                                    $content2 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                    <td><b><center>".$nama_penerima->nama."</center></b></td>
                                                                                    <td><b><center>Diagnosis To Admin</center></b></td>
                                                                                    <td><b><center><a class='btn btn-primary' href='../pusat/view_diagnosis_fkg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                            }
                                                        }
                                                        $content2 .= "</table>";
                                                        echo $content2;
                                                    if($analisi->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('pusat/list_outbox_fkg/'.$analisi->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($analisi->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('pusat/list_outbox_fkg/'.$analisi->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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


<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
$('.form_date').datetimepicker({
    language:  'id',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
</script>