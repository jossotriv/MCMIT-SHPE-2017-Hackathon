<?php
function deleteFriend($conn, $user, $profile){
	mysqli_query($conn, "DELETE FROM friend_req WHERE (user_from= '$user' AND user_to= '$profile' AND friends= 1) or (user_from= '$profile' AND user_to= '$user' AND friends= 1)");
}
function sendRequest($conn, $user_from, $user_to){
	if(checkRequest($conn, $user_to,$user_from) === true){
		mysqli_query($conn, "UPDATE friend_req SET friends = 1 WHERE user_from = '$user_to' AND user_to= '$user_from'");
	}else{
	mysqli_query($conn, "INSERT INTO friend_req (user_from, user_to) VALUES ('$user_from', '$user_to')");
	}
}
function cancelRequest($conn, $user, $profile){
	mysqli_query($conn, "DELETE FROM friend_req WHERE user_from= '$user' AND user_to= '$profile' AND friends= 0");
}
function checkRequest($conn, $user,$profile){
	$result = mysqli_query($conn, "SELECT * FROM friend_req WHERE user_from= '$user' AND user_to= '$profile' AND friends= 0");
	if(mysqli_num_rows($result) == 1 ){
		return true;
	}else{
		return false;
	}
}
function displayRequests($conn, $user){
	$result = mysqli_query($conn, "SELECT * FROM friend_req WHERE user_to= '$user' AND friends= 0");
 while($myrow = mysqli_fetch_assoc($result)){
	 $from =user_id_from_username($myrow['user_from']);
	 $from_data = user_data($conn, $from, 'username','profile');
		?>
		<div class ="w3-container" style="background-color: #323131; color: white;border-radius: 2px; max-height: 80px; width: 490px; border-color: black; border-style: solid; border-width: 1px;border-radius: 4px;">
    <!-- Picture -->
      <h5><img src=<?php echo $from_data['profile']; ?> style="max-width:50px; max-height:50px;border-radius: 2px;margin-bottom: 1px;" align="center">
      <a style="margin-left: 10px;font-size: 14px;margin-right: 10px;" href = <?php echo $from_data['username']; ?>> <?php echo $from_data['username'] ?> </a>
		 <button style="background-color: #1C1B1B;border-color: #1C1B1B;float: right;"><a style="display: inline;color: red;" href='friendRequests.php?accept=2&&user=<?php echo $from_data['username'];?>'>Ignore</a></button>
		 <button style="background-color: #1C1B1B;border-color: #1C1B1B;float: right;"><a style="display: inline;color: #00e600;" href='friendRequests.php?accept=1&&user=<?php echo $from_data['username'];?>'>Accept</a></button>
		 
      </div>
		<?php
	 }
}
function displayFriends($conn, $user){
	$friend = '';
$result = mysqli_query($conn, "SELECT * FROM friend_req WHERE (user_to= '$user' AND friends= 1) or (user_from = '$user' AND friends= 1) ");
	while($myrow = mysqli_fetch_assoc($result)){
	 if($myrow['user_from'] === $user){
		 $friend = $myrow['user_to'];
	 }
	 if($myrow['user_to'] === $user){
		 $friend = $myrow['user_from'];
	 }
	 $friend_d =user_id_from_username($friend);
	 $friend_data = user_data($conn, $friend_d, 'username','profile');
		?>
		<a href = <?php echo $friend_data['username']; ?>> <?php echo $friend_data['username'] ?></a></br>
		<?php
	 }
}
function ignoreRequest($conn,$user, $rec){
	mysqli_query($conn, "UPDATE friend_req SET friends = 2 WHERE user_from = '$user' AND user_to= '$rec'");
}
function acceptRequest($conn,$user, $rec){
	mysqli_query($conn, "UPDATE friend_req SET friends = 1 WHERE user_from = '$user' AND user_to= '$rec'");
}
function checkFriends($conn,$user, $profile){
	$result = mysqli_query($conn, "SELECT * FROM friend_req WHERE (user_to= '$user' AND user_from = '$profile' AND friends= 1) or (user_from = '$user' AND user_to= '$profile' AND friends= 1) ");
	if(mysqli_num_rows($result) == 1 ){
		return true;
	}else{
		return false;
	}
}
function event_user($events_data){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	array_walk($events_data, 'array_sanitize');
	$fields = implode(',',array_keys($events_data));
	$data = '\'' . implode('\',\'', $events_data) . '\'';
	mysqli_query($conn, "INSERT INTO news ($fields) VALUES ($data)");
	
}
function change_user_image($user_id, $file_temp, $file_extension){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$file_name = 'images/profile/' . substr(md5(time()), 0, 10). '.' . $file_extension;
	move_uploaded_file($file_temp, $file_name);
	mysqli_query($conn, "UPDATE users SET profile = '" . mysqli_real_escape_string($conn, $file_name) ."' WHERE user_id = " . (int)$user_id );
	
}
function change_news_image($title, $content, $file_temp, $file_extension){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$file_name = 'images/news/' . substr(md5(time()), 0, 10). '.' . $file_extension;
	move_uploaded_file($file_temp, $file_name);
	
	mysqli_query($conn, "UPDATE news SET news_pic = '" . mysqli_real_escape_string($conn, $file_name) ."' WHERE Title =  '$title' AND Content = '$content'");
	
}

