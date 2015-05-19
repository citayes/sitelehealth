<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <!-- Sidebar content-->
        <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['drg'])->get();
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
                    <center><h1>Outbox</h1></center>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10">
                      <ul class="nav nav-tabs">
                         <li class="active">
                            <a href="#panel-346120" data-toggle="tab">Patient Sent</a>
                        </li>
                        <li>
                            <a href="#panel-486345" data-toggle="tab">Messages</a>
                        </li>
                        <li>
                            <a href="#panel-111111" data-toggle="tab">References</a>
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
                                                    <center><h2 class="section-heading animated" data-animation="bounceInUp">Send Patient to FKG</h2></center><hr>
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
                                                            <td><center><b>Recipient ID</center></b></td>
                                                            <td><center><b>Recipient Name</center></b></td>
                                                            <td><center><b>Information</center></b></td>
                                                            <td><center><b>Operation</center></b></td>
                                                        </tr>';
                                                        foreach($merawat as $row){


                                                        //foreach ($pesan as $row1) {
                                                            if($row->flag_outbox!=1 && $row->umum_id==$umum_id){
                                                                // $nama_penerima = new pengguna();
                                                                // $nama_penerima->where('id', $row->pusat_id)->get();
                                                                $content .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                <td><center>FKG UI</center></td>
                                                                                <td><center>Send Patient to FKG UI</center></td>
                                                                                <td><center><a class='btn btn-primary' href='../drg/view_merawat_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->flag_outbox==1 && $row->umum_id==$umum_id){
                                                                // $nama_penerima = new pengguna();
                                                                // $nama_penerima->where('id', $row->pusat_id)->get();
                                                                $content .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                <td><b><center>FKG UI</center></b></td>
                                                                                <td><b><center>Send Patient to FKG UI</center></b></td>
                                                                                <td><b><center><a class='btn btn-primary' href='../drg/view_merawat_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                            }
                                                    }
                                                        $content .= "</table>";
                                                        echo $content;
                                                    if($merawat->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('drg/list_outbox_drg/'.$merawat->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($merawat->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('drg/list_outbox_drg/'.$merawat->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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
                                                <center><h2 class="section-heading animated" data-animation="bounceInUp">Messages</h2></center><hr>
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
                                                            <td><center><b>Recipient ID</center></b></td>
                                                            <td><center><b>Recipient Name</center></b></td>
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
                                                                                    <td><center><a class='btn btn-primary' href='../drg/outbox_message_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                            }
                                                            else if($row->pengguna_id==$pengguna_id && $row->flag_outbox==1){
                                                                $nama_penerima = new pengguna();
                                                                    $nama_penerima->where('id', $row->penerima_id)->get();
                                                                    $content1 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                    <td><b><center>".$nama_penerima->nama."</center></b></td>
                                                                                    <td><b><center>Message</center></b></td>
                                                                                    <td><center><b><a class='btn btn-primary' href='../drg/outbox_message_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a><b></center></td></tr>";
                                                            }
                                                        }
                                                            $content1 .= "</table>";
                                                            echo $content1;

                                                    if($pesan->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('drg/list_outbox_drg/'.$pesan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($pesan->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('drg/list_outbox_drg/'.$pesan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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
                                                <center><h2 class="section-heading animated" data-animation="bounceInUp">Send Patient to Referral</h2></center><hr>
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
                                                            <td><center><b>Recipient ID</center></b></td>
                                                            <td><center><b>Recipient Name</center></b></td>
                                                            <td><center><b>Information</center></b></td>
                                                            <td><center><b>Operation</center></b></td>
                                                        </tr>';
                                                     
                                                    

                                                    foreach($rujukan as $row){
                                                        //foreach ($pesan as $row1) {
                                                            if($row->pengirim_id==$pengirim_id && $row->flag_outbox!=1){
                                                                $nama_penerima = new pengguna();
                                                                $nama_penerima->where('id', $row->orto_id )->get();
                                                                $content2 .= "<tr><td><center>".$row->waktu."</center></a></td>
                                                                                <td><center>".$nama_penerima->nama."</center></td>
                                                                                <td><center>Send Reference</center></td>
                                                                                <td><center><a class='btn btn-primary' href='../drg/view_rujukan_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></td></tr>";
                                                        }
                                                        if($row->pengirim_id==$pengirim_id && $row->flag_outbox==1){
                                                                $nama_penerima = new pengguna();
                                                                $nama_penerima->where('id', $row->orto_id )->get();
                                                                $content2 .= "<tr><td><b><center>".$row->waktu."</center></b></a></td>
                                                                                <td><b><center>".$nama_penerima->nama."</center></b></td>
                                                                                <td><b><center>Send Reference</center></b></td>
                                                                                <td><b><center><a class='btn btn-primary' href='../drg/view_rujukan_drg/".$row->id."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> Detail</a></center></b></td></tr>";
                                                        }
                                                    }
                                                    $content2.='</table>';
                                                    echo $content2;

                                                    if($rujukan->paged->has_previous): ?>
                                                    <li class="previous"><a href="<?= site_url('drg/list_outbox_drg/'.$rujukan->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                                                    
                                                    <?php elseif($rujukan->paged->has_next): ?>
                                                    <li class="next"><a href="<?= site_url('drg/list_outbox_drg/'.$rujukan->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
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