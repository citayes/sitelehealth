
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
echo $profile_construct;
    ?>
    </div>
    <!-- /#sidebar-wrapper chiiesa serena-->
    <!-- Page Content -->
     <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="cform" id="contact-form">
				<div class="panel panel-default">
					    <div class="panel-heading">
					        <h4 class="section-heading animated" data-animation="bounceInUp"><span class="glyphicon glyphicon-user"></span>Register Patient</h4></div>
					        <div class="panel-body">
					            <form class="form-horizontal" role="form" method="post" action="pasien">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="username">Name</label>
										<div class="col-sm-9">
										<input type="input" name="Name" class="form-control" id="Name" placeholder="Patient's Name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="username">Place Of Birth</label>
										<div class="col-sm-9">
										<input type="input" name="PlaceofBirth" class="form-control" id="PlaceofBirth" placeholder="Patient's Place of Birth"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="tanggal_lahir">Date Of Birth</label>
										<div class="col-sm-9">
											<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                    <input class="form-control" name="DateofBirth" class="form-control" id="DateofBirth" placeholder="Patient's Date of Birth (YYYY-MM-DD)"/>
							     				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							                </div>
							    			<input type="hidden" id="dtp_input2" value=""/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="warga_negara">Age</label>

										<div class="col-sm-9">
											<input type="text" name="Age" class="form-control" id="Age" placeholder="Patient's Age"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="warga_negara">Address</label>
										<div class="col-sm-9">
											<input type="text" name="Address" class="form-control" id="Address" placeholder="Patient's Address"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="warga_negara">Height</label>
										<div class="col-sm-9">
											<input type="text" type="input" name="Height" class="form-control" id="Height" placeholder="Patient's Height"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="warga_negara">Weight</label>
										<div class="col-sm-9">
											<input type="text" name="Weight" class="form-control" id="Weight" placeholder="Patient's Weight"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="jenis_kelamin">Gender</label>
										<div class="col-sm-9">
											<input type='radio' name='Gender' value='Male'>Male</input>
											<input type='radio' name='Gender' value='Female'>Female</input>											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="agama">Nationality</label>
										<div class="col-sm-9">
											<input type="text" name="Nationality" class="form-control" id="Nationality" placeholder="Patient's Nationality"/>
										</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label" for="pendidikan">Religion</label>
										<div class="col-sm-9">
											<input type="text" name="Religion" class="form-control" id="Religion" placeholder="Patient's Religion"/>
										</div>
									</div>
									<div class="form-group last">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary btn-sm">Create</button>
										</div>
									</div>
								</form>
							</div>
							<div class="panel-footer">
									<br>
							</div>
						</div>
					</div>
				</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

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