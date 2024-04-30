<?php

include 'Book.php';
// Include the Book which consist of to insert book data and fetched book details.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // This variable takes the book title
  $fname = trim($_POST["fname"], " ");
  // This variable takes the book cost
  $cost = $_POST["cost"];
  // This variable takes the book cost
  $author = $_POST["author_name"];
  // This variable takes warning message.
  $warningMessage = "*Try to fill this field with Alphabet";
  //This variable takes the book description
  $bookDesc = trim($_POST["book_desc"], " ");
  // This variable takes the book imgUrl
  $bookImg = basename($_FILES["image"]["name"]);
  // New obj created.
  $user = new Book($fname, $author, $cost, $bookDesc, $bookImg);
  //Store the book details into the database.
  $user->storeBookData();
// This is used to validate user uploaded file is image or not.
/** @var string $image_validation */
  $image_validation = $user->isUploadedImageValidate();
  //It contains the file type of image.
  $imageFileType =
  strtolower(pathinfo($image_validation, PATHINFO_EXTENSION));
  // If image file type not matched then it shows error message.
  if (
    $imageFileType != "jpg" && $imageFileType != "png" &&
    $imageFileType != "jpeg"
  ) {
    $error_message = "Image file type doesn't match.";
  }
  // Otherwise it stores the image in a folder.
  else {
    move_uploaded_file($_FILES["image"]["tmp_name"], $image_validation);
  }
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <style>
    <?php include "bookEntries.css"; ?>
  </style>
</head>
<body>
  <!-- Container start. -->
  <div class="container">
    <div class="form-container">
      <!-- Form heading. -->
      <h1>Fill the Books Details which you want to upload</h1>
      <div class="form-contents">
        <!-- Form input fields.-->
        <form method="post" action="/book-entries"
        enctype="multipart/form-data">
          <span class="warning-message">
            <?php if ($error_message != "") echo $error_message; ?>
          </span>
          <!-- First name input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>Book Title:</label>
            <input type="text" class="form-input-fields"
            placeholder="First Name" value="<?php echo $fname ?>" name="fname"
            maxlength="35" required pattern="^[A-Za-z]+$"
            title="Fill this fields with alphabets only">
            <p class="warning-message">
              <?php echo $first_input_error_message ?>
            </p>
          </div>
          <!-- Upload Image input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>Upload Book image:</label>
              <input type="file" class="form-input-fields" name="image"
              accept="image/x-png , image/jpeg , image/jpg" required>
            </div>
            <!-- Book Description input field. -->
            <div class="form-fields">
              <label class="form-fields-heading">
                Books Description:
              </label>
              <input type="text" class="form-input-fields"
            placeholder="First Name" value="<?php echo $bookDesc ?>" name="book_desc"
            maxlength="35" required pattern="^[A-Za-z]+$">
            </div>
               <!-- Book Cost input field. -->
            <div class="form-fields">
              <label class="form-fields-heading"> <span class="warning-message">*
                </span>Book cost:</label>
              <input type="text" class="form-input-fields" placeholder="Last Name"
              value="<?php echo $cost ?>" name="cost" maxlength="35" required
              pattern="^[0-9]+$" title="Fill this fields with alphabets only">
              <p class="warning-message">
                <?php echo $second_input_error_message ?>
              </p>
            </div>
             <!-- Book Author Name input field. -->
            <div class="form-fields">
              <label class="form-fields-heading"> <span class="warning-message">*
                </span>Book Author Name:</label>
              <input type="text" class="form-input-fields"
              placeholder="Enter the book author Name"
              value="<?php echo $lname ?>" name="author_name" maxlength="35" required
              pattern="^[A-Za-z]+$" title="Fill this fields with alphabets only">
              <p class="warning-message">
                <?php echo $second_input_error_message ?>
              </p>
            </div>


          <!-- Submit button. -->
          <input type="submit" class="form-submit-btn" name="submit"
          value="Submit">
        </form>
      </div>
    </div>
  </div>
  <!-- Container end. -->
</body>

</html>
