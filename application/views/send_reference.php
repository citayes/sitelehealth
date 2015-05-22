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
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Send Diagnose</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="cform" id="contact-form">
				<form  method="post" action="../save_reference/<?php echo $n;?>">
                    <div class="form-group">
                    <label for="nama">Please choose your first referral doctor</label><br>
                    <select id="nama" name="nama1" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($content); ?>
                    </select>
                  </div>

                    <div class="form-group">
                    <label for="nama">Please choose your second referral doctor</label><br>
                    <select id="nama" name="nama2" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($content); ?>
                    </select>
                  </div>

                    <div class="form-group">
                    <label for="nama">Please choose your third referral doctor</label><br>
                    <select id="nama" name="nama3" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($content); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama">Please choose your fourth referral doctor</label><br>
                    <select id="nama" name="nama4" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($content); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama">Please choose your fifth referral doctor</label><br>
                    <select id="nama" name="nama5" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                        <option value="">--Choose One--</option>
                        <?php echo($content); ?>
                    </select>
                  </div>

                
				  <button type="submit" class="btn btn-primary">Send Reference</button>
				</form></center>
			</div>
		</div>
	</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>