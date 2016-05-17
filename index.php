




<!DOCTYPE html>
<html lang="en"  > <!--manifest="manifest.appcache" -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ABC Toys</title>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyCe600EZn281Jab1zrPzlq5AsbzljO_CeI&v=3.9&sensor=true"> </script>
  <link rel="stylesheet" href="mobile.css" />
  <link rel="stylesheet" href="styles.css">
  <style type="text/css">
    .container {
    margin: 0 auto;
    width: 920px;
    padding: 50px 20px;
    background-color: #fff;
}



#map {
    margin-top: 10px;
    margin-left: 10px;
    min-width: 150px;
    min-height: 400px;
    width: 60%;
    height: 100%;

   
    

}

#panel {
  
  min-height: 200px;
  min-width: 100px;
  width: 60%;
  height: 100%;
  margin-left: 20px;
  float: left;

}
  </style> 

<!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script src="jquery-2.1.4.min.js"></script>
<script src="mobile.js"></script>
<script src="noConnection.js"></script>



 <?PHP
 require_once("Mobile_Detect.php");
 $detect = new Mobile_Detect;
 if (!$detect->isMobile()) {

   $x = rand(0, 5);
   $terms = ["0" => "barbie",
             "1" => "my little ponies",
             "2" => "dinosaurs",
             "3" => "thunder cats",
             "4" => "mermaids",
             "5" => "Disney"
    ];

   // Your AWS Access Key ID, as taken from the AWS Your Account page
   $aws_access_key_id = "AKIAJY6YFA6IPQS5JWUQ";

   // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
   $aws_secret_key = "9t4nlZ4dDEFHrPQEHYkmyBWbkv65ovYFPrVxjd1Q";

   // The region you are interested in
   $endpoint = "webservices.amazon.com";

   $uri = "/onca/xml";

   $params = array(
       "Service" => "AWSECommerceService",
       "Operation" => "ItemSearch",
       "AWSAccessKeyId" => "AKIAJY6YFA6IPQS5JWUQ",
       "AssociateTag" => "myt06fd-20",
       "SearchIndex" => "Toys",
       "Keywords" => $terms[$x],
       "ResponseGroup" => "Images,ItemAttributes,Offers",
       "Sort" => "price"
   );

   // Set current timestamp if not set
   if (!isset($params["Timestamp"])) {
       $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
   }

   // Sort the parameters by key
   ksort($params);

   $pairs = array();

   foreach ($params as $key => $value) {
       array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
   }

   // Generate the canonical query
   $canonical_query_string = join("&", $pairs);

   // Generate the string to be signed
   $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

   // Generate the signature required by the Product Advertising API
   $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

   // Generate the signed URL
   $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

   $data = simplexml_load_file($request_url);




   $items = $data->Items->Item;

   $currentItemURL = $item->DetailPageURL;
   $itemImage = $item->MediumImage->URL;
 }
 ?>

</head>
<body>

<section id="page1" data-role="page"> <!-- begin page one -->

<header data-role="header" data-position="fixed">
<div id="nav1a" data-id="navbar">

    <div data-role="controlgroup" data-type="horizontal">
    <a href="#page1" data-role="button">Home</a>
    <a href="#page2" data-role="button">Products</a>
    <a href="#page3" data-role="button">Location</a>
    <a href="#page4" data-role="button">Contact Us</a>
  </div>

</div>
</header>
<div id="content1" class="content" data-id="content">

<h1>ABC Toys</h1>
<h3>Making learning fun</h3>
<p>ABC Toys is a company that opened its doors in 2001 and it has kept its mission for all those years.</p>
<p>The mission of our company is to create toys that are safe for kindergarten kids but that challenge the kids' mind and motor skills making learning a fun task.</p>
<p>By the way, parents love our toys too</p>
</div>

<footer data-role="footer" data-position="fixed">
 <p>Welcome to ABC Toys!</p> 
</footer>  
</section>  <!-- end page one -->

<section id="page2" data-role="page"> <!-- begin page two -->

<header id="header2" data-id="header" data-role="header" data-position="fixed">

  <div id="nav2a" data-id="navbar">
    <div data-role="controlgroup" data-type="horizontal">
    <a href="#page1" data-role="button">Home</a>
    <a href="#page2" data-role="button">Products</a>
    <a href="#page3" data-role="button">Location</a>
    <a href="#page4" data-role="button">Contact Us</a>
  </div>

  </div>
</header>
<div id="content2" class="content" data-id="content">
<h1>Products</h1>
<div id="noConnection"></div>
<div data-role="collapsible" id="collapseMain">
<h3>Toy Search</h3>
<form method="post" action="form.php" id="toys1" name="toys1" target="myFrame">
<fieldset data-role="fieldcontain">
<label for="toys" class="ui-hidden-accessible">Toy Search</label>
<input type="text" id="toys" name="toys" required><br>
<input type="submit" value="search" name="search1" class="submit" id="search1">
</fieldset>
</form>
<div id="results">
<iframe name="myFrame" id="myFrame" class="hidden" width="175" height="300"></iframe>
</div>
</div>

<span id="span1">

<?PHP