function update_user($user_id, $update_data){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$update = array();
	array_walk($update_data, 'array_sanitize');
	foreach($update_data as $field=>$data){
		$update[] = $field . ' = \''. $data . '\'';
	}
	mysqli_query($conn, "UPDATE users SET ". implode(', ', $update). "WHERE user_id = $user_id") or die(mysql_error);

}
function activate($email, $email_code){
	//SANITIZE
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$result = mysqli_query($conn,"SELECT COUNT(user_id) FROM users WHERE email = '$email' AND email_code = '$email_code'");
	$row = mysqli_fetch_row($result);
	
	if($row[0] == 1){
		mysqli_query($conn, "UPDATE users SET active = 1 WHERE email = '$email'");
		return true;
	}else{
		return false;
	}
}
function assign_id($id){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$result = mysqli_query($conn,"SELECT COUNT(id) FROM news WHERE id = '$id'");
	$row = mysqli_fetch_row($result);
	
	if($row[0] == 1){
		mysqli_query($conn, "UPDATE news SET link = 'news.php?'.$id. WHERE id = '$id'");
		return true;
	}else{
		return false;
	}
}
function employee($owner){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$username = htmlentities(mysqli_real_escape_string($conn, $owner));
	$sql = "SELECT * FROM owners WHERE owner ='$owner' AND status = 1";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 1 ){
		return true;
	}else{
		return false;
	}
}
function change_password($username, $password){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$password = md5($password);
	
	mysqli_query($conn, "UPDATE users SET password = '$password' WHERE username = '$username'");
}
function register_user($register_data){
	
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	array_walk($register_data, 'array_sanitize');
	mysqli_query($conn, "INSERT INTO owners (owner, cc, headtype, wafer) VALUES ('$register_data[owner]', '$register_data[cc]', '$register_data[headtype]', '$register_data[wafer]')");
	for ($x = 2; $x <= 12; $x++) {
		$string = "wafer".$x;
		if($register_data[$string] != ''){
		mysqli_query($conn, "INSERT INTO owners (owner, cc, headtype, wafer) VALUES ('$register_data[owner]', '$register_data[cc]', '$register_data[headtype]', '$register_data[$string]')");
		}
	} 
	
	/*
	$fields = implode(',',array_keys($register_data));
	$data = '\'' . implode('\',\'', $register_data) . '\'';
	mysqli_query($conn, "INSERT INTO users ($fields) VALUES ($data)");
	*/

}
function user_count(){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$result = mysqli_query($conn,"SELECT COUNT(user_id) FROM users");
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function wafer_exists($conn, $wafer){
	$wafer = htmlentities(mysqli_real_escape_string($conn, $wafer));
	$sql = "SELECT * FROM owners WHERE wafer ='$wafer'";
	$result = mysqli_query($conn, $sql);
	
	
	if(mysqli_num_rows($result) == 1 ){
		return true;
	}else{
		return false;
	}
}


function email_exists($conn, $email){
	$email = htmlentities(mysqli_real_escape_string($conn, $email));
	$sql = "SELECT * FROM users WHERE email ='$email'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 1 ){
		return true;
	}else{
		return false;
	}
}
function user_id_from_username($username){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$result = mysqli_query($conn,"SELECT user_id FROM users WHERE username = '$username'");
    $row = mysqli_fetch_row($result);
    return $row[0];
}
function user_data($conn, $user_id){
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	unset($func_get_args[0]);
	
	$fields = implode(', ',$func_get_args);
	
	
	
	$sql2 = "SELECT $fields FROM users WHERE user_id = '$user_id'";
	$data = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
	
	
	return $data;
}
function events_feed($conn){
	 $result = mysqli_query($conn, "SELECT * FROM news ORDER BY id DESC");
		
        //lets make a loop and get all news from the database
        while($myrow = mysqli_fetch_assoc($result))
             {//begin of loop

        ?>
        	<div class="w3-container" style="padding-top: 6px;padding-bottom: 6px;">
			   <ul style="background-color: black; border-style: solid; text-decoration: none;padding: 1px;padding-left: 10px;padding-right: 15px;border-color: #00e600; border-width: 1px;">
				<h4><a href = "<?php echo $myrow['link_code']?>"><?php echo $myrow['Title']?></a></h4>
				<h6 style="display:inline;font-size:14px;">Posted by <?php echo $myrow['user']?></h6><h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;"><?php if ($myrow['fee'] === 'Free'){ echo $myrow['fee'];}else{echo '$'.$myrow['fee'];}?></h6>

				<?php 
				if(!empty($myrow['city'])){
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;"><?php echo $myrow['city']?>, <?php echo $myrow['state']?></h6>
				<?php 
				}else{
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Online</h6>
				<?php 
				}
				?>
				<h6 class="textOverflow"><?php echo $myrow['Content']?></h6>
				<!-- <img style="padding-left: 1px;max-width: 50px;max-height: 50px;margin-left: 30px;" src="<?php echo $myrow['events_pic']; ?>"> -->
			   </ul>
			   </div>
               
		<?php
				
			 }
}
//only for event display
function events_feed_casual($conn){
	 $result = mysqli_query($conn, "SELECT * FROM news WHERE eventType = 'Casual' ORDER BY id DESC");
		
        //lets make a loop and get all news from the database
        while($myrow = mysqli_fetch_assoc($result))
             {//begin of loop
        ?>
        	<div class="w3-container" style="padding-top: 6px;padding-bottom: 6px;">
			   <ul style="background-color: black; border-style: solid; text-decoration: none;padding: 1px;padding-left: 10px;padding-right: 15px;border-color: #00e600; border-width: 1px;">
				<h4><a href = "<?php echo $myrow['link_code']?>"><?php echo $myrow['Title']?></a></h4>
				<h6 style="display:inline;font-size:14px;">Posted by <?php echo $myrow['user']?></h6><h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Entry fee: <?php if ($myrow['fee'] === 'Free'){ echo $myrow['fee'];}else{echo '$'.$myrow['fee'];}?></h6><h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Game: <?php echo $myrow['game']?></h6>

				<?php 
				if(!empty($myrow['city'])){
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;"><?php echo strtoupper($myrow['city'])?>, <?php echo $myrow['state']?></h6>
				<?php 
				}else{
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Online</h6>
				<?php 
				}
				?>
				<h6 class="textOverflow"><?php echo $myrow['Content']?></h6>
				<!-- <img style="padding-left: 1px;max-width: 50px;max-height: 50px;margin-left: 30px;" src="<?php echo $myrow['events_pic']; ?>"> -->
			   </ul>
			   </div>
               
		<?php
			 }
}
//only for event display
function events_feed_prof($conn){
	 $result = mysqli_query($conn, "SELECT * FROM news WHERE eventType = 'Professional' ORDER BY id DESC");
		
        //lets make a loop and get all news from the database
        while($myrow = mysqli_fetch_assoc($result))
             {//begin of loop

        ?>
        	<div class="w3-container" style="padding-top: 6px;padding-bottom: 6px;">
			   <ul style="background-color: black; border-style: solid; text-decoration: none;padding: 1px;padding-left: 10px;padding-right: 15px;border-color: #00e600; border-width: 1px;">
				<h4><a href = "<?php echo $myrow['link_code']?>"><?php echo $myrow['Title']?></a></h4>
				<h6 style="display:inline;font-size:14px;">Posted by <?php echo $myrow['user']?></h6><h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Entry fee: <?php if ($myrow['fee'] === 'Free'){ echo $myrow['fee'];}else{echo '$'.$myrow['fee'];}?></h6><h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Game: <?php echo $myrow['game']?></h6>

				<?php 
				if(!empty($myrow['city'])){
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;"><?php echo strtoupper($myrow['city'])?>, <?php echo $myrow['state']?></h6>
				<?php 
				}else{
				?>
				<h6 style="font-size:14px;display: inline;margin-left: 14px;color:#00e600;">Online</h6>
				<?php 
				}
				?>
				<h6 class="textOverflow"><?php echo $myrow['Content']?></h6>
				<!-- <img style="padding-left: 1px;max-width: 50px;max-height: 50px;margin-left: 30px;" src="<?php echo $myrow['events_pic']; ?>"> -->
			   </ul>
			   </div>
               
		<?php
				
			 }
}
//Nav bar event feed
 function events_feed_nav($conn){
	$result = mysqli_query($conn, "SELECT *, ( 3959 * acos( cos( radians(37.37) ) * cos( radians( latitude ) ) * 
	 cos( radians( longitude ) - radians(-121.85) ) + sin( radians(37.37) ) * 
	 sin( radians( latitude ) ) ) ) AS distance FROM news HAVING
	 distance < 25 ORDER BY distance LIMIT 0 , 20;");
		
        //lets make a loop and get all news from the database
        while($myrow = mysqli_fetch_assoc($result))
             {//begin of loop

        ?>
        	<div class="w3-container" style="width: 100%; padding: 5px;">
			   <div style="background-color: black; border-style: solid; padding: 1px;border-color: #00e600; border-width: 1px;text-align: center;">
			   <a href = "<?php echo $myrow['link_code']?>">
			   <img style="max-width: 80%;max-height: 120px;margin-right: 10%;" src="<?php echo $myrow['events_pic']; ?>">
				<h6 style="font-size: 80%;text-decoration: none;margin-right: 9%;"><?php echo $myrow['Title']?>, <?php echo $myrow['game']?></h6></a>
				
			</div>
			</div>
		<?php
				
			 }
}

