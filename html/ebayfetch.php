<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="Affordable and professional web design">
  <meta name="keywords" content="web design, affordable web design, professional web design">
  <meta name="author" content="Brad Traversy">
  <title>Drewp | Stories</title>
  <link rel="stylesheet" href="./css/style.css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<?php 
  session_start();
  #include 'driverheader.php';
?>
  <center>
    <form method="post">
      <input type="text" name="query">
      <button type="submit" name="querysubmit" value="submit">Search</button>
    </form>
  </center>

<?php

if(isset($_POST['querysubmit'])){

  // error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging
  // API request variables
  $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call

  $version = '1.0.0';  // API version supported by your application
  $appid = 'Mitchell-website-PRD-6c5e133b9-56992c84';

  //Mitchell-website-PRD-6c5e133b9-56992c84
  //raghusin-ebaycurv-PRD-59f29112f-6ad6655b

  $globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)

  $query = $_POST['query'];// You may want to supply your own query
  $pgn='Pagination.PageNumber';
  
  $safequery = urlencode($query);  // Make the query URL-friendly
  $i = '0';  // Initialize the item filter index to 0

  // Create a PHP array of the item filters you want to use in your request
  $filterarray =
    array(
      array(
      'name' => 'MaxPrice',
      'value' => '25',
      'paramName' => 'Currency',
      'paramValue' => 'USD'),
      
      array(
      'name' => 'FreeShippingOnly',
      'value' => 'true',
      'paramName' => '',
      'paramValue' => ''),
      
      array(
      'name' => 'ListingType',
      'value' => array('AuctionWithBIN','FixedPrice','StoreInventory'),
      'paramName' => '',
      'paramValue' => ''),
    );

  // Generates an indexed URL snippet from the array of item filters
  function buildURLArray ($filterarray) {
    global $urlfilter;
    global $i;
    // Iterate through each filter in the array
    foreach($filterarray as $itemfilter) {
      // Iterate through each key in the filter
      foreach ($itemfilter as $key =>$value) {
        if(is_array($value)) {
          foreach($value as $j => $content) { // Index the key for each value
            $urlfilter .= "&itemFilter($i).$key($j)=$content";
          }
        }
        else {
          if($value != "") {
            $urlfilter .= "&itemFilter($i).$key=$value";
          }
        }
      }
      $i++;
    }
    return "$urlfilter";
  } // End of buildURLArray function
  $start = time();
  // Build the indexed item filter URL snippet
  buildURLArray($filterarray);

   if (isset($_GET["xx"])) {
    $xx=$_GET["xx"];

  }else{  
      $xx= '2';
  }
   echo "<input type='hidden' value='$xx' id='pgno'>";
  // Construct the findItemsByKeywords HTTP GET call 
  $apicall = "$endpoint?";
  $apicall .= "OPERATION-NAME=findItemsByKeywords";
  $apicall .= "&SERVICE-VERSION=$version";
  $apicall .= "&SECURITY-APPNAME=$appid";
  $apicall .= "&GLOBAL-ID=$globalid";

  $apicall .= "&keywords=$safequery";
  $apicall .= "&paginationInput.entriesPerPage=50";
  $apicall .= "&paginationInput.pageNumber=".$xx;
  $apicall .= "$urlfilter";
  // Load the call and capture the document returned by eBay API
  $resp = simplexml_load_file($apicall);
  // echo "<pre> ";
  // echo buildURLArray($filterarray);
  // echo $resp;
  // print_r($resp);
   // echo "</pre>";

  // Check to see if the request was successful, else print an error
  if ($resp->ack == "Success") {
    
    $results = '';
    // If the response was loaded, parse it and build links  
    // echo "<pre>";
    // print_r($resp->searchResult->item);

    // echo "</pre>";
    foreach($resp->searchResult->item as $item) {
  // echo $resp->itemSearchURL;
    $end = time();
      $pic   = $item->galleryURL;
      $link  = $item->viewItemURL;
      $title = $item->title;
      $subtitle = $item->subtitle;
      $paymentMethod = $item->paymentMethod;
      
  // echo "<pre>";
  // print_r($resp);
  // echo "</pre>";

      foreach ($resp->searchResult->item->sellingStatus as $value) { // Access that Arry from FOreach Loop 
            $price = $item->sellingStatus->currentPrice;
      }
      $button = '<form method="post">
        <input type="hidden" name="link" value="'.$link.'">
        <input type="hidden" name="pic" value="'.$pic.'">
        <input type="hidden" name="price" value="'.$price.'">
        <input type="hidden" name="title" value="'.$title.'">
        <input type="hidden" name="subtitle" value="'.$subtitle.'">
        <button type="submit" name="submit" value="submit">Add to Catalog
        </button>
      </form></li></ul>';
      foreach ($resp->paginationOutput as $value) {
        $Pageno = $resp->paginationOutput->pageNumber;
        $totalEntries = $resp->paginationOutput->totalEntries;

        $totalPage = $resp->paginationOutput->totalPages;
      }
    
      /*$results .= "<div class='col-md-12' style='border-left:4px solid black; border-bottom: 1px solid #bcc; margin-top:2%;'><div class='col-md-3'><center><img src=\"$pic\" style='max-width: 100%;margin:1%;'></center></div><div class='col-md-9' ><h2> <a href='$link\' target='blank'>$title</a></h2><h5> $subtitle </h5> <h3>Price $$price  </h3><p align='right'>$paymentMethod</p></div></div>";
      */
      $results .= "<ul style='float:left; text-align: center;' id='stories'>";
      $results .= "<li><h3 class='page-title'><a href='$link\' target='blank'>$title</a></h3><img src=\"$pic\" style='max-width: 100%;margin:1%;'><h3>Price $$price  </h3>";
      
      if($_SESSION['user_type'] == "sponsor") $results .= $button;

    }
  }
}
// If the response does not indicate 'Success,' print an error
else if(isset($_POST['querysubmit'])){
  $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
  $results .= "AppID for the Production environment.</h3>";
}
?>
<!-- Build the HTML page with values from the call response -->

<DIV class="col-md-8 col-md-offset-3">
    <?php if(isset($results)) echo $results;?>
    <div class="clearfix"></div>
</DIV>

<?php 

  /*if(isset($_POST['submit'])){
    echo "INSERT INTO products (sponsor_id, title, subtitle, pic, link, price) VALUES (".$_SESSION['user_id'].",'".$_POST['title']."','".$_POST['subtitle']."','".$_POST['pic']."','".$_POST['link']."','".$_POST['price']."');";
    unset($_POST['submit']);
  }*/

  if(isset($_POST["submit"])){
    $endpoint2 = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
    $conn = mysqli_connect($endpoint2, "master", "group4910", "website");
    
    $sql = "INSERT INTO products (sponsor_id, title, subtitle, pic, link, price) VALUES (".$_SESSION['user_id'].",'".$_POST['title']."','".$_POST['subtitle']."','".$_POST['pic']."','".$_POST['link']."','".$_POST['price']."');";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      echo "Failed to add to sponsors products in catalog!";
    }
    unset($_POST['submit']);
  }
  
?>
