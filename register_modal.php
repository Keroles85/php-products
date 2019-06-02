<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="text-align: left">
        <form action="user.php" method="post">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <button type="submit" name="register_btn" class="btn btn-primary">Register</button>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Register Modal End -->