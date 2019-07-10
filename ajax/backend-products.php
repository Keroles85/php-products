<?php

include_once dirname(__DIR__) . '/includes/autoload.php';
$product = new Product();
$cat_id = $_POST['cat_id'];

$cat_id > 0 ? $products = $product->readAllByCategory($cat_id) : exit(0);

?>

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