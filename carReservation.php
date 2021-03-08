<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/cart.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
  <script>
  function validatequantity(){
    var RentalDay = parseInt(document.querySelector('#RentalDay').value);
    if(RentalDay > 0){
        return true;
       }
       alert("please input a valid number");
       return false;
  }
  function checkout(ToCheckIt)
  {
      if (ToCheckIt == 0 || !(ToCheckIt))
      {
          window.alert("Your Shopping cart is empty, please select something!");
          return false;
      }
      else
      {
          return true;
      }
  }
  </script>
</head>
<body>
  <div>
         <table class="header" width="100%">
             <tr>
                 <td class="none" width="20%" align="left">
                     <a class="hertz" href="index.php"><h2 >Hertz-UTS</h2></a>
                 </td>
                 <td class="none" width="60%" align="center">
                     <h1 style="color: black;font-size:30px;">Shopping Cart</h1>
                 </td>
                 <td class="none" width="15%" align="center">
                     <button class="carReservation" type="button" class="reserve" onclick="window.location.href='carReservation.php'">Car Reservation</button>
                 </td>
             </tr>
         </table>
     </div>
   <form id="checkoutform" action="checkout.php" onsubmit="return validatequantity()"></form>

  <table class="cart">
  <tr>
    <td class="cart">Thumbnail</td>
    <td class="cart">Vehicle</td>
    <td class="cart">Price per Day</td>
    <td class="cart">Rental Days</td>
    <td class="cart">Action</td>
  </tr>

    <?php
    session_start();
    $total=0;
    foreach($_SESSION['cart'] as $value)
    {
      $content =  '<tr>'.
                  '<td class="cart"><img class="card-img-top" src="images/'.$value['Model'].'.jpg" style="width:150px;height:120px;"></td>'.
                  '<td class="cart">' .$value['Brand']. ' - '.$value['Model']. ' - ' .$value['ModelYear']. '</td>'.
                  '<td class="cart">$' .$value['PricePerDay']. '</td>'.
                  '<td class="cart"><input form="checkoutform" name="RentalDay[]"  id="RentalDay" type="number" value="'.$value["RentalDay"].'"></td>'.
                  '<td class="cart"><form id="deleteform" method="post" action="remove.php?id='.$value['id'].'"><button class="remove" type="submit" onclick="{if(confirm(\'Do you want to delete the selected item?\')){return true;}return false;}"> Remove </button></form></td>'
                  .'</tr>';
      echo $content;
    }

    ?>
</table>
<input form="checkoutform" type="submit"  class="checkOutButton" class = "btn btn-danger" value="checkout">
</body>
