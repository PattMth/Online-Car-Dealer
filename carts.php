<?php
$id = $_GET["id"];

session_start();

$xml = simplexml_load_file("cars.xml") or die("Error: Cannot create Object");
$xmls = $xml->children();


for ($i = 0; $i < count($xmls); $i++) {

  $a = array();
  foreach ($xmls[$i]->children() as $cars) {
    array_push($a, $cars);
  }

  if ($a[0] == $id){
    $car_detail = array(
      "id" => (int)$a[0],
      "Availability" =>(string)$a[1],
      "Brand" => (string) $a[2],
      "Model" => (string) $a[3],
      "ModelYear" => (string) $a[4],
      "Mileage" => (string) $a[5],
      "FuelType" => (string) $a[6],
      "Seats" => (string) $a[7],
      "PricePerDay" => (int) $a[8],
      "RentalDay" => 1
    );

    if($car_detail['Availability'] == 'True')
    {
      if (!isset($_SESSION["cart"])) {
          $_SESSION["cart"] = array($id => $car_detail);
      } else if (!isset($_SESSION["cart"][$a[0]])) {
          $_SESSION["cart"][$id] = $car_detail;
      }
    }
    
    echo $car_detail['Availability'];
    return;
  }
};


?>
