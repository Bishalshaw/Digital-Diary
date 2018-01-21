<?php
SESSION_START();
// Create connection
$conn = new mysqli("localhost", "root","");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 mysqli_select_db($conn,"bishal");
if(isset($_SESSION['loginid'])) {
  $loginid=$_SESSION['loginid'];
$res=mysqli_query($conn,"select * from data where id='".@$_SESSION['loginid']."'");
// File Handling
  $date=date("d-m-Y");
@$myFile2= "Users/$loginid/$date.txt";
if(@$_POST["submit"]){
$myFileLink2= fopen($myFile2, 'w+') or die("Can't open file");
$newContents=$_POST["entry"];
fwrite($myFileLink2, $newContents);
  fclose($myFileLink2);
}
if(file_exists($myFile2)){
$str="";
@$myfile = fopen($myFile2, "r") or die("Unable to open file!");
while(!feof($myfile)) {
$str=$str.fgets($myfile);
}
fclose($myfile);
}
// date search
if (@$_POST["search"]) {
  $dt=$_POST["dtsearch"];
  $dt=date('d-m-Y', strtotime($dt));
  $str="";
@$myFile2= "Users/$loginid/$dt.txt";
  @$myfile = fopen($myFile2, "r") or die("Unable to open file!");
  while(!feof($myfile)) {
  $str=$str.fgets($myfile);
  }
  fclose($myfile);
}
//get the lastest file uploaded in uploads/
$path = "Users/$loginid";
$d = dir($path);
  $files="";
while (false !== ($entry = $d->read())) {
$filepath = "{$path}/{$entry}";
//Check whether the entry is a file etc.:
    if(is_file($filepath)) {
    $latest_filename = $entry;
    $files=$files.$latest_filename."<br>";
    } //end if is file etc.
}//end while going over files in uploads dir.
}
?>
<html lang="en">
 <head>
  <title>My Account</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/ripple.css">
  <link rel="stylesheet" href="css/style.css">
  <style media="screen">
    a{
      color: #000;
    }
    a:hover{
      color: #fff;
    }
    body{
        background: #fff url(images/board.jpeg) 0 0 no-repeat;
        background-attachment: fixed;
        background-size: 100% 100vh;
    }
    .btn{
      width: 100%;
    }
    .margin{
      margin: 2vh 0vw;
    }
  </style>
 </head>
 <body>
   <form class="" action="entries.php" method="post">
     <!-- navbar -->
          <div class="welcome">
       <div class="row justify-content-between">
         <div class="col-9 h5">
           Welcome <?php echo strtoupper(@$_SESSION['name']); ?>
         </div>
         <div class="col-3 h5">
           <a href="logout.php">Log-Out</a>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-3 col-xl-2 col-sm-4 menubar">
         <div class="row margin">
           <div class="col">
             <a href="home.php" class="btn ripple">Home</a>
           </div>
         </div>
         <div class="row margin">
           <div class="col">
             <input type="date" name="dtsearch" value="" style="width:100%;">
           </div>
         </div>
         <div class="row margin">
           <div class="col">
             <button type="submit" name="search" value="search" class="btn ripple">Search</button>
           </div>
         </div>
       </div>
       <div class="col-9 col-xl-10 col-sm-8">
         <h5>Today Date is <?php echo date("d-m-Y"); ?></h5>
        <center> <h2><font color="blue"><u>Go to Entry</u></font></h2></center>
          <button type="submit" name="search" class="entry"><?=$files?></button>
          <textarea name="entry" class="inputlg"><?=@$str?>
          </textarea>
       </div>
     </div>
</form>
 </body>
 <script src="js/jquery-3.2.1.slim.js" charset="utf-8"></script>
 <script src="js/bootstrap.js" charset="utf-8"></script>
</html>