if (!$detect->isMobile()) {

$item1URL   = $items[0]->DetailPageURL;
$item1Image = $items[0]->MediumImage->URL;
echo "<a href='$item1URL' id='img1' target='_blank'><img src='$item1Image' alt='random toy'></a>";

$item2URL = $items[1]->DetailPageURL;
$item2Image = $items[1]->MediumImage->URL;
echo "<a href='$item2URL' id='img2' target='_blank'><img src='$item2Image' alt='random toy'></a>";



$item3URL = $items[2]->DetailPageURL;
$item3Image = $items[2]->MediumImage->URL;
echo "<a href='$item3URL' id='img3' target='blank'><img src='$item3Image' alt='random toy'></a>";
}


?>


</span>


</div>





<footer data-role="footer" data-position="fixed">
 <p>Welcome to ABC Toys!</p> 
</footer>  


</section> <!-- end page two -->

<section id="page3" data-role="page"> <!-- begin page three -->
<header id="header3" data-id="header" data-role="header" data-position="fixed">
<div id="nav3a" data-id="navbar">
  <div data-role="controlgroup" data-type="horizontal">
  <a href="#page1" data-role="button">Home</a>
  <a href="#page2" data-role="button">Products</a>
  <a href="#page3" data-role="button">Location</a>
  <a href="#page4" data-role="button">Contact Us</a>
</div>

</div>
</header>

<div id="content3" class="content .container" data-id="content">
<h1>Directions</h1>
<div id="location"></div>
<div id="myButton">
<input type="button" value="View Map" id="viewMap">
</div>  

<div id="map" class="map"></div>
<div id="panel"></div>

<script type="text/javascript">
 window.getLocation;

// $('#page3').on('pagebeforeshow',function(event, ui){
window.onload = getLocation;
// });
/*
Here we will check the browser supports the Geolocation API; if exists, then we will display the location
*/
var geo = navigator.geolocation;
function getLocation() {
if( geo ) {
geo.getCurrentPosition( displayLocation );
} else {
alert( "Oops, Geolocation API is not supported" );
}

} // end getLocation

/*
This function displays the latitude and longitude when the browser has a location.
*/

function displayLocation( position ) {
var latitude = position.coords.latitude;
var longitude = position.coords.longitude;

var div = document.getElementById( 'location' );
div.innerHTML = "You are at Latitude: " + latitude + ", Longitude: " + longitude;

// Call showMap function once we've updated other div's on the page
displayMap( position.coords);
} // end displayLocation

// Global Variable that will hold Google Map
var map;
var directionsService;
var directionsDisplay;
var panelStatus = false;
/*
This method is used to display Google Map.
*/
function displayMap(coords) {
  var googleLatAndLong = new google.maps.LatLng({lat: 55.567, lng: 6.234});

  var mapOptions = {
  zoom: 14,
  center: googleLatAndLong,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  var mapDiv = document.getElementById( 'map' );
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  map = new google.maps.Map( mapDiv, mapOptions );
  position = new google.maps.LatLng({lat: coords.latitude, lng: coords.longitude});

  var title = 'Directions to Our Store';
  var content = 'You are here: ' + coords.latitude + ', ' + coords.longitude;


  directionsDisplay.setMap(map);


  if (!panelStatus) {
    directionsDisplay.setPanel(document.getElementById('panel'));
  }
  panelStatus = true;
  directionsService.route({
            origin: position,
            destination: "2270 Bridgepointe Pkwy, San Mateo, CA",
            travelMode: google.maps.TravelMode.DRIVING
          }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }

});
} // end displayMap

$("#viewMap").click(getLocation);  
</script>
</div>


<footer data-role="footer" data-position="fixed">
 <p>Welcome to ABC Toys!</p> 
</footer>  
</section> <!-- end page three -->

<section id="page4" data-role="page"> <!-- begin page four -->
<header id="header4" data-id="header" data-role="header" data-position="fixed">
<div id="nav4a" data-id="navbar">
  <div data-role="controlgroup" data-type="horizontal">
  <a href="#page1" data-role="button">Home</a>
  <a href="#page2" data-role="button">Products</a>
  <a href="#page3" data-role="button">Location</a>
  <a href="#page4" data-role="button">Contact Us</a>
</div>

</div>
</header>

<div id="content4" class="content" data-id="content" data-theme="b">

<h1>Contact Us</h1>
<div id="ourEmail">
  <span><b>Email:</b> toys@toys.com</span>
</div>
<div id="ourFacebook">
  <span><b>Facebook:</b> facebook.com/toys</span>
</div>
<div id="ourTelephone">
  <span><b>Telephone:</b> 444-666-7777</span>
</div>
<br>
<br>
<form method="post" action="#" id="myForm" name="myForm">
<fieldset data-role="fieldcontain">

<div>
<span id="myFirstName"><label for="firstName">First Name</label></span>
<input type="text" id="firstName" name="firstName" required>
</div>

<div>
<label for="lastName">Last Name</label>
<input type="text" id="lastName" name="lastName">
</div>

<div>
<span id="myEmail"><label   for="email">Email:</label></span>
<input type="email" id="email" name="email" required>
</div>

<div>
<label for="textArea">Comments</label>
<textarea rows="10" id="textArea" name="textArea" required>
</textarea>
</div>

<input type="submit" value="Submit" id="submit" name="submit">
</fieldset>
</form>
</div>
<footer data-role="footer" data-position="fixed">
 <p>Welcome to ABC Toys!</p> 
</footer>  
</section>  <!-- end page four -->

<script src="toys.js"></script>
</body>
</html>
