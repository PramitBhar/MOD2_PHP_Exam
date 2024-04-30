<?php

include 'ConnectionDb.php';
/**
  * This class is used to validate user input.
  *
  * @param type: string
  *
  * @return type: object
*/
class Book {
  // This variable indicates the title of the user.
  public string $title;
  // This variable indicates the author name of the user.
  public string $authorName;
  // This varibale indicates the cost of the book.
  public string $cost;
  // This varibale indicates the description of the book.
  public string $bookDesc;
  // This varibale indicates the image of the book.
  public string $bookImg;
  // This varibale indicates the unique id of the book.
  public string $bookId;
  // This variable indicated the connection of the database;
  /**
    * This constuctor class initialize the fname and lname variable.
    *
    * @param type: string
  */
  public function __construct(
      string $title,
      string $authorName,
      string $cost,
      string $bookDesc,
      string $bookImg
  ) {
    $this->title = $title;
    $this->authorName = $authorName;
    $this->cost = $cost;
    $this->bookDesc = $bookDesc;
    $this->bookImg = $bookImg;
  }

  public function storeBookData() {
    try {
      $connectDb = new ConnectionDb();
      $connectDb->connection();
      $bookId = uniqid();
      $sql = "INSERT INTO book_info (bookId, bookTitle, imgUrl, description, cost, authorName) VALUES ('$bookId', '$this->title', '$this->bookImg', '$this->bookDesc', '$this->cost', '$this->authorName')";
      $stmt = $connectDb->insertData($sql);
      // Execute the statement and check for errors
    }
    catch (Exception $e) {
      echo "Book Data Insertion Failed.";
    }
  }

  /**
    * This function is used to validate user input using regex
    *
    * @param type: no parameter is passed
    *
    * @return type: string
  */
  public function validateUserInput() {
    // This pattern is used to check given input is valid or not.
    $pattern = "/^[A-Za-z]+$/";
    // Below condition is used to check if both the input field is correct.
    if (preg_match($pattern, $this->title) &&
      preg_match($pattern, $this->lname)) {
      $fullName = $this->fname . " " . $this->lname;
      return $fullName;
    }
    // Below condition is used to check if both the input field is wrong or not.
    elseif(
      !preg_match($pattern, $this->fname) &&
      !preg_match($pattern, $this->lname)) {
        return "";
    }
    // Below condition is used to check if first name input field is wrong or not.
    elseif (!preg_match($pattern, $this->fname)) {
      return $this->fname;
    }
    //Below condition is used to check if last name input field is wrong or not.
    elseif (!preg_match($pattern, $this->lname)) {
      return $this->lname;
    }
  }
  /**
    * This function is used to validate image.
    *
    * @param type: no params is pass.
    *
    * @return type: string
  */
  public function isUploadedImageValidate() : string {
    // if (isset($_FILES["image"])) {
    //   $uploadedImgDir = "user_uploaded_image/";
    //   $targetFile = $uploadedImgDir .
    //   basename($_FILES["image"]["name"]);
    // }
    // return $targetFile;
    $targetFile = ""; // Initialize the variable

    if (isset($_FILES["image"])) {
        $uploadedImgDir = "user_uploaded_image/";
        $targetFile = $uploadedImgDir . basename($_FILES["image"]["name"]);
    }

    return $targetFile;
  }
}
?>
