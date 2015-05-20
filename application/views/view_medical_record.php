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
    <div class='col-md-2'>
    </div>
    <div class="col-md-8">
        <table class="table">
            <?php if(isset($content)) echo $content;?>
        </table>
    </div>
    <div class='col-md-2'>
    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>

