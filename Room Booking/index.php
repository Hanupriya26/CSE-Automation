<html>
<head>
  
<meta http-equiv="content-type" content="text/html;charset=utf-8">
  <link rel="stylesheet" href="styles.css" >
<title>Room Booking</title></head>
<?php session_start() ?>
<script>
  function userpop() {
  document.getElementById("userbox").style.display = "block";
}
function closeuser() {
    document.getElementById("userbox").style.display = "none";
}
function closepop() {
  document.getElementById("detailsbox").style.display = "none";
}
function submitform()
{
  document.myform.submit();
}
function adminpop() {
  document.getElementById("adminbox").style.display = "block";
}
function closeadmin() {
    document.getElementById("adminbox").style.display = "none";
}
function adduser() {
  document.getElementById("adduser").style.display = "block";
}
function closeadduser() {
    document.getElementById("adduser").style.display = "none";
}
function addroom() {
  document.getElementById("addroom").style.display = "block";
}
function closeaddroom() {
  document.getElementById("addroom").style.display = "none";

}
function mybookingpop() {
  document.getElementById("mybooking").style.display = "block"; 
}
function closemybooking() {
  document.getElementById("mybooking").style.display = "none";

}
function notbooked() {
  document.getElementById("notbooked").style.display = "block";
}
function closenotbooked() {
  document.getElementById("notbooked").style.display = "none";
}
function closedeluser() {
    document.getElementById("deluser").style.display = "none";
}

function deluser() {
  document.getElementById("deluser").style.display = "block";
}

</script>
<body>

<img src="title.png" width=100%>
<div id="adminbox" class="popbox" hidden>
  <div>
<button class="close" onclick="closeadmin()">X</button><br>
        <form action="?" method="post">
          <br><br>
          AdminID<input type="text" name="adminname" required></input><br>
          <br>
          Password <input type="password" name="adminpass" required></input><br><br>
          <center>
          <button type="submit" class="formsubmit" name="adminlogin">Login</button></center>
        </form>
</div>
</div>
<div id="addroom" class="popbox" hidden>
  <div>
<button class="close" onclick="closeaddroom()">X</button><br>
        <form action="?" method="post">
          Room number <input type="text" name="addroomno" required></input><br>
          Building <input type="text" name="addbuilding" required></input><br>
          Capacity <input type="text" name="addcapacity" required></input><br>
          <center><button type="submit" class="formsubmit" name="addroom">Add Room</button></center>
        </form>
</div>
</div>
<div id="adduser" class="popbox" hidden>
  <div>
<button class="close" onclick="closeadduser()">X</button><br>
        <form action="?" method="post">
          username<input type="text" name="addusername" required></input><br>
          Password <input type="password" name="addpass" required></input><br>
          Email <input type="email" name="addemail" required></input><br>
<center><button type="submit"class="formsubmit" name="adduser">Add User</button></center>
        </form>
</div>
</div>
<div id="deluser" class="popbox" hidden>
  <div>
<button class="close" onclick="closedeluser()">X</button><br>
        <form action="?" method="post">
          Username <input type="text" name="delusername" required><br>
         <center> <button type="submit" class="formsubmit" name="deluserform">Delete User</button></center>
        </form>
</div>
</div>
<div id="userbox" class="popbox" hidden>
      <div>
          <button class="close" onclick="closeuser()">X</button><br>
          <p>Login to continue</p><br>
          <form method="post" action="?">
            Username <input type="text" name="username" required></input><br><br>
            Password <input type="password" name="password" required></input><br><br>
            <center><button type="submit" class="formsubmit"name="userlogin">Login</button></center>
          </form>
      </div>
      </div>
<div id="notbooked" class="popbox" hidden>
        <div>
      <button class="close" onclick="closenotbooked()">X</button><br>
       <p> Not booked by anyone</p>
    </div></div>
<?php
$host="localhost";
$dbusername="root";
$s=0;
$dbpassword="";
$dbname="test";
$dbconn =mysqli_connect($host,$dbusername,$dbpassword,$dbname);
$sql=mysqli_query($dbconn,"SELECT distinct building from rooms"); 

