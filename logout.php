<?php
  session_start();
  unset($_SESSION["password"]);
  unset($_SESSION["username"]);
  $_SESSION["name"] = " ";
  if(isset($_POST["logout"])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Private</title>
  <style>
  *{
    padding: 0;
    margin: 0;
  }
    .contianer{
      width: 100%;
      height: 100vh;
      background-color: #c4c4c4;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }
    h1{
      font-size: 200px;
      text-align: center;
      font-family: Verdana;
      font-weight: 700;
      color: #f5f5f5;
      text-transform: uppercase;
      text-shadow: 1px 1px 1px #919191,
                  1px 2px 1px #919191,
                  1px 3px 1px #919191,
                  1px 4px 1px #919191,
                  1px 5px 1px #919191,
                  1px 6px 1px #919191,
                  1px 7px 1px #919191,
                  1px 8px 1px #919191,
                  1px 9px 1px #919191,
                  1px 10px 1px #919191;
    }
    .logout{
      position: absolute;
      top: 40px;
      right: 80px;
      width: 100px;
      height: 30px;
      border: none;
      outline: none;
      background-color: red;
      border-radius: 5px;
      font-size: 18px;
      color: #fff;
      cursor: pointer;
    }
  </style>
</head>
<body>
   <div class="contianer">
      <h1>Welcome</h1>
   </div>
   <form class="" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
     <button type="submit" name="logout" class="logout">Logout</button>
   </form>
</body>
</html>