function events_feed_nav_user($conn, $user){
  $result1 = mysqli_query($conn, "SELECT * FROM attendants WHERE user= '$user'");
 while($myrow1 = mysqli_fetch_assoc($result1)){
  $event_id = $myrow1['event_id'];
  $result = mysqli_query($conn, "SELECT * FROM news WHERE id= '$event_id'");
        //lets make a loop and get all news from the database
        while($myrow = mysqli_fetch_assoc($result))
             {//begin of loop

        ?>
         <div class="w3-container" style="width: 100%; padding: 5px;">
      <ul style="background-color: black; border-style: solid; padding: 1px;border-color: #00e600; border-width: 1px;text-align: center;">
      <a href = "<?php echo $myrow['link_code']?>">
      <img style="max-width: 80%;max-height: 100%;margin-right: 10%;" src="<?php echo $myrow['events_pic']; ?>">
    <h6 style="font-size: 80%;text-decoration: none;margin-right: 9%;"><?php echo $myrow['Title']?>, <?php echo $myrow['game']?></h6></a>
    
   </ul>
   </div>
  <?php
    
    }
 }
}

function events_data($conn, $lc){
	$data = array();
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	
	unset($func_get_args[0]);
	
	$fields = implode(', ',$func_get_args);
	
	
	
	
	$sql2 = "SELECT id,user,Title,Content,date,doe,time, events_pic, fee,game,eventType, slots,address, address2,city, state,zipcode,website, email,number,company,paypal FROM news WHERE link_code = '$lc'";
	$data = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
	
	
	
	
	
	return $data;
}
function attendants_data($conn, $event_id){
	$data = array();
	$user_id = (int)$event_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	unset($func_get_args[0]);
	
	$fields = implode(', ',$func_get_args);
	
	
	
	$sql2 = "SELECT $fields FROM attendants WHERE event_id = '$event_id'";
	$data = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
	
	
	return $data;
}