if(isset($_POST["logout"]))
{
  session_destroy();
  echo "<script>alert(\"Logged out successfully\")</script>";
  echo "<script> window.location=\"index.php\"</script>";
}
if(isset($_POST['viewdate']))
{
  $date=$_POST['viewdate'];
  $_SESSION['viewdate']=$date; 
}
else 
{
  if(isset($_SESSION["viewdate"]) ){$date=$_SESSION['viewdate'];  }
  else $date=date("Y-m-d");
}
if(isset($_POST['adduser']))
{
  $addusername=$_POST['addusername'];
  $addpass=$_POST['addpass'];
  $addemail=$_POST['addemail'];
  $sql11=mysqli_query($dbconn,"insert into users values('".$addusername."','".$addpass."','".$addemail."')");   
  echo "<script>alert(\"new user added successfully\")</script>";
}

if(isset($_POST['addroom']))
{
  $addroomno=$_POST['addroomno'];
  $addbuilding=$_POST['addbuilding'];
  $addcapacity=$_POST['addcapacity'];
  $sql11=mysqli_query($dbconn,"insert into rooms(roomno,building,capacity) values('".$addroomno."','".$addbuilding."','".$addcapacity."')");  
  echo "<script>alert(\"new Room added successfully\")</script>"; 
}

if(isset($_POST['deluserform']))
{
    $delusername=$_POST['delusername'];
    
    $sqlpq=mysqli_query($dbconn,"SELECT *from users where username='".$delusername."'");
    $temp=0;
    while($rowpq=mysqli_fetch_assoc($sqlpq))
    {
      $temp=1;
      $sqlqp="DELETE from users where username='".$delusername."'";
      $resultqp=mysqli_query($dbconn,$sqlqp);
      echo "<script>alert(\"Deleted user successfully\")</script>";
      // echo "<script> window.location=\"index.php\"</script>";
    }
if($temp==0)
    {
      echo "<script>alert(\"User doesn't exist\")</script>";
      // echo "<script> window.location=\"index.php\"</script>";
    }
    
} 

if(isset($_POST['adminlogin']))
{
  $dummy2=0;
  $adminname=$_POST['adminname'];
  $adminpass=$_POST['adminpass'];
  $sqll1=mysqli_query($dbconn,"SELECT password from admin where adminid='".$adminname."'"); 
  while($row9=mysqli_fetch_assoc($sqll1))
  {$dummy2=1;
    if($adminpass==$row9['password'])
    {
      $_SESSION['adminname']=$adminname;
      echo "<script>alert(\"Logged in successfully\")</script>";?>
      
    <br>
        
  <button onclick="addroom()" class="amdinnavigation" name="addroom">Add a Room</button>
    <button onclick="adduser()" class="amdinnavigation" name="adduser">Add a User</button> 
    <button onclick="deluser()" class="amdinnavigation"  name="deluser">Delete User</button>
    <form action="?" method="post"> 
      <button type="submit" class="amdinnavigation" name="logout" style = "float:right;">Logout</button>
      </form><br>
    
    <h2> Logged in as Admin</h2><br>
      <?php
    }
    else
    {
      $adminname="empty";
      $adminpass="empty";
      echo "<script>alert(\"Enter valid credentials\")</script>"; }
  }
  if($dummy2==0)
  {
    $adminname="empty";
      $adminpass="empty";
      echo "<script>alert(\"Enter valid credentials\")</script>";
  }
}
else
{
  if(isset($_SESSION["adminname"]))
  {    $adminname=$_SESSION["adminname"]; ?>

  <br>    
    
  <button onclick="addroom()" class="amdinnavigation" name="addroom">Add a Room</button>
    <button onclick="adduser()" class="amdinnavigation" name="adduser">Add a User</button> 
    <button onclick="deluser()" class="amdinnavigation"  name="deluser">Delete User</button>
    <form action="?" method="post"> 
      <button type="submit" class="amdinnavigation" name="logout" style = "float:right;">Logout</button>
      </form><br>
    <h2> Logged in as Admin</h2>
    <br><br>
    <?php }
  else{    $adminname="empty"; $adminpass="empty";  }
}


