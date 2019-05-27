<?php
// include config file
require_once 'config.php';

/**
 * add category function
 */
function addCategory() {
  global $db;
  $name = $_POST['name'];
  $description = $_POST['description'];
  $sql = "insert into categories (name, description) values ('$name', '$description')";
  $stmt = $db -> exec($sql);
  header('location: confirm.php?action=Category&type=add&query='.$stmt);
}

if (isset($_POST['btn_add'])) {
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

    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">
        <h1>Add new category</h1>
      
        <form action="" method="post">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
          </div>

          <button class="btn btn-primary" name="btn_add">Add Category</button>
        </form>

      </div> <!-- .container end -->

    </section>

  </div> <!-- .container-fluid end -->

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>