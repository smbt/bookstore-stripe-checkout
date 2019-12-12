<?php

//require('../../payments/stripe-php-master/init.php');
require('stripe-php-master/init.php');
include 'books.php';

$bookId = $_GET['bookId'];
$count = $_GET['count'];

if($count < $books[$bookId]['stock']) {
    // Shop
    \Stripe\Stripe::setApiKey('sk_test_cKTdsg6dgKZU35CEen7nhPSo00tpg3mtQ8');
} else {
    // Großhändler
    echo 'Nicht genügend auf Lager. Bestellung beim Großhändler.';
    exit();
//    \Stripe\Stripe::setApiKey('sk_test_cKTdsg6dgKZU35CEen7nhPSo00tpg3mtQ8');
}

unset($books[$bookId]['stock']);

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [$books[$bookId]],
        'success_url' => 'http://localhost/bookstore-stripe-checkout/' . 'success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/bookstore-stripe-checkout/' . 'cancel.php',
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error in Session::create()";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<h1>Bookstore</h1>

Sie werden zum Stripe-Checkout weitergeleitet....

<script>
    var stripe = Stripe('pk_test_j453Pz4LA81q2iapWd7ToXQC00P5329pC1');
    stripe.redirectToCheckout({
        sessionId: '<?php echo $session['id']; ?>'
    }).then(function (result) {
    });
</script>

</body>
</html>
