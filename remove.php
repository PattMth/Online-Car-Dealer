<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $id = $_GET['id'];
    session_start();
    if(isset($_SESSION['cart'])){
      unset($_SESSION['cart'][$id]);
    };
    header("location: carReservation.php");
    ?>

  </body>
</html>
