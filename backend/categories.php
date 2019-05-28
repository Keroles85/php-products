<?php
// include config file
require_once 'config.php';
 
//get categories function to show in dropdown menu
function getCategories() {
  global $db, $categories;
  $categories = $db->query("select * from categories");
  unset($db);
}

getCategories();

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
  <title>Add category page</title>
</head>
<body>
  <div class="container-fluid">

    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">
        <h1>Categories Main Page</h1>

        <a href='add.php?type=category' class="btn btn-success" style="margin: 0 0 2em 1em;">Add New Category</a>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($categories as $category): ?>
            <tr>
              <th scope="row"><?= $category['id'] ?></th>
              <td><?= $category['name'] ?></td>
              <td><?= $category['description'] ?></td>
              <td>
                <a href="update.php?type=category&id=<?= $category['id'] ?>" title="Update Record">
                  <i class="fas fa-pen"></i>
                </a> &nbsp;
                <a onClick="javascript: return confirm('Are you sure?!');" href="delete.php?type=category&id=<?= $category['id'] ?>" title="Delete Record">
                  <i class="fas fa-trash-alt" style="color:red"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>

          </tbody>
        </table>

      </div> <!-- .container end -->

    </section>

  </div> <!-- .container-fluid end -->

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>