<!DOCTYPE html>
<html>
<title>FireTrack Home: Let's kick some ASH</title>
<?php
include 'css/style.php';
?>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<?php
include 'css/navbars.php';
?>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding">LOGO</span>
  <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-black" style="margin-left:300px">

  <!-- Push down content on small screens --> 
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Photo grid -->
  <h1><center class="w3-white w3-text-red">Teams on the ground</center></h1>
  <div class="w3-row">
    <div class="w3-third w3-padding">
      <a href="team1.php" ><h3><center>Team 1</center></h3><img src="pictures/truck.jpg" style="width:100%" alt="Team 1"></a>
    </div>
    <div class="w3-third w3-padding">
      <a href="#" ><h3><center>Team 2</center></h3><img src="pictures/truck.jpg" style="width:100%" alt="Team 2"></a>
    </div>
    <div class="w3-third w3-padding">
      <a href="#" ><h3><center>Team 3</center></h3><img src="pictures/truck.jpg" style="width:100%" alt="Team 3"></a>
    </div>
  </div>




  
  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>

  <!-- About section -->


  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-grey">  
    <div class="w3-row-padding">
        <h3>About Us</h3>
        <h6>FireTrack™ is an app that helps monitor your Firefighting team's vitals and positions, potentially saving their lives.<br><br>

        With the additional use of the FireTrack ear piece, you can directly comunicate with them and give them instructions on things they may not see.     
    
     </h6>
    </div>
  </footer>
  </div>

  
  
</div>


<!-- End page content -->
<?php
include 'css/script.php';
?>

</body>
</html>