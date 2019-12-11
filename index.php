<?php

require('stripe-php-master/init.php');
include 'books.php';

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

<hr>
<?php
$i = 0;
foreach ($books as $book) {
    echo "<h2>". $book['name'] . "</h2>";
    echo "<a href='stripe_redirect.php?live=0&bookId=".$i."'>Buy now</a> <br>";
    echo "<a href='stripe_redirect.php?live=1&bookId=".$i."'>Buy now (Abnahme)</a>";
    echo "<hr>";
    $i++;
	}
?>

</body>
</html>