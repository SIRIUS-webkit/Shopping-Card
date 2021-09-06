<?php
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
               <a href="index.php"><span class="menu-home">Home</span></a>
               <span class="usrname"><?php echo $_SESSION["name"]; ?> </span>
               <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
                 <button class="log-btn" type="submit" name="logout"><span class="menu-logout" name="logout">Logout</span></button>
               </form>
             </div>
         </div>
     </div>
   </header>

</body>

</html>
