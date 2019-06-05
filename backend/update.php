<?php
session_start();

//check if user is logged in and if user is admin
if(!isset($_SESSION['admin'])) {
  header('location: login.php');
}

$type = $_GET['type'];
$id = $_GET['id'];

//check if edit will be made on product or category
if (isset($_POST['btn_update'])) {
  switch ($type) {
    case 'product':
      editProduct($id);
      break;
    case 'category':
      editCategory($id);
      break;
    case 'carousel':
      editCarousel($id);
      break;
    case 'user':
      editUser($id);
      break;
  }
}

// include config file
function dbConnect() {
  require 'config.php';
  return $db;
}


/**
* UPDATE PRODUCT FUNCTIONS
 */

//get product by id to display in form function
function getProduct($id) {
  $db = dbConnect();
  $products = $db -> query("SELECT img.image_url, pdt.*  
    FROM images AS img INNER JOIN products AS pdt ON img.product_id = pdt.id 
    WHERE pdt.id=$id");
  unset($db);
  return $products;
}

function editProduct($id) {
  //set variables for sql update
  $db = dbConnect();
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $catID = $_POST['categories'];

  //check if user is updating photo
  if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
    $sql = "UPDATE products SET name = '$name', price = $price, description = '$description', cat_id = $catID WHERE id = $id";
    $stmt = $db -> exec($sql);
    unset($db);//close connection
    header('location: confirm.php?action=Product&type=update&query='.$stmt);
  //if user is updating the photo
  } else {
    $queryOk = 0;
    $sql = "UPDATE products SET name = '$name', price = $price, description = '$description', cat_id = $catID WHERE id = $id";
    $queryOk = $db -> exec($sql);
    $queryOk = updateImg($id)? 1 : 0;
    header('location: confirm.php?action=Product&type=update&query='.$queryOk);
  }
}

//update image table function
function updateImg($id) {
  $db = dbConnect();
  $imgURL = uploadFile($_FILES['image']);
  $update_img_sql = "UPDATE images SET image_url = '$imgURL' WHERE product_id = $id";
  $db -> exec($update_img_sql);
  unset($db);
  return true; //incase the user only updated the image, need to set flag to 1
}


/** 
 * HANDLING IMAGE UPLOAD
*/

function uploadFile($file) {
  //$extension = explode('.', $file['name']);
  $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
  $imgURL = "../upload/" . time() . ".{$extension}";
  $tmpLocation = $file['tmp_name'];
  move_uploaded_file($tmpLocation, $imgURL);
  return $imgURL;
}


/** 
* UPDATE CATEGORIES FUNCTIONS
 */

function editCategory($id) {
  $db = dbConnect();
  $name = $_POST['name'];
  $description = $_POST['description'];
  $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $id";
  $stmt = $db -> exec($sql);
  unset($db);
  header('location: confirm.php?action=Category&type=update&query='.$stmt);
} 

//get category by id to display in form function
function getCategory($id) {
  $db = dbConnect();
  $categories = $db -> query("SELECT * FROM categories WHERE id = $id");
  unset($db);
  return $categories;
}

//get all categories when editing product
function getCategories() {
  $db = dbConnect();
  $categories = $db->query("SELECT * FROM categories");
  unset($db);
  return $categories;
}


/** 
 * UPDATE USER FUNCTION
*/

function getUser($id) {
  $db = dbConnect();
  $user = $db -> query("SELECT * FROM users WHERE id=$id");
  unset($db);
  return $user;
}

function editUser($id) {
  $db = dbConnect();
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $admin = isset($_POST['admin'])? 1 : 0;
  $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, isadmin = ? WHERE id=$id"; //using positional placeholders
  $stmt = $db -> prepare($sql);
  $stmt -> execute([$firstName, $lastName, $email, $admin]);
  $inserted = $stmt -> rowCount();
  header('location: confirm.php?action=update&query='.$inserted);
}


/** 
 * UPDATE CAROUSEL ITEMS
*/

function getCarousel($id) {
  $db = dbConnect();
  $sql = "select * from carousel where id=$id";
  $stmt = $db -> query($sql);
  $items = $stmt -> fetchAll();
  unset($db);
  return $items;
}

function editCarousel($id) {
  $db = dbConnect();
  $title = $_POST['title'];
  $caption = $_POST['caption'];
  $active = isset($_POST['active'])? 1 : 0;
  $visible = isset($_POST['visible'])? 1 : 0;
  
  if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
    $sql = "UPDATE carousel SET title=?, caption=?, active = ?, visible = ? WHERE id=$id";
    $stmt = $db -> prepare($sql);
    $stmt -> execute([$title, $caption, $active, $visible]);
    $updated = $stmt -> rowCount();
    unset($db);
    header('location: confirm.php?action=update&query='.$updated);
  } else {
    $imgURL = uploadFile($_FILES['image']);
    $sql = "UPDATE carousel SET title=?, caption=?, img_url = ?, active = ?, visible = ? WHERE id=$id";
    $stmt = $db -> prepare($sql);
    $stmt -> execute([$title, $caption,$imgURL, $active, $visible]);
    $updated = $stmt -> rowCount();
    unset($db);
    header('location: confirm.php?action=update&query='.$updated);
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
  <title>Update Page</title>
</head>
<body>
  <div class="container-fluid">
    <div id="nav-section"></div>
    <section class="main-section">
      <div class="container">
  
        <!-- Check type to update -->
        <?php 
          switch ($type) {
            case 'product':
              require_once 'forms/update_product.php';
              break;
            case 'category':
              require_once 'forms/update_category.php';
              break;
            case 'carousel':
              require_once 'forms/update_carousel.php';
              break;
            case 'user':
              require_once 'forms/update_user.php';
              break;
          }
        ?>

      </div>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>