<?php
// include config file
require_once 'config.php';

//get the add type
$addType = $_GET['type'];

//get all categories if user is adding product
if ($addType == 'product') getCategories();
 
//get categories function to show in dropdown menu
function getCategories() {
  global $db, $categories;
  $categories = $db->query("select * from categories");
  unset($db);
}

/** 
* add new product to database function
 */
function addProduct() {
  global $db;
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['categories'];

  //insert sql to add new product
  $insert_sql = "insert into products (name, price, description, cat_id) VALUES
    ('$name', $price, '$description', $category)";
  $stmt = $db -> exec($insert_sql);

  //get product added id to add to images table
  $getID = $db -> query("select id from products where id=LAST_INSERT_ID()") -> fetch();
  insertImg($getID['id']);
  unset($db);//close connection

  header('location: confirm.php?action=Product&type=add&query='.$stmt);
} 

//insert image in images table function
function insertImg($id) {
  global $db;
  $imgURL = uploadFile($_FILES['image']);
  $insert_img_sql = "insert into images (product_id, image_url) values ($id, '$imgURL')";
  $db -> exec($insert_img_sql);
}


//create a new name for image upload
function uploadFile($file) {
  //$extension = explode('.', $file['name']);
  $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
  $imgURL = "../upload/" . time() . ".{$extension}";
  $tmpLocation = $file['tmp_name'];
  move_uploaded_file($tmpLocation, $imgURL);
  return $imgURL;
}

/**
* add category function
 */
function addCategory() {
  global $db;
  $name = $_POST['name'];
  $description = $_POST['description'];
  $sql = "insert into categories (name, description) values ('$name', '$description')";
  $stmt = $db -> exec($sql);
  unset($db);//close connection
  header('location: confirm.php?action=Category&type=add&query='.$stmt);
}

//call addProduct() or addCategory() function when add button is submitted
if (isset($_POST['btn_add_product'])) {
  addProduct();
} elseif (isset($_POST['btn_add_category'])) {
  addCategory();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../css/main.css"> <!-- my-style -->
  <title>Add product page</title>
</head>
<body>
  <div class="container-fluid">

    <div id="nav-section"></div> <!-- navbar section -->

    <section class="main-section">

      <div class="container">

        <!-- add product form -->
        <?php if($addType == 'product'): ?>
        <h1>Add new product</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control">
          </div>
          <div class="form-group">
            <label for="categories">Categories</label>
            <select class="form-control" name="categories" id="categories">

              <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
              <?php endforeach ?>

            </select>
          </div>
          <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
          </div>
          <button class="btn btn-primary" name="btn_add_product">Add Product</button>
        </form>
        

        <!-- add category form -->
        <?php else: ?>
        <h1>Add new Category</h1>
        <form action="" method="post">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
          </div>

          <button class="btn btn-primary" name="btn_add_category">Add Category</button>
        </form>

        <?php endif; ?>

      </div>

    </section>

  </div> <!-- .container-fluid end -->

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>