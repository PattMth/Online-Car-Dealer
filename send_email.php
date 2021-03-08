<html>
<head>
  <title>Thank you</title>
  <link rel="stylesheet" type="text/css" href="css/background.css">
  <style>
  body{
    position: fixed;
     top: 30%;
  }
  </style>
</head>
<body>
  <?php
  session_start();

  $headers = 'MIME-version: 1.0' . "\r\n";
  $headers .= 'Content-type : text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: Hertz-UTS<PattrickMatthew.Hartono-1@student.uts.edu.au>' ."\r\n";

  $to = $_POST['email'];
  $sub = "Order Details";

  $msg = "<html>
  <head>
  <title>Order details</title>
  </head>
  <body>
  <p>
  Your order details are:
  </p><br>";


  foreach ($_SESSION['cart'] as $value){

    $msg .=
        '<p>Brand: '.$value['Brand']."</p><p>Model: ".$value['Model']."</p><p>ModelYear: ".$value['ModelYear'].'</p>'.
        '<p>Mileage: '.$value['Mileage'].'</p>'.
        '<p>Fuel Type: '.$value['FuelType'].'</p>'.
        '<p>Seats: '.$value['Seats'].'</p>'.
        '<p>Price per Day: '.$value['PricePerDay'].'</p>'.
        '<p>Rental Day: '.$value["RentalDay"].'</p>'.
        '<p>Total Price: '.$value['PricePerDay'] * $value["RentalDay"] .'</p>'.
        '</tr></br>';

}

$msg .=  "<p> Thank you for purchasing at our store.</p>
  </body>
  </html>";

  if(mail($to,$sub,$msg,$headers))
   {
     echo("<center><h1 style='margin-left=40%'><b>Thanks for purchasing from our store!</b><br> The detail of your order will be emailed shortly.</h1></center>");
     session_destroy();
   }
 else{
     echo("<p>Email is not sent. Please try again.</p>");
   }
  ?>


</body>
</html>
