<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hertz-UTS</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
  </head>
  <body>
    <div >
           <table class="header" width="100%">
               <tr>
                   <td width="20%" align="left">
                       <a class="hertz" href="index.php"><h2 >Hertz-UTS</h2></a>
                   </td>
                   <td width="60%" align="center">
                       <h1 style="color: black;font-size:30px;">Car Rental Center</h1>
                   </td>
                   <td width="15%" align="center">
                       <button class="carReservation" type="button" class="reserve" onclick="window.location.href='carReservation.php'">Car Reservation</button>
                   </td>
               </tr>
           </table>
       </div>
       <div id="carsTable" style="margin-right: auto; margin-left: 6%; margin-top: 1%;"></div>
    <script>

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            list_cars(this);
        }
    };
    xmlhttp.open("GET","cars.xml",true);
    xmlhttp.send();

    function list_cars(xml){
    	//array of cars in the xml file
      var xmlDoc = xml.responseXML;
    	// var allCars =xmlDoc.getElementsByTagName("brand")[0].childNodes[0].nodeValue;
      var cars = xmlDoc.getElementsByTagName("carwarehouse")[0].children;

    	var carsTableStr = "";
      var fields = new Array("id","availability","brand","model","modelyear","mileage","fueltype","seats","price","desc");
      for (var i=0; i<cars.length; i++){
          var car = cars[i];
          var car_detail_items = car.children;
          var car_details = new Array(10);
          for(var j=0;j<car_details.length;j++){
              if(car_detail_items[j].nodeName===fields[j]){
                  car_details[j] = car_detail_items[j].childNodes[0].nodeValue;
              }else{
                  alert("Details not valid.");
                  continue;
              }
          }
          carsTableStr += "<div class='box' style='width:400px; height:630px; float:left; display:inline; margin:10px;'>";
          carsTableStr += "  <img class='card-img-top' src='images/" + car_details[3] + ".jpg' alt='Card image' style='width:100%;height:280px;'>";
          carsTableStr += "  <div class='boxin'>";
          carsTableStr += "<h2 class='title'>" + car_details[2] + "-" + car_details[3] + "-" + car_details[4] + "</h2>";
          carsTableStr += "<p class='text'>";
          carsTableStr += "<p>Mileage: " + car_details[5] + " KMs</p>";
          carsTableStr += "<p>Fuel type: " +  car_details[6] + "</p>";
          carsTableStr += "<p>Seats:" +  car_details[7] + "</p>";
          carsTableStr += "<p>Price per Day: " +  car_details[8] + "</p>";
          carsTableStr += "<p>Availability: " +  car_details[1] + "</p>";
          carsTableStr += "<p class='line-limit-length'><b class='desc'>description: </b>" +  car_details[9] + "</p>";
          carsTableStr += "<button class='add' type='add' onclick='check_available("+car_details[0]+")'>Add to cart</button>";
          carsTableStr += "</div>";
          carsTableStr += "</div>";
      }
    	document.getElementById("carsTable").innerHTML = carsTableStr;
    }
          function check_available(id){
            var xmlhttp = new XMLHttpRequest();
            // xmlhttp.open("GET", "cart.php?id="+id, true);
            xmlhttp.open("GET", "carts.php?id="+id, true);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                       var available = this.responseText;
                       if(available == "True"){
                          alert("Add to the cart successfully.");


                      }else{
                          //alert(available)
                           alert("Sorry, the car is not available now. Please try other cars.");
                      }
                    }
                }
                xmlhttp.send();

          }
        </script>
  </body>
</html>