if(isset($_POST['userlogin']))
{
  $dummy=0;
  $username=$_POST['username'];
  $password=$_POST['password'];
  $sqll=mysqli_query($dbconn,"SELECT password from users where username= '".$username."'"); 
  while($row=mysqli_fetch_assoc($sqll))
  {$dummy=1;
    if($password==$row['password'])
    {
      $_SESSION['username']=$username;
      echo "<script>alert(\"Logged in successfully\")</script>";?>
      
      <div >
      <form action="?" method="post"> 
<button type="submit" class="usernavigation" name="logout">Logout</button><br>

<h2> Welcome <?php echo $username ?> </h2>
<br>
</form>
    </div>
      <?php
    }
    else
    {
      $username="empty";
      $password="empty";
      echo "<script>alert(\"Enter valid credentials\")</script>";?>
      <div class="pane">
      <button onclick="adminpop()" class="navigation">Admin Login</button>
    <button onclick="userpop()" class="navigation">User Login</button>
    </div>
    <br><br>
    <?php }
  }
  if($dummy==0)
  {
    $username="empty";
      $password="empty";
      echo "<script>alert(\"Enter valid credentials\")</script>";
      ?>
      <div class="pane">
      <button onclick="adminpop()" class="navigation">Admin Login</button>
    <button onclick="userpop()" class="navigation">User Login</button>
    </div>
    <br><br>
    <?php
  }
}
else if(!isset($_SESSION["adminname"]))
{
  if(isset($_SESSION["username"]))
  {    $username=$_SESSION["username"]; ?>
  <div >
    <form action="?" method="post"> 
    <button type="submit" class="usernavigation" name="logout">Logout</button><br>
    </form>
    
  <h2> Welcome <?php echo $username ?> </h2><br>
  </div>
    <?php }
else{    $username="empty"; $password="empty"; 
    ?>
    <div class="pane">
      <button onclick="adminpop()" class="navigation">Admin Login</button>
    <button onclick="userpop()" class="navigation">User Login</button>
    </div>
    <br><br>
  <?php }
}
else
{
  $username="empty"; $password="empty";
}


if(isset($_POST['building']))
{
    $building=$_POST['building'];
    $_SESSION['building']=$building;
}
else
{
    if(isset($_SESSION["building"]) ){$building=$_SESSION['building'];}
    else {$building="1E";}
}

if(isset($_POST['book']))
{
    $booktime=$_POST['booktime'];
    $bookroom=$_POST['bookroom'];
    $_SESSION['booktime']=$booktime;
    $_SESSION['bookroom']=$bookroom;
    if(!isset($_SESSION["adminname"]))
    {
      if($username=="empty")
    {
      echo '<script >userpop()</script>';
    //detailsbox.userpop();
     //////////////////////////////////////////////////////////  
    }
    else if($date> date("Y-m-d"))
    {?>
    <div id="detailsbox" class="popbox" >
      <div>
          <button class="close" onclick="closepop()">X</button><br>
          <form action="?" method="post">
      <p>Book this slot?</p>
      Date : <?php echo $date; ?><br>
         Username  : <?php echo $username;?> <br>
         Starttime : <?php echo $booktime; ?> <br>
         roomno : <?php $sql4=mysqli_query($dbconn,"select roomno from rooms where roomid=".$bookroom.""); 
         while($row2=mysqli_fetch_assoc($sql4))
         {echo $row2['roomno'];} ?><br>
         Building: <?php echo $building; ?> <br>
         End time:  <select name="timeend" >
         <?php 
         $dummy1="0";
         $sql3=mysqli_query($dbconn,"SELECT min(starttime) as st from activebookings where dateofevent='".$date."'and roomid='".$bookroom."' and starttime >'".$booktime."'");
         while($row2=mysqli_fetch_assoc($sql3))
        {          
          $dummy1="1";
          if($row2['st']) {$timeend=date("G:i",strtotime($row2['st']));}
          else {$timeend="20:00";}
         }
        if($dummy1=="0"){$timeend="20:00";}
        $j = date("G:i", strtotime('+30 minutes', strtotime($booktime)));
        for($j;$j!=$timeend;)
        {
          echo "<option value=".$j.">".$j."</option>";
        $j = date("G:i", strtotime('+30 minutes', strtotime($j)));
        }
        echo "<option value=".$j.">".$j."</option>";
          ?>
          </select><br>
          purpose <input name="purpose" required></input><br>
         <br><button name="room" class="formsubmit" type="submit">Book</button>
      </form>
    </div>
    </div>
    <?php }
    else
    {
      echo '<script>notbooked()</script>';
    }
    }else
    {
      echo '<script >notbooked()</script>';
    }
}
else
{
    if(isset($_SESSION["booktime"]) ){$booktime=$_SESSION['booktime'];  }
    if(isset($_SESSION["bookroom"]) ){$bookroom=$_SESSION['bookroom']; }
}


