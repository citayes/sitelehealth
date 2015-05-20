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
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Medical Record</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="cform" id="contact-form">
				<form  method="post" action="../simpan_medical_record_ortho/<?php echo $n;?>">
				  <div class="form-group">
					<label for="tanggal">Date</label>
						<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
		                    <input class="form-control" type="text" name="tanggal" placeholder='Date'>
		     				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
				  </div>
				  <div class="form-group">
					<label for="jam">Hour</label>
					<div class='input-group date' id='datetimepicker3'>
		                <input type="text" class="form-control" name="jam" placeholder="Hour" required>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-time"></span>
		                </span>
		            </div>
				  </div>
				  <div class="form-group">
					<label for="deskripsi"><center>Description</center></label>
					<textarea name="deskripsi" class="form-control" rows="8" placeholder="Description" required></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary pull-left">Create</button>
				</form>
			</div>
		</div>
	</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>

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
<script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
</script>