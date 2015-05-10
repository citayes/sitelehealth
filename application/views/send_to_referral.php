<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['drg'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
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
								<h2 class="section-heading animated" data-animation="bounceInUp"><center>Send to Referral</center></h2><hr>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
                        <div class="cform" id="contact-form">
                            <form  method="post" action="../send_to_referral/<?php echo $n;?>">
                              <div class="form-group">
                                <label for="to">To</label>
                                <select id="nama" name="nama" class="btn btn-default dropdown-toggle" data-toggle="dropdown" required>
                                    <option value="">--Pilih Salah Satu--</option>
                                    <?php echo($option); ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" rows="8" placeholder="Masukkan Deskripsi Medical Record" required></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary pull-left">Create</button>
                            </form>
                        </div>

                    </div>
					<div class="col-md-1">
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>