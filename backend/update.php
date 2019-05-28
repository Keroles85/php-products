<?php
require_once 'config.php';

$type = $_GET['type'];
$id = $_GET['id'];
$name = $description = $price = $catID = $imgURL = '';

//check for edit type (product, category)
if ($type == 'product') {
  getProduct($id); //get product for selected product id
  getCategories(); //get all categories
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

/**
* edit product function 
 */
function editProduct($id) {

  //set variables for sql update
  global $db;
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

//update image table function
function updateImg($id) {
  global $db;
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

//get product by id to display in form function
function getProduct($id) {
  global $db, $name, $description, $price, $catID, $imgURL;
  $products = $db -> query("select img.image_url, pdt.*  
    from images as img inner join products as pdt on img.product_id = pdt.id 
    where pdt.id=$id");
  foreach ($products as $product) {
    $name = $product['name'];
    $description = $product['description'];
    $price = $product['price'];
    $catID = $product['cat_id'];
    $imgURL = $product['image_url'];
  }

  unset($db);
}

/** 
* edit category functions
 */
function editCategory($id) {
  global $db;
  $name = $_POST['name'];
  $description = $_POST['description'];
  $sql = "update categories set name = '$name', description = '$description' where id = $id";
  $stmt = $db -> exec($sql);
  unset($db);
  header('location: confirm.php?action=Category&type=update&query='.$stmt);
} 

//get category by id to display in form function
function getCategory($id) {
  global $db, $name, $description;
  $categories = $db -> query("select * from categories where id = $id");
  foreach($categories as $category) {
    $name = $category['name'];
    $description = $category['description'];
  }
  unset($db);
}

//get all categories when editing product
function getCategories() {
  global $db, $categories;
  $categories = $db->query("select * from categories");
  unset($db);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add product page</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../css/main.css"> <!-- my-style -->
</head>
<body>
  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">

        <h1>Edit <?php echo $type ?></h1>
        
        <?php if ($type == 'product'): ?>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $name ?>">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" ><?= $description ?></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="<?= $price ?>">
          </div>
          <div class="form-group">
            <label for="categories">Categories</label>
            <select class="form-control" name="categories" id="categories">

              <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $catID)? selected : '' ?>>
                  <?= $category['name'] ?>
                </option>
              <?php endforeach ?>

            </select>
          </div>
          <div class="form-group">
            <label>Select new photo (optional)</label>
            <input type="file" class="form-control-file" name="image" id="image" value="<?= $imgURL ?>">
            <div style="padding-top: 10px;"><img src="<?= $imgURL ?>" class="img-thumbnail" alt=""></div>
          </div>
          <button class="btn btn-primary" name="btn_update">Update</button>
        </form>

        <?php else: ?>

        <form action="" method="post">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?=$name ?>">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $description ?></textarea>
          </div>

          <button class="btn btn-primary" name="btn_update">Update</button>
        </form>

        <?php endif; ?>
      </div>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>