if(isset($_POST['room']))
{
  $timeend=$_POST['timeend'];
  $purpose=$_POST['purpose'];
  $sql4=mysqli_query($dbconn,"insert into activebookings values(curdate(),'".$date."','".$purpose."','".$bookroom."','".$username."','".$booktime."','".$timeend."') ");   
  $sql6=mysqli_query($dbconn,"select email from users where username='".$username."'");
  while($row3=mysqli_fetch_assoc($sql6))
  {$email=$row3['email'];}
$sql7=mysqli_query($dbconn,"select roomno from rooms where roomid='".$bookroom."'");
while($row4=mysqli_fetch_assoc($sql7))
  {$roomnum=$row4['roomno'];}
  $message="Booking successful \n
Username: '.$username.' \n
Room num: '.$roomnum.' \n
Building: '.$building.'
Date of event: '.$date.'\n
Purpose: '.$purpose.'\n
Starttime: '.$booktime.'\n";
require 'PHPMailerAutoload.php';
require 'credential.php';
$mail = new PHPMailer;

// $mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = mailid;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(mailid, 'Test');
$mail->addAddress($email);     // Add a recipient 
$mail->addReplyTo(mailid);
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Room booking';
$mail->Body    = $message;
$mail->AltBody = 'Error';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {    
  echo "<script>alert(\"Booking confirmed. Confirmation mail sent \")</script>";
}
}

if(isset($_POST['mybooking']))
{
  $bookuser=$_POST['bookuser'];
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $roomid=$_POST['roomid'];
  $eventdate=$_POST['eventdate'];
  $bookdate=$_POST['bookdate'];
  $bookpurpose=$_POST['bookpurpose'];
  ?>
  <div id="mybooking" class="popbox" hidden>
  <div>
          <button class="close" onclick="closemybooking()">X</button><br>
          <form method="post" action="?">
            <?php
            echo "<p>Purpose:".$bookpurpose."</p>";
            if($eventdate>=date("Y-m-d"))
            {
            echo "<input type=\"hidden\" name=\"bookuser\" value=\"".$bookuser."\"></input>";
            echo "<input type=\"hidden\" name=\"bookpurpose\" value=\"".$bookpurpose."\"></input>";
            echo "<input type=\"hidden\" name=\"starttime\" value=\"".$starttime."\"></input>";
            echo "<input type=\"hidden\" name=\"roomid\" value=\"".$roomid."\"></input>";
            echo "<input type=\"hidden\" name=\"bookdate\" value=\"".$bookdate."\"></input>";
            echo "<input type=\"hidden\" name=\"eventdate\" value=\"".$eventdate."\"></input>";
            echo "<input type=\"hidden\" name=\"endtime\" value=\"".$endtime."\"></input>";
         ?>
         <button type="submit" name="cancellation"> Cancel Booking</button> <?php } ?>
         </form>
      </div>
      </div>
      <?php
  echo '<script> mybookingpop();</script>';
}
if(isset($_POST['cancellation']))
{
  $bookuser=$_POST['bookuser'];
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $roomid=$_POST['roomid'];
  $bookdate=$_POST['bookdate'];
  $eventdate=$_POST['eventdate'];
  $bookpurpose=$_POST['bookpurpose'];
  $sqlnm="DELETE from activebookings where username='".$bookuser."'and endtime='".$endtime."' and starttime='".$starttime."'and roomid='".$roomid."'and dateofevent='".$eventdate."'";
$resultnm=mysqli_query($dbconn,$sqlnm); 
$sqlmn="INSERT INTO expiredbookings(username,starttime,endtime,roomid, dateofbooking, dateofevent, purpose, dateofcancellation) VALUES ('".$bookuser."','".$starttime."','".$endtime."','".$roomid."','".$bookdate."','".$eventdate."','".$bookpurpose."',curdate())";
$resultmn=mysqli_query($dbconn,$sqlmn);
echo "<script>alert(\"Booking cancelled successfully\")</script>";
}

if(isset($_POST['details']))
{
    $bookuser=$_POST['bookuser'];
    $bookpurpose=$_POST['bookpurpose']?>
    <div id="detailsbox" class="popbox" >
    <div>
        <button class="close" onclick="closepop()">X</button><br>
        <?php echo "<p>Booked by:".$bookuser."<br>" ;
        echo "<p>Additional Notes:".$bookpurpose."<br>";?>
    </div>
    </div><?php 
} 


