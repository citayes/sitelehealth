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
                    <div class="row mar-bot40">
		<div class="col-md-offset-3 col-md-6">
			<div class="section-header">
				<h2 class="section-heading animated" data-animation="bounceInUp"><center>Diagnose From FKG UI Lists</center></h2><hr>
			</div>
		</div>
	</div>
	<div class="row">
		<?php echo $content;?>
        <nav>
  <ul class="pager">
    <?php if($mengirim->paged->has_previous): ?>
    <li class="previous"><a href="<?= site_url('drg/list_reference_drg/'.$mengirim->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
    
    <?php elseif($mengirim->paged->has_next): ?>
    <li class="next"><a href="<?= site_url('drg/list_reference_drg/'.$mengirim->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
    <?php endif; ?>
  </ul>
</nav>

	</div>
    
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>