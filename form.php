<?php


$product_description = "";
$product_descriptionF = "";
$items = "";

if (isset($_POST['toys']) ) {

$product_description = $_POST['toys'];
$product_descriptionF = htmlspecialchars($product_description);

}




if (!empty($product_descriptionF) ) {





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
    "Keywords" => $product_descriptionF,
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

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Toy Search</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
</head>
<body id="body2">
<div data-role="content" id="toyStuff">
<div data-role="collapsibleset">
<h3>Toys</h3>

<?PHP
  $toyCounter = 1;
if (!empty($items) ) {

  foreach ($items as $item) {



    if (!empty($item->ItemAttributes->ListPrice->FormattedPrice) ) {
      $currentItemPrice = $item->ItemAttributes->ListPrice->FormattedPrice;
    } else {
      $currentItemPrice = "Not Available.";
    }
    $currentItemTitle = $item->ItemAttributes->Title;
    $currentItemURL = $item->DetailPageURL;

    $itemImage = $item->SmallImage->URL;
   echo "<div data-role='collapsible'>";
   echo "<h5 class='ui-btn ui-icon-info ui-btn-icon-left'>Toy $toyCounter<h5>";
   $toyCounter = $toyCounter + 1;
   echo "<p class='info'>" . "<b>Title: </b><a href='$currentItemURL' target='_blank'>$currentItemTitle</a>";
   echo "<br><b>Price: </b>" . $currentItemPrice;
   echo "</p>";
   echo "<img class='myImage' src='$itemImage' alt='toy'>";
   echo "</div>";
 }
 }
 }


?>
</div>
</div>
</body>
</html>
