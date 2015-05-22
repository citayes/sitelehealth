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
									<h2 class="section-heading animated" data-animation="bounceInUp"><center>Send Reference</center></h2><hr>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="cform" id="contact-form">
									<form  method="post" action="../send_rujukan_lagi/<?php echo $n;?>">
									
									<div class="form-group">
                    <label for="nama">Please choose your first referral doctor</label><br>
                    <select id="nama" name="nama1" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($option); ?>
                    </select>
                  </div>

                    <div class="form-group">
                    <label for="nama">Please choose your second referral doctor</label><br>
                    <select id="nama" name="nama2" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($option); ?>
                    </select>
                  </div>

                    <div class="form-group">
                    <label for="nama">Please choose your third referral doctor</label><br>
                    <select id="nama" name="nama3" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($option); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama">Please choose your fourth referral doctor</label><br>
                    <select id="nama" name="nama4" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($option); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama">Please choose your fifth referral doctor</label><br>
                    <select id="nama" name="nama5" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($option); ?>
                    </select>
                  </div>
									<div class="form-group">
									  <center><button type="submit" class="btn btn-primary pull-left">Send Diagnose</button></center>
									</div>
									</form>
								</div>
							</div>
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