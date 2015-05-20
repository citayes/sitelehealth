<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['orthodonti'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
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
                <center><h2 class="section-heading animated" data-animation="bounceInUp">Send Message</h2></center><hr>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form  method="post" action="../save_reply_message/<?php echo $n;?>">
                  <div class="form-group">
                    <label for="name">Subject</label>
                    <input type="input" name="subject" class="form-control" id="subject" placeholder="Subject of The Message"/>
                  </div>
                  <div class="form-group">
                    <label for="message">Message</label>
                     <textarea name="isi" class="form-control" rows="10" id="isi" placeholder="Your Message"required></textarea>
                    </div>
                   <button type="submit" class="btn btn-primary">Send</button>
                   <button type="cancel" onclick="javascript:window.location='../homepage';" class="btn btn-warning">Cancel</button>
                </form>
    </div>
    <div class="col-md-2"></div>

    </div>
    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->


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