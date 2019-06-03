<?php
// include config file
function dbConnect() {
  require 'config.php';
  return $db;
}

if (isset($_GET['cat'])) $catID = $_GET['cat'];

function getProducts($catID) {
  $db = dbConnect();
  if (!isset($catID) || $catID == 'all') {
    $products = $db -> query("SELECT prds.id, prds.name AS product_name, prds.description, prds.price, 
    cat.id AS cat_id, cat.name AS cat_name, img.image_url FROM 
    products AS prds INNER JOIN categories AS cat ON prds.cat_id = cat.id
    INNER JOIN images AS img ON prds.id = img.product_id ORDER BY cat_id, prds.id");
  } else {
    $products = $db -> query("SELECT prds.id, prds.name AS product_name, prds.description, prds.price, 
    cat.id AS cat_id, cat.name AS cat_name, img.image_url FROM 
    products AS prds INNER JOIN categories AS cat ON prds.cat_id = cat.id
    INNER JOIN images AS img ON prds.id = img.product_id WHERE cat_id = $catID");
  }
  
  return $products;
}

function getCategories() {
  $db = dbConnect();
  $categories = $db -> query ('SELECT * FROM categories');
  unset($db);//close connection
  return $categories;
}

$products = getProducts($catID);
$categories = getCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
</head>
<body>

  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">

        <h1>Products Main Page</h1>

        <!-- select category to sort products -->
        <div class="form-group">
          <label for="categories">Select Category to filter</label>
          <select name="categories" id="categories" class="form-control">
            <option value="all">-- All --</option>
            <?php foreach ($categories as $category): ?>
              <option value="<?= $category['id'] ?>" <?= ($catID == $category['id'])? 'selected': ''; ?> ><?= $category['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- button to add new product -->
        <a href='add.php?type=product' class="btn btn-success" style="margin: 0 0 2em 1em;">Add New Product</a>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Category</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($products as $product): ?>
            <tr>
              <th scope="row"><?= $product['id'] ?></th>
              <td><?= $product['cat_name'] ?></td>
              <td><?= $product['product_name'] ?></td>
              <td><?= $product['description'] ?></td>
              <td><?= $product['price'] ?></td>
              <td><img src="../<?= $product['image_url'] ?>" class="img-thumbnail"></td>
              <td>
                <a href="update.php?type=product&id=<?= $product['id'] ?>" title="Update Record">
                  <i class="fas fa-pen"></i>
                </a> &nbsp;
                <a onClick="javascript: return confirm('Are you sure?!');" href="delete.php?type=product&id=<?= $product['id'] ?>" title="Delete Record">
                  <i class="fas fa-trash-alt" style="color:red"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </section>
  </div>

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->


  <script>
    $(document).ready(function() {
      $('#categories').change(function() {
        window.location.href = "http://localhost/Assignment/php-products/backend/products.php?cat=" + $('#categories').val();
      });
    });
  </script>
</body>
</html>