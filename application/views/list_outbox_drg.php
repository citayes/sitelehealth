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
                                                    <center><h2 class="section-heading animated" data-animation="bounceInUp">Outbox</h2></center><hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                echo $content;

                                                ?>
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
                                                <center><h2 class="section-heading animated" data-animation="bounceInUp"></h2></center><hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            echo $content1;

                                            ?>
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
                                            <?php
                                            echo $content2;

                                            ?>
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