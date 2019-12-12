<?php
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
    echo "<h2>" . $book['name'] . "</h2>";
    echo "Menge: <input id='count-" . $i . "' value='1'><br>";
    echo "<button><a href='stripe_redirect.php?bookId=" . $i . "&count=1' book-id='" . $i . "' class='buy_button'>Buy now</a></button> <br>";
    echo "<hr>";
    $i++;
}
?>

<script>
    links = document.querySelectorAll('.buy_button');
    for (var i = 0; i < links.length; i++) {
        var link = links[i];
        var bookId = link.getAttribute('book-id');

        link.addEventListener('click', function () {
            var count = document.querySelector('#count-' + bookId).value;
            link.href = 'stripe_redirect.php?bookId=' + bookId + '&count=' + count;
            console.log(link);
        });

        console.log(bookId);
        console.log(count);
    }
</script>


</body>
</html>