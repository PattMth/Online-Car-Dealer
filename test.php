<!DOCTYPE html>
<html>
<body>

<p id="demo"></p>

<script>
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            list_cars(this);
        }
    };
    xhttp.open("GET", "cars.xml", true);
    xhttp.send();

    function list_cars(xml){
        var xmlDoc = xml.responseXML;
        var car_list_str = "";
        var cars = xmlDoc.getElementsByTagName("carwarehouse")[0].children;
        var fields = new Array("id","brand","model","model_year","mileage","fuel_type","seats","price_per_day","description","availability");
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
            car_list_str += "<div class=\"card\" style=\"width:400px; height:630px; float:left; display:inline; margin:10px;\">";
            car_list_str += "  <img class=\"card-img-top\" src=\"images/" + car_details[2] + ".jpg\" alt=\"Card image\" style=\"width:100%;height:280px;\">";
            car_list_str += "  <div class=\"card-body\">";
            car_list_str += "<h4 class=\"card-title\">" + car_details[1] + "-" + car_details[2] + "-" + car_details[3] + "</h4>";
            car_list_str += "<p class=\"card-text\">";
            car_list_str += "<b>mileage: </b>" + car_details[4] + " kms<br>";
            car_list_str += "<b>fuel_type: </b>" +  car_details[5] + "<br>";
            car_list_str += "<b>seats: </b>" +  car_details[6] + "<br>";
            car_list_str += "<b>price_per_day: </b>" +  car_details[7] + "<br>";
            car_list_str += "<b>availability: </b>" +  car_details[9] + "<br>";
            car_list_str += "<p class=\"line-limit-length\"><b>description: </b>" +  car_details[8] + "</p><br>";
            car_list_str += "<button type=\"button\" class=\"btn btn-primary\" onclick=\"check_avi("+car_details[0]+")\">Add to cart</button><br>";
            car_list_str += "</p>";
            car_list_str += "  </div>";
            car_list_str += "</div>";
        }
        document.getElementById("car_list").innerHTML = car_list_str;
    }

    function check_avi(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                 var available = this.responseText;
                 if(available == "True"){
                    alert("Add to the cart successfully.");
                }else{
                    alert("Sorry, the car is not available now. Please try other cars.");
                }
              }
          };
        xhttp.open("GET", "add_delete_session.php?action=add&id="+id, true);
        xhttp.send();
    }

</script>

</body>
</html>
