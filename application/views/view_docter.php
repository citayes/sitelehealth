<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
echo $profile_construct;
    ?>
    </div>
    <div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Data Dokter Gigi</center></h2><hr>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="cform" id="contact-form">
				<table class="table table-hover">
				<?php if(isset($content)) echo $content; ?>			
				</table>
			</div>
		</div>
	</div>
</div>