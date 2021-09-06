<?php
  session_start();

  if(!isset($_SESSION["username"])){
    header("Location:index.php");
  }

  define("DB_NAME","shopcart");
  define("DB_HOST","localhost");
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
  $username = $_SESSION["name"];
  $email = $_SESSION["username"];


   if(isset($_POST["preorder"])){
        $productlist = $_POST["txt"];

    $query = "INSERT INTO cart (username,email,productlist) VALUES ('${username}','${email}','${productlist}');";
    function singledatainsert($qry){
      $database = dbconnection();
       $results = mysqli_query($database,$qry);
       // echo "<pre>".print_r($database,true)."</pre>";
         if(mysqli_insert_id($database) > 0){
            $err2 = "Your Account is sucessfully created";
        }else{
         echo "Insert Failed";
       }
    }
      singledatainsert($query);
  }
    require_once "main.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <title>Cart</title>
</head>

<body style="background-color: #D4EFDF;">
   <!-- <div>
     <a class="homelink" href="index.php">Home</a>
   </div> -->
  <div class="preorder-box active">
    <div class="text-pre">
      <span class="close-box-cart"><i class="fa fa-times"></i></span>
      <h3>Thanks for Ordering</h3>
    </div>
  </div>

 <section class="menu-product-container">
  <div class="product-container">
      <div class="product-title">
        <h5>Product</h5>
        <h5>Price</h5>
        <h5>Quantity</h5>
        <h5>Total</h5>
      </div>
  </div>
</section>
  <div class="products">

  </div>
  <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
    <textarea name = "txt" class="txt" id="txt-area"></textarea>
     <button  type = "submit" name="preorder" class='preorder'>preorder</button>
  </form>
  <script src="cart.js">

  </script>

</body>
</html>
