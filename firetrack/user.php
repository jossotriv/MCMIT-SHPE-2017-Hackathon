<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
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
  <div class="w3-row">
    <div class="w3-third">
      <a href="profile.php" ><img src="pictures/edit.jpg" style="width:100%" alt="A boy surrounded by beautiful nature"></a>
    </div>
    <div class="w3-third">
      <a href="emergency.php" ><img src="pictures/emergency.jpg" style="width:100%" onclick="onClick(this)" alt="What a beautiful scenery this sunset"></a>
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
        <h3>User</h3>
        <h6>In the event of a FIRE, please press the EMERGENCY button to report a fire. <br><br>
          <div class="w3-box w3-black w3-padding">
          <h2>Your location</h2>
          <h3>Address</h3>
          <h5>301 W 13th St #100, Kansas City, MO 64105</h5>
          <h3>Bedrooms</h3>
          <h5>0</h5>
          <h3>Bathrooms</h3>
          <h5>35</h5>
          <h3>Tennants</h3>
          <h5>6,600</h5>
          <h3>Type of Building</h3>
          <h5>Business</h5></div>
        To update your house address, floor plan, number of rooms, amount of tennants and type of building, please press <a href="profile.php">EDIT PROFILE</a>.    
    
     </h6>
    </div>
  </footer>
  </div>

  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>
</div>


<!-- End page content -->
<?php
include 'css/script.php';
?>

</body>
</html>
