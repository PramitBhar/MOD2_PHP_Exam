<?php
$url = parse_url($_SERVER['REQUEST_URI']);
//It takes the url from the browser header.
$path = $url["path"];
//Takes the path of the url.
switch ($path) {

  case '/':
    require __DIR__ . '/login.php';
    //It redirect to the login page
    break;
  case '/register':
    require __DIR__ . '/register.php';
    //It redirect to the register page
    break;
  case '/admin':
    require __DIR__ . '/admin_login.php';
    //It redirect to the admin login page
    break;
  case '/book-entries':
    require __DIR__ . '/bookEntries.php';
    //It redirect to the entry of the book details page
    break;
  case '/listofbooks':
    //It redirect to the all the book display page
    require __DIR__ . '/listOfBooks.php';
    break;
}
