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
				<center><h2 class="section-heading animated" data-animation="bounceInUp">Daily Schedule</h2></center><hr>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<?php
		echo $content;

		?>
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