<?php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
require('stripe-php-master/init.php');
include 'books.php';

$bookId = $_GET['bookId'];

if($_GET['live']) {
    \Stripe\Stripe::setApiKey('sk_test_cKTdsg6dgKZU35CEen7nhPSo00tpg3mtQ8');

} else {
    \Stripe\Stripe::setApiKey('sk_test_cKTdsg6dgKZU35CEen7nhPSo00tpg3mtQ8');
}

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [$books[$bookId]],
    'success_url' => 'http://localhost/bookstore-stripe-checkout/' . 'success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/bookstore-stripe-checkout/' . 'cancel.php',
]);

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
    var stripe = Stripe('pk_test_Vg7Edirr7vBo0LEVAJyemfSC003eRzoEu9');
    stripe.redirectToCheckout({
        sessionId: '<?php echo $session['id']; ?>'
    }).then(function (result) {
    });
</script>

</body>
</html>
