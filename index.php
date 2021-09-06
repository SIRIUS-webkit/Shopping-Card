<?php
session_start();

define("DB_HOST","localhost");
define("DB_NAME","shopcart");
define("DB_USER","root");
define("DB_PASSWORD","");

function dbconnection(){
  $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  if(mysqli_connect_errno() > 0){
    die("Connection Failed");
  }else{
    return $db;
  }
}
if(isset($_POST["signup"])){
  $username = $_POST["username"];
  $signupemail = $_POST["email"];
  $createpass = $_POST["pass"];
  $confirmpass = $_POST["repass"];
  $address = $_POST["address"];

 //  $username = $firstname." ".$lastname;
 //
 // if(empty($firstname) || empty($lastname)){
 //   $err1 = "Username is required";
 //   $err2 = "";
 // }else if(empty($signupemail)){
 //   $err1 = "Email is required";
 //   $err2 = "";
 // }else if(empty($createpass) && empty($confirmpass)){
 //   $err1= "Password is required";
 //   $err2 = "";
 // }else if(empty($gener)){
 //   $err1= "Gener selection is required";
 //   $err2 = "";
 // }else if($createpass != $confirmpass){
 //   $err1 = "Password must be equal";
 //   $err2 = "";
 // }else{
 //   $err1 = " ";
 //   $err2 = "Your Account is sucessfully created";
   $createpass = sha1($createpass);

   $query = "INSERT INTO register (username,email,password,address) VALUES ('${username}','${signupemail}','${createpass}','${address}');";
   function singledatainsert($qry){
     $database = dbconnection();
      $results = mysqli_query($database,$qry);

        if(mysqli_insert_id($database) > 0){
           $err2 = "Your Account is sucessfully created";
       }else{
        echo "Insert Failed";
      }
   }
     singledatainsert($query);
 }
 $query = "SELECT * FROM register";

   if(isset($_POST["login"])){
     $database = dbconnection();
     $result = mysqli_query($database,$query);

     $username = $_POST["loginmail"];
     $password = sha1($_POST["loginpassword"]);
     if(mysqli_num_rows($result) > 0){
       foreach($result as $data){
         if($username == $data["email"] && $password == $data["password"]){
           $_SESSION["name"] = $data["username"];
           $_SESSION["username"] = $username;
           $_SESSION["password"] = $password;
           header("Location:index.php");
           // exit();
         }else{
           $warne = "Do not match";
         }
       }

     }
   }
   if(isset($_POST["logout"])){
     unset($_SESSION["password"]);
     unset($_SESSION["username"]);
     $_SESSION["name"] = " ";
     header("Location: index.php");
   }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Source+Sans+Pro&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  </style>
</head>
<body>
  <header>
    <div class="container">
        <div class="row precheck">
            <div class="logo">
               <h3>Online Shopping</h3>
            </div>
            <div class="cart">
              <p>Cart</p>
              <div class="cart-design">
                <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
              </div>

              <span class="cart-count">0</span>
              <span class="menu-login">Login</span>
              <span class="usrname"><?php echo $_SESSION["name"]; ?> </span>
              <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
                <button class="log-btn" type="submit" name="logout"><span class="menu-logout" name="logout">Logout</span></button>
              </form>

            </div>
        </div>
    </div>
  </header>
   <div class="login-section active">
      <div class="login-form">
         <h3>Login</h3>
         <span class="close-box"><i class="fa fa-times"></i></span>
         <form class="" action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
              <input type="email" name="loginmail" value="" class="form-control" placeholder="Email">
              <input type="password" name="loginpassword" value="" class="form-control" placeholder="Password">
            <span class="signup">Don't have an account? <span class="link1">signup</span></span>
            <button type="submit" name="login" class="login-btn">Login</button>
         </form>
      </div>
      <div class="signup-form active">
        <h3>Sign Up</h3>
        <span class="close-box"><i class="fa fa-times"></i></span>
        <form class="" action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
             <input type="text" name="username" value="" class="form-control" placeholder="Enter Username">
             <input type="email" name="email" value="" class="form-control" placeholder="Enter Email">
             <input type="password" name="pass" value="" class="form-control" placeholder="Enter Password">
             <input type="password" name="repass" value="" class="form-control" placeholder="Retype Password">
             <textarea name="address" class="form-control" placeholder="Address"></textarea>
           <span class="login">Already have an account? <span class="link2">login</span></span>
           <button type="submit" name="signup" class="signup-btn">Sign up</button>
        </form>
      </div>
   </div>
   <section class="features-section bg-light" id="features">
                <div class="container">

                    <div class="row justify-content-center m-4">
                        <div class="col-lg-7">
                            <div class="content-title" style="text-align: center;">
                                <h1 class="title">Features</h1>
                                <h3 class="subtitle">Best Quality and Performance All Over The Time</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 d-flex">
                            <div class="features-item col-lg-12">
                              <span class="details">Details</span>
                                <div class="product-img">
                                  <img src="mac1.png" alt="">
                                </div>
                                <h3>MacBook Air</h3>
                                <p><span class="old-price">$1100</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$999</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex">
                             <div class="features-item col-lg-12">
                               <span class="details">Details</span>
                               <div class="product-img">
                                 <img src="mac2.png" alt="">
                               </div>
                                <h3>MacBook Pro 13</h3>
                                <p><span class="old-price">$1500</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$1399</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex">
                            <div class="features-item col-lg-12">
                              <span class="details">Details</span>
                              <div class="product-img">
                                <img src="mac3.png" alt="">
                              </div>
                                <h3>MacBook Pro 16</h3>
                                <p><span class="old-price">$2500</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$2399</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex">
                            <div class="features-item col-lg-12">
                              <span class="details">Details</span>
                              <div class="product-img">
                                <img src="iphone1.png" alt="">
                              </div>
                                <h3>iPhone 12</h3>
                                <p><span class="old-price">$710</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$699</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex">
                            <div class="features-item col-lg-12">
                              <span class="details">Details</span>
                              <div class="product-img">
                                <img src="iphone3.png" alt="">
                              </div>
                                <h3>iPhone 12 Pro</h3>
                                <p><span class="old-price">$1200</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$999</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex">
                             <div class="features-item col-lg-12">
                               <span class="details">Details</span>
                               <div class="product-img">
                                 <img src="iphone2.png" alt="">
                               </div>
                                <h3>iPhone 12 Mini</h3>
                                <p><span class="old-price">$610</span>
                                    <span class="arrow"><img src="arrow.png" alt=""></span>
                                   <span class="new-price">$599</span>
                                </p>
                                <form class="" action="index.html" method="post">
                                    <button class="addcart" type="button" name="button">Add Cart</button>
                                </form>
                        </div>
                        </div>
                    </div>
                </div>
             </section>
        <section class="footer">

              <h6>&copy; 2020 All rights reserved</h6>

        </section>
      <script src="shop.js">

      </script>
</body>

</html>
