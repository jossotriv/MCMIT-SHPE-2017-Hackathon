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
  <div class="w3-block">
    
  </div>




  
  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>

<!-- Photo grid -->
<!--   <div class="w3-row">
    <div class="w3-third">
      <a ><img src="pictures/thermal.jpg" style="width:40%" ></a>
    </div>
    <div class="w3-third">
      <a ><img src="pictures/regular.jpg" style="width:40%" ></a>
    </div>
    </div>
  </div> -->

  <!-- About section -->
<div class="w3-row w3-padding w3-grey">
  <h2>LOCATION</h2>
  <h3>Kansas City Convention Center<br>301 W 13th St #100, Kansas City, MO 64105<br>Room 1501 B</h3>
  
  <div class="w3-third"><h2>Thermal View</h2>
      <img src="pictures/thermal.jpg" style="width:100%">
    </div>
    <div class="w3-third"><h2>Regular View</h2>
      <img src="pictures/normal.jpg" style="width:100%">
    </div><br></div>
       <!-- <img src="pictures/thermal.jpg" style="width:30%" alt="A boy surrounded by beautiful nature">
       <hr>
  
     <img src="pictures/normal.jpg" style="width:30%" alt="A boy surrounded by beautiful nature">
     <hr> -->
  <h2>Shortest Path to victims</h2>
     <img src="pictures/legend.jpg" style="width:90%" alt="A boy surrounded by beautiful nature">
     <hr>
     <h5>Room Temperature: <b>160* f</b> <t><h5>Combust Value: <h5 style="color: red">High</h5></h5>
      <div class="w3-padding w3-black"><h3> Fire Team</h3>
          <h5 style="color: green">A:......... Heart Beat: 110<br>A:......... Body Temp: 101.2* f</h5>
          <h5 style="color: green">B:......... Heart Beat: 90<br>B:......... Body Temp: 105.2* f</h5>
          <h5 style="color: red">C:......... Heart Beat: 150<br>C:......... Body Temp: 99* f</h5></div>




  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-grey">  
        <h6>Maintain the area under control and get people out as soon as possible.</h6>
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