<h1>Add new carousel item</h1>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control">
  </div>
  <div class="form-group">
    <label for="caption">Caption</label>
    <textarea name="caption" id="caption" cols="30" rows="10" class="form-control"></textarea>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" <?= getActive(new Carousel())? 'disabled' : '' ?>>
    <label class="form-check-label" for="active">Active</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1">
    <label class="form-check-label" for="inlineCheckbox2">Visible</label>
  </div>
  <div class="form-group" style="margin-top: 10px;">
    <label for="image">Select Image</label>
    <input type="file" class="form-control-file" name="image" id="image">
  </div>
    <button class="btn btn-primary" name="btn_add">Add Item</button>
</form>