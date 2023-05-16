<?php
session_start();
include('./includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = './html/index.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
      
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title> Login Page </title>
  </head>
  <body>
    <section class="form-01-main">
      <div class="form-cover">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="form-sub-main">
              <div class="_main_head_as">
                <a href="#">
                  <img src="assets/images/vector.png">
                </a>
              </div>
              <form method="post">
              <div class="form-group">
                  <input id="email" name="username" class="form-control _ge_de_ol" type="text" placeholder="Enter Email" required="" aria-required="true">
              </div>

              <div class="form-group">                                              
                <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
              </div>

              <div class="form-group">
                <div class="check_box_main">
                  <a href="#" class="pas-text">Forgot Password</a>
                </div>
              </div>

              <div class="form-group">
                <div class="btn_uy">
                <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>

                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </body>
</html>