function displayAllOwners($conn){
	$result = mysqli_query($conn, "SELECT DISTINCT owner FROM owners");
	while($myrow = mysqli_fetch_assoc($result)){
		?><a href = owners.php?owner=<?php echo $myrow['owner'];?>><?php echo $myrow['owner'];?></a><br>
		<?php
	}
}
function displayOwners($conn, $owner){
	$result = mysqli_query($conn, "SELECT * FROM owners WHERE owner= '$owner'");
	?>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wafer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Headtype<h4>
	<?php 
	while($myrow = mysqli_fetch_assoc($result)){
		?><h4><li> <?php echo $myrow['id'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $myrow['wafer']; ?> &nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $myrow['cc']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp <?php echo $myrow['headtype'] ?></li><h4><?php
	}
	?>
	
	<?php 
}
function displayAllWafers($conn){
	$result = mysqli_query($conn, "SELECT * FROM owners")
	?>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wafer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Headtype<h4>
	<?php 
	while($myrow = mysqli_fetch_assoc($result)){
		?><h4><li> <?php echo $myrow['id'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $myrow['wafer']; ?> &nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $myrow['cc']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp <?php echo $myrow['headtype'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp <?php echo $myrow['owner']; ?> </li><h4> <?php
	}
	
}
function attendant_count($event_id){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$result = mysqli_query($conn,"SELECT COUNT(user) FROM attendants WHERE event_id= '$event_id'");
    $row = mysqli_fetch_row($result);
    return $row[0];
}
function getLatitude($address){
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
  return $latitude;
        
}

function getLongitude($address){
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $longitude = $output->results[0]->geometry->location->lng;
  return $longitude;
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function show_teams(){
	
		
	?>
	<div class="w3-row">
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green" style="background: url(pictures/p7.png);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #008000;"><a href="#" style="text-decoration:none;"><h3><center>Riley. W</center></h3>
      <ul><h6>Pulse: <div id="heartbeat1"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature1"></div></h6></ul>
      <ul><h6>Accel: <div id="accel1"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green" style="background: url(pictures/p2.png);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #008000;><a href="#" style="text-decoration:none;"><h3><center>Mandy. J</center></h3>
      <ul><h6>Pulse: <div id="heartbeat2"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature2"></div></h6></ul>
      <ul><h6>Accel: <div id="accel2"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-red" style="background: url(pictures/p3.png);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #f00;">
      <a href="andrew.php" style="text-decoration:none;"><h3><center>Andrew J.</center></h3>
      <ul><h6>Pulse: <div id="heartbeat3"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature3"></div></h6></ul>
      <ul><h6>Accel: <div id="accel3"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green" style="background: url(pictures/p4.jpg);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #008000;><a href="#" style="text-decoration:none;"><h3><center>Luke T.</center></h3>
      <ul><h6>Pulse: <div id="heartbeat4"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature4"></div></h6></ul>
      <ul><h6>Accel: <div id="accel4"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-red" style="background: url(pictures/p1.png);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #f00;"><a href="jennifer.php" style="text-decoration:none;"><h3><center>Jennifer K.</center></h3>
      <ul><h6>Pulse: <div id="heartbeat5"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature5"></div></h6></ul>
      <ul><h6>Accel: <div id="accel5"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
    <div class="w3-third w3-padding">
      <div class="w3-container w3-green" style="background: url(pictures/p6.png);background-size: 100% 100%;box-shadow:inset 0px 0px 0px 6px #008000;><a href="#" style="text-decoration:none;"><h3><center>Gucci M.</center></h3>
      <ul><h6>Pulse: <div id="heartbeat6"></div></h6></ul>
      <ul><h6>Temp: <div id="temperature6"></div></h6></ul>
      <ul><h6>Accel: <div id="accel6"></div></h6></ul>
      <ul><h6>Coor: 39.097334, -94.586437</h6></ul>
      </div></a>
    </div>
		  <script>
window.onload = function() {
        ctr = document.getElementById("heartbeat1");
		ctr2 = document.getElementById("temperature1");
		ctr3 = document.getElementById("accel1");
		
		ctr4 = document.getElementById("heartbeat2");
		ctr5 = document.getElementById("temperature2");
		ctr6 = document.getElementById("accel2");
		
		ctr7 = document.getElementById("heartbeat3");
		ctr8 = document.getElementById("temperature3");
		ctr9 = document.getElementById("accel3");
		
		ctr10 = document.getElementById("heartbeat4");
		ctr11 = document.getElementById("temperature4");
		ctr12 = document.getElementById("accel4");
		
		ctr13 = document.getElementById("heartbeat5");
		ctr14 = document.getElementById("temperature5");
		ctr15 = document.getElementById("accel5");
		
		ctr16 = document.getElementById("heartbeat6");
		ctr17 = document.getElementById("temperature6");
		ctr18 = document.getElementById("accel6");
		
        function incrementCounter() {
           ctr.innerHTML = (Math.random() * (160 - 97)  + 97).toFixed(2);
		   ctr2.innerHTML = (Math.random() * (102.5 - 97)  + 97).toFixed(2);
		   ctr3.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
		   
           
		   ctr4.innerHTML = (Math.random() * (160 - 97)  + 97).toFixed(2);
		   ctr5.innerHTML = (Math.random() * (102.5 - 97)  + 97).toFixed(2);
		   ctr6.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
		   ctr7.innerHTML = (Math.random() * (180 - 155)  + 155).toFixed(2);
		   ctr8.innerHTML = (Math.random() * (104.5 - 101.8)  + 101.8).toFixed(2);
		   ctr9.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
		   ctr10.innerHTML = (Math.random() * (160 - 97)  + 97).toFixed(2);
		   ctr11.innerHTML = (Math.random() * (102.5 - 97)  + 97).toFixed(2);
		   ctr12.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
		   ctr13.innerHTML = (Math.random() * (180 - 160)  + 160).toFixed(2);
		   ctr14.innerHTML = (Math.random() * (103.5 - 101.7)  + 101.7).toFixed(2);
		   ctr15.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
		   ctr16.innerHTML = (Math.random() * (160 - 97)  + 97).toFixed(2);
		   ctr17.innerHTML = (Math.random() * (102.5 - 97)  + 97).toFixed(2);
		   ctr18.innerHTML = (Math.random() * (1 - 0) + 0).toFixed(2) ;
		   
           setTimeout( incrementCounter,10000);
        }
    
        incrementCounter();
    };
</script>
		  <?php

}



?>