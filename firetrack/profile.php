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
        <div style="">
  <h1>Update information</h1>
  <form id = "register" action="" method="post" >
    <ul>
    <li>
      Current Address:<br>
      <input type="password" name="currpassword"></li>
      </li>
      <li>Number of Bedrooms:<br>
      <input type="password" name="password" id = "password" ></li>
      <span id="result"></span>
      <li>Number of Restrooms:<br>
      <input type="password" name="password" id = "password" ></li>
      <span id="result"></span>
      <li>Number of Tenants:<br>
      <input type="password" name="password" id = "password" ></li>
      <span id="result"></span>
      <li>Type of building:<br>
      <form action="/action_page.php">
      <select name="cars">
        <option value="volvo">Residential</option>
        <option value="saab">Apartment</option>
        <option value="fiat">Business</option>
        <option value="audi">Other</option>
      </select>
      <br><br>
      <input type="submit">
      </form>
      <a href='user.php'><input type="button" name="cancel" value= "Cancel"></a>
      
      
      
    </ul>
  </form></div>   
    
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