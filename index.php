<?php
include_once "db.php";
session_start();
$db = new db();
if((!empty($_REQUEST['email2'])) && (!empty($_REQUEST['pswd2']))){
  $sql = "SELECT id FROM details WHERE email = '".$_REQUEST['email2']."' AND pswd= '".$_REQUEST['pswd2']."'";
  $resp = mysqli_query($db->conn, $sql);
  $count = mysqli_num_rows($resp);
  if($count == 1){
    $row2 = mysqli_fetch_array($resp);
    $_SESSION['email2'] = $_REQUEST['email2'];
    header("location: table.php");
  }else{
    $msg = "<span style='margin-top:4%;font-size: 50px;color:red;text-align:center;'>Ivalid Login!</span>";
  }
}
elseif(!empty($_POST)){
  $params['fname'] = $_REQUEST['fname'];
  $params['lname'] = $_REQUEST['lname'];
  $params['email'] = $_REQUEST['email'];
  $params['pswd'] = $_REQUEST['pswd'];
  $resp = $db->insert($params);
  if($resp == 'success'){
    $msg = "<span style='margin-top:4%;font-size: 50px;color:#1ab188;text-align:center;'>Account Created!</span>";
  }else{
    $msg = "<span style='margin-top:4%;font-size: 50px;color:red;text-align:center;'>Error!! Please try Again</span>";
  }
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">  
</head>
<body align="center">
  <?php if(!empty($msg)){
    echo "$msg";
  } ?>
<div class="form">
  <ul class="tab-group">
    <li class="tab active"><a href="#signup">Sign Up</a></li>
    <li class="tab"><a href="#login">Log In</a></li>
  </ul>
  <div class="tab-content">
    <div id="signup">   
      <h1>Sign Up</h1>
      <form action="index.php" method="post">
        <div class="top-row">
          <div class="field-wrap">
            <label>
              First Name<span class="req">*</span>
            </label>
            <input type="text" name="fname" required autocomplete="off" />
          </div>

          <div class="field-wrap">
            <label>
              Last Name<span class="req">*</span>
            </label>
            <input type="text" name="lname" required autocomplete="off"/>
          </div>
        </div>

        <div class="field-wrap">
          <label>
            Email Address<span class="req">*</span>
          </label>
          <input type="email" name="email" required autocomplete="off"/>
        </div>

        <div class="field-wrap">
          <label>
            Set A Password<span class="req">*</span>
          </label>
          <input type="password" name="pswd" required autocomplete="off"/>
        </div>

        <button type="submit" class="button button-block"/>Get Started</button>
      </form>
    </div>

    <div id="login">   
      <h1>Welcome Back!</h1>
      <form method="post">

        <div class="field-wrap">
          <label>
            Email<span class="req">*</span>
          </label>
          <input type="email" id="email2" name="email2" required autocomplete="off"/>
        </div>

        <div class="field-wrap">
          <label>
            Password<span class="req">*</span>
          </label>
          <input type="password" id="pswd2" name="pswd2" required autocomplete="off"/>
        </div>

        <p class="forgot"><a href="#">Forgot Password?</a></p>
        <button class="button button-block"/>Login</button>
      </form>
    </div>
  </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
