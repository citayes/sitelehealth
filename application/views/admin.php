<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['admin'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
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
                    <h1>Home</h1>
                    <div id="googleMap" style="width:100%;height:400px;">
                        <button class="btn btn-info"onclick="getLocation()">Show Map</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper calvin thurovin -->
    
<script>
var x = document.getElementById("googleMap");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    var myCenter=new google.maps.LatLng(lat, lon);    
    var mapProp = {
        center:myCenter,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker=new google.maps.Marker({
            position:myCenter,
        });
        marker.setMap(map);
}
</script>