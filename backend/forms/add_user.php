<h1>Add new User</h1>

<form action="" method="post">
  <div class="row" style="margin-bottom: 1rem">
    <div class="col">
      <input type="text" name="first_name" class="form-control" placeholder="First name">
    </div>
    <div class="col">
      <input type="text" name="last_name"class="form-control" placeholder="Last name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="row" style="margin-bottom: 1rem">
    <div class="col">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="col">
      <input type="checkbox" class="form-check-input" id="admin" name="admin">
      <label class="form-check-label" for="admin">Admin user</label>
    </div>
  </div>
  <button type="submit" name="btn_add" class="btn btn-success">Sign Up</button>
</form>