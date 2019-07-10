<?php
include_once dirname(__DIR__) . '/includes/admin-session.php';
include_once dirname(__DIR__) . '/includes/autoload.php';

$type = $_GET['type'];
$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: missing ID.");

//check if edit will be made on product or category
if (isset($_POST['btn_update'])) {
  switch ($type) {
    case 'product':
      editProduct(new Product(), $id);
      break;
    case 'category':
      editCategory(new Category(), $id);
      break;
    case 'carousel':
      editCarousel(new Carousel(), $id);
      break;
    case 'user':
      editUser(new User(), $id);
      break;
    case 'carousel':
      editCarousel($id);
      break;
    case 'user':
      editUser($id);
      break;
  }
}


/*
 * UPDATE PRODUCT FUNCTIONS
 */
function editProduct($product, $id) {
  $data = [
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'description' => $_POST['description'],
    'cat_id' => $_POST['categories']
  ];

  //check if user is updating photo
  if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
    $stmt = $product->update($id, $data);
    header('location: confirm.php?action=Product&type=update&query='.$stmt);

  //if user is updating the photo
  } else {
    $img = $_FILES['image'];
    $stmt = $product->update($id, $data, $img);
    header('location: confirm.php?action=Product&type=update&query='.$stmt);
  }
}


/*
 * UPDATE CATEGORIES FUNCTIONS
 */
function editCategory($category, $id) {
  $data = [
    'name' => $_POST['name'],
    'description' => $_POST['description']
  ];

  $stmt = $category->update($id, $data);
  header('location: confirm.php?action=Category&type=update&query='.$stmt);
}


/*
 * UPDATE USER FUNCTION
 */
function getUser($user, $id) {
  return $user->readByID($id);
}


function editUser($user, $id) {
  $data = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'isadmin' => isset($_POST['admin'])? 1 : 0
  ];

  $stmt = $user->update($id, $data);
  header('location: confirm.php?action=update&query='.$stmt);
}


/*
 * UPDATE CAROUSEL ITEMS
 */
function editCarousel($carousel, $id) {
  $data = [
    'title' => $_POST['title'],
    'caption' => $_POST['caption'],
    'active' => isset($_POST['active'])? 1 : 0,
    'visible' => isset($_POST['visible'])? 1 : 0
  ];
  
  if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
    $stmt = $carousel->update($id, $data);
    header('location: confirm.php?action=update&query='.$stmt);
  } else {

    //upload the image and get url
    $image = new Image();
    $img_url = $image->uploadFile($_FILES['image']);

    //add the image url to data array
    $data['img_url'] = $img_url;

    $stmt = $carousel->update($id, $data);
    header('location: confirm.php?action=update&query='.$stmt);
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

    <!-- navigation section -->
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