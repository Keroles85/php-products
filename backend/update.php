<?php

$type = $_GET['type'];
$id = $_GET['id'];
$name = $description = $price = $catID = $imgURL = '';

//check for edit type (product, category)
if ($type == 'product') {
  getProduct($id); //get product for selected product id
  $categories = getCategories(); //get all categories
} else {
  getCategory($id); //get category for selected category id
}

//check if edit will be made on product or category
if (isset($_POST['btn_update'])) {
  switch ($type) {
    case 'product':
      editProduct($id);
      break;
    case 'category':
      editCategory($id);
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
  $products = $db -> query("select img.image_url, pdt.*  
    from images as img inner join products as pdt on img.product_id = pdt.id 
    where pdt.id=$id");
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
    $sql = "update products set name = '$name', price = $price, description = '$description', cat_id = $catID where id = $id";
    $stmt = $db -> exec($sql);
    unset($db);//close connection
    header('location: confirm.php?action=Product&type=update&query='.$stmt);
  //if user is updating the photo
  } else {
    $queryOk = 0;
    $sql = "update products set name = '$name', price = $price, description = '$description', cat_id = $catID where id = $id";
    $queryOk = $db -> exec($sql);
    $queryOk = updateImg($id)? 1 : 0;
    header('location: confirm.php?action=Product&type=update&query='.$queryOk);
  }
}


/** 
 * HANDLING IMAGE UPLOAD
*/

//update image table function
function updateImg($id) {
  $db = dbConnect();
  $imgURL = uploadFile($_FILES['image']);
  $update_img_sql = "update images set image_url = '$imgURL' where product_id = $id";
  $db -> exec($update_img_sql);
  unset($db);
  return true; //incase the user only updated the image, need to set flag to 1
}

//upload new file to server function
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
  $sql = "update categories set name = '$name', description = '$description' where id = $id";
  $stmt = $db -> exec($sql);
  unset($db);
  header('location: confirm.php?action=Category&type=update&query='.$stmt);
} 

//get category by id to display in form function
function getCategory($id) {
  $db = dbConnect();
  $categories = $db -> query("select * from categories where id = $id");
  unset($db);
  return $categories;
}

//get all categories when editing product
function getCategories() {
  $db = dbConnect();
  $categories = $db->query("select * from categories");
  unset($db);
  return $categories;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add product page</title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
</head>
<body>
  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">

        <h1>Edit <?php echo $type ?></h1>
        
        <!-- update product form -->
        <?php if ($type == 'product'): ?>
        <?php 
          $products = getProduct($id);
          foreach($products as $product):
        ?>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" ><?= $product['description'] ?></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
          </div>
          <div class="form-group">
            <label for="categories">Categories</label>
            <select class="form-control" name="categories" id="categories">

              <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['cat_id'])? 'selected' : '' ?>>
                  <?= $category['name'] ?>
                </option>
              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group">
            <label>Select new photo (optional)</label>
            <input type="file" class="form-control-file" name="image" id="image">
            <div style="padding-top: 10px;"><img src="../<?= $product['image_url'] ?>" class="img-thumbnail" alt=""></div>
          </div>
          <button class="btn btn-primary" name="btn_update">Update</button>
        </form>
        <?php endforeach; ?>
        
        <!-- update category form -->
        <?php else: ?>
        <?php 
          $categories = getCategory($id);
          foreach($categories as $category):
        ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $category['name'] ?>">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $category['description'] ?></textarea>
          </div>

          <button class="btn btn-primary" name="btn_update">Update</button>
        </form>

        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>