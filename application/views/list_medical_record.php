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
								<h2 class="section-heading animated" data-animation="bounceInUp"><center>List of Medical Record</center></h2><hr>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
                        <?php if(isset($content)) echo $content;?>
                        <nav>
                          <ul class="pager">
                            <?php if($medical_record->paged->has_previous): ?>
                            <li class="previous"><a href="<?= site_url('drg/list_medical_record/'.$medical_record->paged->previous_page) ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                            
                            <?php elseif($medical_record->paged->has_next): ?>
                            <li class="next"><a href="<?= site_url('drg/list_medical_record/'.$medical_record->paged->next_page) ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                            <?php endif; ?>
                          </ul>
                        </nav>
					</div>
					<div class="col-md-1">
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>



<div class="container">
	
</div>