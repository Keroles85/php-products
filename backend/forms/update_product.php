<h1>Update Product</h1>

<form action="" method="post" enctype="multipart/form-data">
  <?php
    $category = new Category();
    $product = new Product();
    $categories = $category->readAll();
    $products = $product->readByID($id);
    foreach($products as $product):
  ?>
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

        <?php foreach($categories as $cols): ?>
          <option value="<?= $cols['id'] ?>" <?= ($cols['id'] == $product['cat_id'])? 'selected' : '' ?>>
            <?= $cols['name'] ?>
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
  <?php endforeach; ?>
</form>