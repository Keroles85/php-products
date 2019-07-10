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
  <button class="btn btn-primary" name="btn_add">Add Product</button>
</form>