echo "<div class=\"content\"><table>";
while($row=mysqli_fetch_assoc($sql))
{
    echo "<form method=\"post\" action=\"?\">";
    echo "<input type=\"hidden\" name=\"building\" value=\"".$row['building']."\" ></input>";
    echo "<button class=\"building\" type=\"submit\" name=\"building\">".$row['building']."</button>";
    echo "<br></form>";
}
echo "</table><br><br>";?>
<form method="POST" action="?" name="myform" >
 Date   : 
 <input type='date' value="<?php echo $date ?>" name="viewdate" onChange="submitform()"/>
</form>


<br><br>
<table border="1" style = "float:left;">
<tr><td>Start Time:</td>
<?php
   $i="08:00";
   for ($i ; $i !=("20:00");){
      echo "<tr> <td>".$i."</td></tr>";
      $i = date("G:i", strtotime('+30 minutes', strtotime($i)));
   }
   echo "</table>";
 $result=mysqli_query($dbconn,"SELECT* FROM rooms where building='".$building."'"); 
 while($row=mysqli_fetch_assoc($result))
 {
    echo "<table style = \"float:left;>\" border=\"1\"><tr>";
    echo "<td>". $building."  " . $row["roomno"]. "</td></tr>";
  $t="8:00";
  $halt="20:00";
 if($date>=date("Y-m-d")) $result1=mysqli_query($dbconn,"SELECT*FROM activebookings where dateofevent= '".$date."' and roomid='".$row["roomid"]."' order by starttime ASC "); 
 else 
 {
   $result1=mysqli_query($dbconn,"SELECT*FROM expiredbookings where dateofevent= '".$date."' and roomid='".$row["roomid"]."' and dateofcancellation is NULL order by starttime ASC "); 
 }
   while($row1=mysqli_fetch_assoc($result1))
 {
      $starttime=date("G:i",strtotime($row1["starttime"]));
      $endtime=date("G:i",strtotime($row1["endtime"]));
      if($t!=$starttime)
      {
      for ($t ; $t !=($starttime);){
          echo "<form method=\"post\" action=\"?\">";
         echo "<input type=\"hidden\" name=\"booktime\" value=\"".$t."\"></input>";
        echo "<input type=\"hidden\" name=\"bookroom\" value=\"".$row["roomid"]."\"></input>";
         echo "<tr> <td><button class=\"timeslot\" type=\"submit\"  name=\"book\" ></button> </td></tr></form>";
         $t = date("G:i", strtotime('+30 minutes', strtotime($t)));
      }
    }
      $size=(strtotime($endtime)-strtotime($starttime))/1800;
      echo "<form method=\"post\" action=\"?\">";
      echo "<input type=\"hidden\" name=\"bookuser\" value=\"".$row1['username']."\"></input>";
      echo "<input type=\"hidden\" name=\"bookpurpose\" value=\"".$row1['purpose']."\"></input>";
      if($row1['username']!=$username)
      {
        echo "<tr><td rowspan=".$size."><button class=\"timeslot\" type=\"submit\" name=\"details\">Booked by ".$row1['username']."</button></td></tr></form>"; 
      }
      else
      {
        
        echo "<input type=\"hidden\" name=\"starttime\" value=\"".$row1['starttime']."\"></input>";
        echo "<input type=\"hidden\" name=\"roomid\" value=\"".$row1['roomid']."\"></input>";
        echo "<input type=\"hidden\" name=\"eventdate\" value=\"".$row1['dateofevent']."\"></input>";
        echo "<input type=\"hidden\" name=\"bookdate\" value=\"".$row1['dateofbooking']."\"></input>";
        echo "<input type=\"hidden\" name=\"endtime\" value=\"".$row1['endtime']."\"></input>";
        echo "<tr><td rowspan=".$size."><button class=\"timeslot\" type=\"submit\" name=\"mybooking\">View your booking </button></td></tr></form>"; 
      }
      for($i=1;$i<$size;$i++)
      {
         echo "<tr></tr>";
      }
      $t=$endtime;  
 } 
 for ($t ; $t !=$halt; ){
    echo "<form method=\"post\" action=\"?\">";
   echo "<input type=\"hidden\" name=\"booktime\" value=\"".$t."\"></input>";
   echo "<input type=\"hidden\" name=\"bookroom\" value=\"".$row["roomid"]."\"></input>";
   echo "<tr> <td><button class=\"timeslot\" type=\"submit\"  name=\"book\" ></button> </td></tr></form>";
    $t = date("G:i", strtotime('+30 minutes', strtotime($t)));
 }
echo "</table>";
 }
?>
</div>
</body>
</html>
