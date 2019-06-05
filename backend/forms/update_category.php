<h1>Update Category</h1>

<form action="" method="post">
  <?php 
    $categories = getCategory($id);
    foreach($categories as $category):
  ?>
    <div class="form-group">
      <label for="name">Category Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= $category['name'] ?>">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $category['description'] ?></textarea>
    </div>
    <button class="btn btn-primary" name="btn_update">Update</button>
  <?php endforeach; ?>
</form>