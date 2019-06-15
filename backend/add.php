<?php
include_once dirname(__DIR__) . '/includes/admin-session.php';
include_once dirname(__DIR__) . '/includes/autoload.php';

//get the add type
$addType = $_GET['type'];

//get all categories if user is adding product
if ($addType == 'product') {
  $category = new Category();
  $categories = $category->readAll();
}

//check which function when add button is submitted
if (isset($_POST['btn_add'])) {
  switch ($addType) {
    case 'product':
      addProduct(new Product());
      break;
    case 'category':
      addCategory(new Category());
      break;
    case 'carousel':
      addCarousel(new Carousel());
      break;
    case 'user':
      addUser(new User());
      break;
  }
}


/*
 * ADD PRODUCT FUNCTION
 */
function addProduct($product) {
  $data = [
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'price' => $_POST['price'],
    'cat_id' => $_POST['categories'],
    'featured' => 0
  ];
  $img = $_FILES['image'];

  $stmt = $product->create($data, $img);
  header('location: confirm.php?action=Product&type=add&query='.$stmt);
}


/*
 * ADD CATEGORY FUNCTIONS
 */
function addCategory($category) {
  $data = [
    'name' => $_POST['name'],
    'description' => $_POST['description']
  ];
  $stmt = $category->create($data);
  header('location: confirm.php?action=Category&type=add&query='.$stmt);
}


/*
 * ADD USER FUNCTION
 */
function addUser($user) {
  $data = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => md5($_POST['password']),
    'isadmin' => isset($_POST['admin'])? 1 : 0
  ];

  $stmt = $user->create($data);
  header('location: confirm.php?action=register&query='.$stmt);
}


/*
 * ADD CAROUSEL FUNCTION
 */
function addCarousel($carousel) {
  //upload image and get img url
  $image = new Image();
  $img_url = $image->uploadFile($_FILES['image']);

  $data = [
    'title' => $_POST['title'],
    'caption' => $_POST['caption'],
    'img_url' => $img_url,
    'active' => isset($_POST['active'])? 1 : 0,
    'visible' => isset($_POST['visible'])? 1 : 0
  ];

  $stmt = $carousel->create($data);
  header('location: confirm.php?action=Carousel%20Item&type=add&query='.$stmt);
}

//check if there's active item in carousel
function getActive($carousel) {
  return $carousel->getActive();
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