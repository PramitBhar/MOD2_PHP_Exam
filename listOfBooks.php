<?php

include 'ConnectionDb.php';
//Create new obj.
$connectDb = new ConnectionDb();
//Connect to the database.
$connectDb->connection();
// Fetch all the book details from the user.
$listOfBook = $connectDb->fetchingBookData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
<?php foreach ($listOfBook as $book) : ?>
  <div class="card">
    <div class="card-photo">
      <img src="" class="card-img-top">
    </div>
    <div class="card-body" data-id="<?= $book['bookId'] ?>">
      <h5 class="card-title"> <?= $book['bookTitle'] ?> </h5>
      <p class="card-text"> Description : <?= $book['description'] ?> </p>
      <p class="card-text"> Author : <?= $book['authorName'] ?> </p>
      <p class="card-text"> Cost : <?= $book['cost'] ?></p>
    </div>
  </div>
<?php endforeach; ?>
</body>
</html>
