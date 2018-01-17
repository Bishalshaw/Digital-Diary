<!DOCTYPE html>
<?PHP
SESSION_START();
mysql_connect("localhost","root","");
 mysql_select_db("bishal");
 $msg="";$nameErr=""; $emailidErr=""; $passErr="";$cpassErr=""; $dobErr=""; $mobErr="";$emailid2Err="";$nationErr="";
 if(isset($_POST['submit']))
	 {
	 	// name
	 	$name=$_POST['name'];
 if(!preg_match("/^[a-z. A-Z]*$/", $name))
	 {
	 $nameErr="<font color=red>Please insert Correct Name</font>";}
if(empty($name)){
	$nameErr="<font color=red> Name is required</font>";
}
// emailId
$emailid=$_POST['emailid'];
$com=substr($emailid,-4,4);
$coin=substr($emailid,-6,6);
if(empty($emailid)){
	$emailidErr="<font color=red>Email-Id is required</font>";
}
else if((strcasecmp($com,".COM")!=0)&&(strcasecmp($coin,".CO.IN")!=0)){
	$emailidErr="<font color=red>Please enter a Valid Email-Id !</font>";
}
// Password
$pass=$_POST['pass'];
if(empty($pass)){
	$passErr="<font color=red>Password is required</font>";
}
else if(strlen($pass)<5){
	$passErr="<font color=red>Password is too small, please try entering a STRONG password.</font>";
	}
// Confirm Password
$cpass=$_POST['cpass'];
if(empty($cpass)){
	$passErr1="<font color=red>Password is required</font>";
}
else if(strcmp($pass,$cpass)){
	$cpassErr="<font color=red>Password Deosn't Match</font>";}
// Date of birth
$dob=$_POST["dob"];
if(empty($dob)){
	$dobErr="<font color=red>Date of Birth is required</font>";
}
// Gender
$mf=$_POST['mf'];
// Mobile Number
$mob=$_POST['mob'];
if(empty($mob)){
	$mobErr="<font color=red>Mobile Number is required</font>";
}
else if(!preg_match("/^[0-9]*$/", $mob))
	 {
	 $mobErr="<font color=red>Please insert correct Mobile Number</font>";
	 }
else if(strlen($mob)!=10){
	$mobErr="<font color=red>Mobile Number must contain only 10 digits.</font>";
	}
// Second Email Id
$emailid2=$_POST['emailid2'];
$com1=substr($emailid2,-4,4);
$coin1=substr($emailid2,-6,6);
if(empty($emailid2)){
	$emailid2Err="<font color=red>Other Email ID is required</font>";
}
else if((strcasecmp($com1,".COM")!=0)&&(strcasecmp($coin1,".CO.IN")!=0)){
	$emailid2Err="<font color=red>Please enter a Valid Email-Id!</font>";
}
$nation=$_POST['nation'];
if(!preg_match("/^[0-9.a-z A-Z]*$/", $nation))
	 {
	 $nationErr="<font color=red>Please insert correct Nationality</font>";}
if(empty($nation)){
	$nationErr="<font color=red>Nationality is required</font>";
}
if(($nameErr=="")&&($emailidErr=="")&&($passErr=="")&&($dobErr=="")&&($mobErr=="")&&($emailid2Err=="")&&($nationErr=="")&&($cpassErr=="")) {
$ins="INSERT INTO `diary`(`name`,`emailid`,`pass`,`dob`,`mf`,`mob`,`emailid2`,`nation`) VALUES('$name','$emailid','$pass','$dob','$mf','$mob','$emailid2','$nation');";
$res=mysql_query($ins);
	if($res){
		$msg="<font color=green>Record is Successfully Added!</font>";
		mkdir("Users/$emailid");
	}
		else{
			$msg="<font color=red>Error In Record Insertion!</font>";
		}}
else{ $msg="<font color=red>Error In Record Insertion!</font>";}
}
if(isset($_POST['login']))
	 {
	 	 $sel="select * from diary where emailid='".$_POST['userid']."' and pass='".$_POST['userpass']."'";
	 $res=mysql_query($sel);
	 if(mysql_num_rows($res)>0){
		 $row=mysql_fetch_object($res);
		 $_SESSION['loginid']=$row->emailid;
		 $_SESSION['name']=$row->name;
		 header("location:home.php");
	 } else {
		 $loginmsg="<div style='color:red;'> Invalid ID/Password</div>";
	 }
	 }
 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/ripple.css">
  <link rel="stylesheet" href="css/style.css">
  <style media="screen">
  body{
    background: #fff url(images/computer.jpg) 0 0 no-repeat;
    background-size: 100% 100vh;
    background-attachment: fixed;
  }
  .navbar{
    background: linear-gradient(to right, #1A293C, #6F9AAD);
  }
  </style>
</head>
<body>
  <!-- navbar -->
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <a class="navbar-brand container" href="#" style="
    color: #fff;">MyDiary</a>
</nav>
<br>
    <div class="container">
      <div class="row justify-content-around">
        <form class="" action="index.php" method="post">
        <div class="col login"><h3>Log-In</h3>
        <div class="row">
          <div class="col">
            UserName
          </div>
          <div class="col">
            <input type="email" name="userid" value="" placeholder="Something@example.com">
          </div>
        </div>
          <div class="row">
            <div class="col">
              Password
            </div>
            <div class="col">
              <input type="password" name="userpass" value="" placeholder="something">
            </div>
          </div>
          <center>
          <button type="submit" name="login" class="btn ripple loginmargin">Log In</button>
          <br>
          <?=@$loginmsg?>
          <center>
        </div>
        </form>
        <form class="" action="index.php" method="post">
        <div class="col ca">
          <h3>Create Account</h3><br>
          <div class="row">
            <div class="col">
              Name
            </div>
            <div class="col">
              <input type="text" name="name" value="" placeholder="First Last">
            </div>
            <div class="col">
              <?=@$nameErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              UserName
            </div>
            <div class="col">
              <input type="email" name="emailid" value="" placeholder="Something@example.com">
            </div>
            <div class="col">
              <?=@$emailidErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Password
            </div>
            <div class="col">
              <input type="password" name="pass" value="" placeholder="Something">
            </div>
            <div class="col">
              <?=@$passErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Confirm Password
            </div>
            <div class="col">
              <input type="password" name="cpass" value="" placeholder="Something">
            </div>
            <div class="col">
              <?=@$cpassErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Date of Birth
            </div>
            <div class="col">
              <input type="date" name="dob" value="">
            </div>
            <div class="col">
              <?=@$dobErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Gender
            </div>
            <div class="col">
              <select class="" name="mf">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="Transgender">Transgender</option>
              </select>
            </div>
            <div class="col">
              <?=@$mfErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Mobile Phone
            </div>
            <div class="col">
              +91<input type="tel" name="mob" value="" placeholder="0123456789">
            </div>
            <div class="col">
              <?=@$mobErr?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Any Other Email-Id
            </div>
            <div class="col">
              <input type="email" name="emailid2" value="" placeholder="Something2@example.com">
            </div>
            <div class="col">
              <?=@$emailid2Err?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              Location
            </div>
            <div class="col">
              <input type="text" name="nation" value="">
            </div>
            <div class="col">
              <?=@$nationErr?>
            </div>
          </div>
          <center>
          <button type="submit" name="submit" class="btn ripple">Create Account</button>
          <br>
          <?=$msg?>
          <center>
        </div>
        </form>
      </div>
    </div>
</body>
<script src="js/jquery-3.2.1.slim.js" charset="utf-8"></script>
<script src="js/bootstrap.js" charset="utf-8"></script>
</html>
