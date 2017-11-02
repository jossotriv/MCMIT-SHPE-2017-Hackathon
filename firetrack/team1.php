<!DOCTYPE html>
<html>
<title>Team 1 Vitals</title>
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
  <h1><center>Team 1</center></h1>
  <div class="w3-row">
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green"><a href="#" style="text-decoration:none;"><h3><center>Andrew J.</center></h3>
      <ul><h6>Pulse: 130</h6></ul>
      <ul><h6>Temp: 101* f</h6></ul>
      <ul><h6>Accel: .45</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green"><a href="#" style="text-decoration:none;"><h3><center>Jennifer K.</center></h3>
      <ul><h6>Pulse: 110</h6></ul>
      <ul><h6>Temp: 102* f</h6></ul>
      <ul><h6>Accel: .8</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-red"><a href="#" style="text-decoration:none;"><h3><center>Riley. W</center></h3>
      <ul><h6>Pulse: 170</h6></ul>
      <ul><h6>Temp: 111* f</h6></ul>
      <ul><h6>Accel: 0</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green"><a href="#" style="text-decoration:none;"><h3><center>Luke T.</center></h3>
      <ul><h6>Pulse: 98</h6></ul>
      <ul><h6>Temp: 98* f</h6></ul>
      <ul><h6>Accel: .68</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-red"><a href="#" style="text-decoration:none;"><h3><center>Mandy. J</center></h3>
      <ul><h6>Pulse: 12</h6></ul>
      <ul><h6>Temp: 130* f</h6></ul>
      <ul><h6>Accel: 0</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green"><a href="#" style="text-decoration:none;"><h3><center>Gucci M.</center></h3>
      <ul><h6>Pulse: 116</h6></ul>
      <ul><h6>Temp: 97* f</h6></ul>
      <ul><h6>Accel: .98</h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
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
        <h3><b>Manage your teams vitals</b></h3>
        <h6>Click their box to see their stats for this mission.     
    
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
