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
				<center><h2 class="section-heading animated" data-animation="bounceInUp">Create Diagnose</h2></center><hr>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form  method="post" action="../save_diagnose/<?php echo $n;?>">
				  <div class="form-group">
					<label for="name">Par Index's Score</label>
					<input type="input" name="Skor" class="form-control" id="Skor" placeholder="Patient's Par Index Score"/>
				  </div>
				  <div class="form-group">
					<label for="placeofbirth">Malocclusion</label>
					<input type="input" name="Maloklusi" class="form-control" id="Maloklusi" placeholder="Patient's Malocclusion"/>
				  </div>
				  <div class="form-group">
					<label for="placeofbirth">Diagnose</label>
					<textarea type="text" name="Diagnose" class="form-control" rows="10" id="Diagnose" placeholder="Your Diagnose" required></textarea>
				  </div>

<!-- 				  <div class="form-group">
					<label for="placeofbirth">Foto</label>
					<input type="input" name="Foto" class="form-control" id="Foto" placeholder="Photo"/>
				  </div> -->
 
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