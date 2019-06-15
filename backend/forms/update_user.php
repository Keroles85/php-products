<h1>update User</h1>

<form action="" method="post">
  <?php
    $user = getUser(new User(), $id);
    foreach($user as $cols):
  ?>
    <div class="row" style="margin-bottom: 1rem">
      <div class="col">
        <input type="text" name="first_name" class="form-control" value="<?= $cols['first_name'] ?>">
      </div>
      <div class="col">
        <input type="text" name="last_name"class="form-control" value="<?= $cols['last_name'] ?>">
      </div>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $cols['email'] ?>">
    </div>
    <div class="form-group" style="padding-left: 1.5rem">
      <input type="checkbox" class="form-check-input" id="admin" name="admin" <?= $cols['isadmin']? 'checked' : '' ?>>
      <label class="form-check-label" for="admin">Admin user</label>
    </div>
    <button type="submit" name="btn_update" class="btn btn-success">Update</button>
  <?php endforeach; ?>
</form>