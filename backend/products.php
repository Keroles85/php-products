<?php
include_once dirname(__DIR__) . '/includes/admin-session.php';
include_once dirname(__DIR__) . '/includes/autoload.php';

//if (isset($_GET['cat'])) $catID = $_GET['cat'];

function getProducts($product,$catID) {
  /*if (!isset($catID) || $catID == 'all') {
    $products = $product->readAll();
  } else {
    $products = $product->readAllByCategory($catID);
  }
  return $products;*/

}

function getCategories($category) {
  return $category->readAll();
}

$categories = getCategories(new Category());

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
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="categories">Select Category </label>
              <select name="categories" id="categories" class="form-control">
                <option value="0">-- Select --</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!-- new product button -->
          <div class="col" style="padding-top: 2rem">
            <a href='add.php?type=product' class="btn btn-success">Add New Product</a>
          </div>
        </div>

        <!-- products table div -->
        <div class="products"></div>

      </div>
    </section>
  </div>

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
  <script src="../js/backend-products.js"></script>

</body>
</html>