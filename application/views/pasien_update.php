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
				<br><br><h2 class="section-heading animated" data-animation="bounceInUp"><center>Update Patient</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<tr>
				<td>Name</td>
			</tr>
				<?php $Pasien = new Pasien();
				$Pasien->get();//$Pasien->where('FVerifikasi','n')->get();
				$content ="";
				foreach($Pasien as $row){
					$content .= "<tr><td><a href='../drg/pasien_update2/$row->id'>".$row->nama."</td></tr>";
				} echo $content;
				?>
		</table>
	</div>    
                    
                </div>
            </div>
        </div>
    </div>

