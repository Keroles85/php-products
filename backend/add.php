<?php
session_start();

//check if user is logged in and if user is admin
if(!isset($_SESSION['admin'])) {
  header('location: login.php');
}

// include config file
function dbConnect() {
  require 'config.php';
  return $db;
}

//get the add type
$addType = $_GET['type'];

//get all categories if user is adding product
if ($addType == 'product') $categories = getCategories();
 
//get categories function to show in dropdown menu
function getCategories() {
  $db = dbConnect();
  $categories = $db->query("select * from categories");
  unset($db);
  return $categories;
}


/** 
* ADD PRODUCT FUNCTION
 */
function addProduct() {
  $db = dbConnect();
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['categories'];

  //insert sql to add new product
  $insert_sql = "INSERT INTO products (name, price, description, cat_id) VALUES
    ('$name', $price, '$description', $category)";
  $stmt = $db -> exec($insert_sql);

  //get product added id to add to images table
  $getID = $db -> query("SELECT id FROM products WHERE id=LAST_INSERT_ID()") -> fetch();
  insertImg($getID['id']);
  unset($db);//close connection

  header('location: confirm.php?action=Product&type=add&query='.$stmt);
} 

//insert image in images table function
function insertImg($id) {
  $db = dbConnect();
  $imgURL = uploadFile($_FILES['image']);
  $insert_img_sql = "INSERT INTO images (product_id, image_url) VALUES ($id, '$imgURL')";
  $db -> exec($insert_img_sql);
}

//create a new name for image upload
function uploadFile($file) {
  //$extension = explode('.', $file['name']);
  $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
  $imgURL = "upload/" . time() . ".{$extension}";
  $tmpLocation = $file['tmp_name'];
  move_uploaded_file($tmpLocation, '../'.$imgURL);
  return $imgURL;
}


/**
* ADD CATEGORY FUNCTIONS
 */
function addCategory() {
  $db = dbConnect();
  $name = $_POST['name'];
  $description = $_POST['description'];
  $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
  $stmt = $db -> exec($sql);
  unset($db);//close connection
  header('location: confirm.php?action=Category&type=add&query='.$stmt);
}


/**
* ADD CAROUSEL FUNCTION
 */
function addCarousel() {
  $db = dbConnect();
  $title = $_POST['title'];
  $caption = $_POST['caption'];
  $active = isset($_POST['active'])? 1 : 0;
  $visible = isset($_POST['visible'])? 1 : 0;
  $imgURL = uploadFile($_FILES['image']);
  $sql = "INSERT INTO carousel (title, caption, img_url, active, visible) 
        VALUES ('$title', '$caption', '$imgURL', $active, $visible)";
  $stmt = $db -> exec($sql);
  header('location: confirm.php?action=Carousel%20Item&type=add&query='.$stmt);
}

//check if there's active item in carousel
function getActive() {
  $db = dbConnect();
  $active = $db -> query("SELECT * FROM carousel WHERE active = 1") -> rowCount();
  return $active;
  unset($db);
}


/** 
 * ADD USER FUNCTION
*/

function addUser() {
  $db = dbConnect();
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $admin = isset($_POST['admin'])? 1 : 0;
  $sql = "INSERT INTO users (first_name, last_name, email, password, isadmin) VALUES (?, ?, ?, ?, ?)"; //using positional placeholders
  $stmt = $db -> prepare($sql);
  $stmt -> execute([$firstName, $lastName, $email, $password, $admin]);
  $inserted = $stmt -> rowCount();
  header('location: confirm.php?action=register&query='.$inserted);
}


//check which function when add button is submitted
if (isset($_POST['btn_add'])) {
  switch ($addType) {
    case 'product':
      addProduct();
      break;
    case 'category':
      addCategory();
      break;
    case 'carousel':
      addCarousel();
      break;
    case 'user':
      addUser();
      break;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
  <title>Add Page</title>
</head>
<body>
  <div class="container-fluid">

    <div id="nav-section"></div> <!-- navbar section -->

    <section class="main-section">
      <div class="container">

        <!-- Check for what type to add -->
        <?php
          switch ($addType) {
            case 'product':
              require_once 'forms/add_product.php';
              break;
            case 'category':
              require_once 'forms/add_category.php';
              break;
            case 'carousel':
              require_once 'forms/add_carousel.php';
              break;
            case 'user':
              require_once 'forms/add_user.php';
              break;
          }
        ?>

      </div>
    </section>

  </div> <!-- .container-fluid end -->

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>