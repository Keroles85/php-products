<h1>Update Carousel</h1>

<form action="" method="post" enctype="multipart/form-data">
  <?php
    $carousel = new Carousel();
    $items = $carousel->readByID($id);
    foreach($items as $item):
  ?>
    <div class="form-group">
      <label for="title">Name</label>
      <input type="text" name="title" id="title" class="form-control" value="<?= $item['title'] ?>">
    </div>
    <div class="form-group">
      <label for="Caption">Caption</label>
      <textarea name="caption" id="caption" cols="30" rows="10" class="form-control" ><?= $item['caption'] ?></textarea>
    </div>
    <div class="form-group">
      <label>Select new photo (optional)</label>
      <input type="file" class="form-control-file" name="image" id="image">
      <div style="padding-top: 10px;"><img src="../<?= $item['img_url'] ?>" class="img-thumbnail" alt=""></div>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="active" value="1" id="active" <?= $item['active']? 'checked': '' ?> <?= ($carousel->getActive() && !$carousel->getActiveByID($id))? 'disabled' : '' ?>>
      <label class="form-check-label" for="active">
        Active
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="visible" value="1" id="visible" <?= $item['visible']? 'checked': '' ?>>
      <label class="form-check-label" for="visible">
        Visible
      </label>
    </div>
    <button class="btn btn-primary" name="btn_update">Update</button>
  <?php endforeach; ?>
</form>