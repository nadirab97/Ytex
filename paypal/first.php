<?php
session_start();

// initializing variables
$ordernumber="";
$name = "";
$lastname = "";
$email    = "";
$phone    = "";
$city= "";
$street = "";
$postcode = "";

// connect to the database
$db = mysqli_connect('localhost', 'salimma', 'nsz123456789', 'salimma_Customers');

  	if (isset($_POST['det'])) {
  $ordernumber=mysqli_real_escape_string($db, $_POST['ordernumber']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $lastname=mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $street=mysqli_real_escape_string($db, $_POST['street']);
  $postcode=mysqli_real_escape_string($db, $_POST['postcode']);
 

$sql = "INSERT INTO Delivery (ordernumber, name, lastname, email, phone, city, street, postcode) VALUES
('$ordernumber', '$name', '$lastname', '$email', '$phone', '$city', '$street', '$postcode')";

mysqli_query($db, $sql);
}

?>


<?php
require __DIR__  . '/vendor/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AbB4qaRoamZNEOHsnKNMReT3HsvV2RXLGEHe2QSr2eXy8z-bAmKwntY3xmavceWA4bIU_0idgCy_N-pc',     // ClientID
        'EIKvR28LmXDz6pMaqWuY75206FUsFUbu5rvwAvfywiKARjIbw0lVZ-bB0TBhNmfGWdEwBSJpxEMfLEGz'      // ClientSecret
    )
);

if(!isset($_POST['price'])){
    die();  
}


$price = $_POST['price'];
$shipping = 0;
$total = $price+$shipping;

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$item = new \PayPal\Api\Item();
$item->setCurrency('ILS')
    ->setQuantity(1)
    ->setPrice($price);

$itemList = new \PayPal\Api\ItemList();
$itemList-> setItems([$item]);

$details = new \PayPal\Api\Details();
$details->setShipping($shipping)
    ->setSubtotal($price);

$amount = new \PayPal\Api\Amount();
$amount->setCurrency('ILS')
    ->setTotal($total)
    ->setDetails($details);


$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription('payment')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://salimma.mtacloud.co.il/Q/paypal/pay.php?approved=true")
->setCancelUrl("http://salimma.mtacloud.co.il/Q/paypal/pay.php?approved=false");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    echo $payment;
    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getData();
}

$approvalUrl = $payment->getApprovalLink();

header("Location: {$approvalUrl}");