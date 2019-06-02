<?php

function dbConnect() {
  require 'config.php';
  return $db;
}

$db = dbConnect();
$sql = 'select * from carousel';
$items = $db -> query($sql);
$images = $db -> query($sql);
$count = 0;

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
  <link rel="stylesheet" href="../style/css/carousel.css"> <!-- my-style -->
</head>
<body>
  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">
        <h1>Carousel control page</h1>

        <a href='add.php?type=carousel' class="btn btn-success" style="margin: 0 0 2em 1em;">Add New Item</a>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Caption</th>
              <th scope="col">Image URL</th>
              <th scope="col">Visible</th>
              <th scope="col">Active</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>

          <?php foreach($items as $item): ?>

          <tr>
            <th scope="row">
              <input type="text" value="<?= $item['title'] ?>">
            </th>
            <td>
              <textarea rows="5" cols="25"><?= $item['caption'] ?></textarea>
            </td>
            <td><img src="../<?= $item['img_url'] ?>" class="img-thumbnail"></td>
            <td>
              <input type="checkbox" <?= $item['visible']? 'checked' : ''; ?>>
            </td>
            <td>
              <input type="radio" name="active" <?= $item['active']? 'checked' : ''; ?>>
              </td>
            <td>
              <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-danger">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>

          <?php endforeach ?>

          <tr>
            <td style="border-top: none;">
              <button class="btn btn-primary">Update</button>
            </td>
          </tr>

          </tbody>
        </table>
      </div>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>